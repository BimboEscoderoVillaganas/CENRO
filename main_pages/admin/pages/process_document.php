<?php
session_start();
include '../../../src/db/db_connection.php';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Begin transaction
    $conn->beginTransaction();

    // Get form data
    $documentTitle = $_POST['documentTitle'];
    $documentNumber = $_POST['documentNumber'];
    $approvingAuthority = $_POST['approvingAuthority'];
    $documentType = $_POST['documentType'];
    $dateCreated = $_POST['dateCreated'];
    $filedBy = $_POST['filedBy'];
    $location = $_POST['location'];
    $retentionSchedule = $_POST['retentionSchedule'];
    $accessLevel = $_POST['accessLevel'];
    $description = $_POST['description'];
    $remarks = $_POST['remarks'] ?? null;

    // Insert document - modified to match your actual table structure
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

    // Execute with parameters in correct order
    $stmt->execute([
        $documentNumber,
        $description,
        $approvingAuthority,
        $documentType,
        $dateCreated,
        $filedBy,
        $location,
        $retentionSchedule,
        $accessLevel,
        $remarks
    ]);

    $documentId = $conn->lastInsertId();

    // Handle file uploads
    if (!empty($_FILES['documentFiles']['name'][0])) {
        $uploadDir = '../../../uploads/documents/';
        
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($_FILES['documentFiles']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['documentFiles']['error'][$key] === UPLOAD_ERR_OK) {
                $fileName = basename($_FILES['documentFiles']['name'][$key]);
                $filePath = $uploadDir . uniqid() . '_' . $fileName;

                if (move_uploaded_file($tmpName, $filePath)) {
                    $fileStmt = $conn->prepare("INSERT INTO file_tbl (
                        document_id, 
                        file_name, 
                        date_added
                    ) VALUES (?, ?, NOW())");
                    $fileStmt->execute([$documentId, $fileName]);
                }
            }
        }
    }

    // Commit transaction
    $conn->commit();

    $_SESSION['alert'] = [
        'type' => 'success',
        'message' => 'Document saved successfully!'
    ];

} catch (PDOException $e) {
    $conn->rollBack();
    $_SESSION['alert'] = [
        'type' => 'error',
        'message' => 'Database error: ' . $e->getMessage()
    ];
} catch (Exception $e) {
    $conn->rollBack();
    $_SESSION['alert'] = [
        'type' => 'error',
        'message' => $e->getMessage()
    ];
}

header("Location: form.php");
exit();
?>