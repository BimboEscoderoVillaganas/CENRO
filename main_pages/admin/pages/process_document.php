<?php
session_start();
include '../../../src/db/db_connection.php';

// File upload configuration
$uploadDir = '../../../uploads/documents/';
$maxFileSize = 10 * 1024 * 1024; // 10MB
$allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();

    // Validate required fields
    $requiredFields = [
        'documentTitle', 'documentNumber', 'approvingAuthority',
        'documentType', 'dateCreated', 'filedBy', 'location',
        'accessLevel', 'description'
    ];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Required field '$field' is missing or empty");
        }
    }

    // Get shelf life from document_type table
    $stmt = $conn->prepare("SELECT shelf_life FROM document_type WHERE document_type = ?");
    $stmt->execute([$_POST['documentType']]);
    $shelfLife = $stmt->fetchColumn();

    if ($shelfLife === false) {
        throw new Exception("Document type '{$_POST['documentType']}' not found in database");
    }

    // Calculate retention schedule
    $dateCreated = new DateTime($_POST['dateCreated']);
    $retentionSchedule = 'PERMANENT'; // Default value

    if ($shelfLife !== 'PERMANENT' && is_numeric($shelfLife)) {
        $years = (int)$shelfLife;
        $dateCreated->add(new DateInterval("P{$years}Y"));
        $retentionSchedule = $dateCreated->format('Y-m-d');
    }

    // Prepare document data
    $documentData = [
        'document_number' => $_POST['documentNumber'],
        'description' => $_POST['description'],
        'approving_authority' => $_POST['approvingAuthority'],
        'document_type' => $_POST['documentType'],
        'date_created' => $_POST['dateCreated'],
        'filed_by' => $_POST['filedBy'],
        'location' => $_POST['location'],
        'retention_schedule' => $retentionSchedule,
        'access_level' => $_POST['accessLevel'],
        'remarks' => $_POST['remarks'] ?? null,
        'status' => 'Active',
        'deleted' => 'no'
    ];

    // Insert document
    $columns = implode(', ', array_keys($documentData));
    $placeholders = implode(', ', array_fill(0, count($documentData), '?'));
    
    $stmt = $conn->prepare("INSERT INTO document_tbl ($columns) VALUES ($placeholders)");
    $stmt->execute(array_values($documentData));

    $documentId = $conn->lastInsertId();
    $uploadedFiles = [];

    // Process file uploads if any
    if (!empty($_FILES['documentFiles']['name'][0])) {
        // Create upload directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                throw new Exception("Failed to create upload directory");
            }
        }

        // Process each file
        foreach ($_FILES['documentFiles']['tmp_name'] as $key => $tmpName) {
            $fileName = $_FILES['documentFiles']['name'][$key];
            $fileSize = $_FILES['documentFiles']['size'][$key];
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $fileError = $_FILES['documentFiles']['error'][$key];

            // Validate file
            if ($fileError !== UPLOAD_ERR_OK) {
                throw new Exception("Error uploading file: $fileName (Error code: $fileError)");
            }

            if ($fileSize > $maxFileSize) {
                throw new Exception("File $fileName exceeds maximum size limit of 10MB");
            }

            if (!in_array($fileType, $allowedTypes)) {
                throw new Exception("File type $fileType is not allowed for $fileName");
            }

            // Generate unique filename while preserving extension
            $fileBaseName = pathinfo($fileName, PATHINFO_FILENAME);
            $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
            $newFileName = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9\-_]/', '', $fileBaseName) . '.' . $fileExt;
            $destination = $uploadDir . $newFileName;

            // Move uploaded file
            if (!move_uploaded_file($tmpName, $destination)) {
                throw new Exception("Failed to move uploaded file: $fileName");
            }

            // Save file record to database
            $fileStmt = $conn->prepare("INSERT INTO file_tbl (
                document_id, 
                file_name, 
                date_added
            ) VALUES (?, ?, CURDATE())");

            if (!$fileStmt->execute([$documentId, $newFileName])) {
                // Delete the uploaded file if DB insert fails
                unlink($destination);
                throw new Exception("Failed to save file record for: $fileName");
            }

            $uploadedFiles[] = $fileName;
        }
    }

    $conn->commit();

    // Prepare success message
    $fileCount = count($uploadedFiles);
    $fileMessage = $fileCount > 0 ? " with $fileCount attached file" . ($fileCount > 1 ? 's' : '') : '';
    
    $_SESSION['alert'] = [
        'type' => 'success',
        'message' => "Document #{$documentData['document_number']} created successfully$fileMessage! Retention schedule: $retentionSchedule"
    ];

} catch (PDOException $e) {
    if (isset($conn)) {
        $conn->rollBack();
    }
    $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Database error: ' . $e->getMessage()
    ];
} catch (Exception $e) {
    if (isset($conn)) {
        $conn->rollBack();
    }
    $_SESSION['alert'] = [
        'type' => 'error',
        'message' => $e->getMessage()
    ];
}

header("Location: form.php");
exit();
?>