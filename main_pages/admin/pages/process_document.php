<?php
session_start();
include '../../../src/db/db_connection.php';

// Database configuration
$host = 'localhost';
$dbname = 'cenro_records_db';
$username = 'root';
$password = '';

// File upload configuration
$uploadDir = '../../../uploads/documents/';
$maxFileSize = 10 * 1024 * 1024; // 10MB
$allowedTypes = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->beginTransaction();

    // Get and validate form data
    $requiredFields = [
        'documentTitle', 'documentNumber', 'approvingAuthority',
        'documentType', 'dateCreated', 'filedBy', 'location',
        'retentionSchedule', 'accessLevel', 'description'
    ];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Required field '$field' is missing");
        }
    }

    // Insert document
    $stmt = $conn->prepare("INSERT INTO document_tbl (
        document_number, 
        description, 
        approving_authority, 
        document_type, 
        date_created, 
        filed_by, 
        location, 
        retention_schedule, 
        access_level, 
        remarks,
        status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active')");

    $stmt->execute([
        $_POST['documentNumber'],
        $_POST['description'],
        $_POST['approvingAuthority'],
        $_POST['documentType'],
        $_POST['dateCreated'],
        $_POST['filedBy'],
        $_POST['location'],
        $_POST['retentionSchedule'],
        $_POST['accessLevel'],
        $_POST['remarks'] ?? null
    ]);

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
                throw new Exception("Error uploading file: $fileName");
            }

            if ($fileSize > $maxFileSize) {
                throw new Exception("File $fileName exceeds maximum size limit");
            }

            if (!in_array($fileType, $allowedTypes)) {
                throw new Exception("File type $fileType is not allowed");
            }

            // Generate unique filename
            $newFileName = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9\.\-_]/', '', $fileName);
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
            ) VALUES (?, ?, NOW())");

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
    $fileMessage = $fileCount > 0 ? " with $fileCount file" . ($fileCount > 1 ? 's' : '') : '';
    
    $_SESSION['alert'] = [
        'type' => 'success',
        'message' => "Document saved successfully$fileMessage!"
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