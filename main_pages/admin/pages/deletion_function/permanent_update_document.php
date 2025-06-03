<?php
require '../../../../src/db/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['document_id'];
    
    // First get current document details for the success message
    $selectStmt = $conn->prepare("SELECT document_number, document_type FROM document_tbl WHERE document_id = ?");
    $selectStmt->bind_param("i", $id);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $document = $result->fetch_assoc();
    $selectStmt->close();

    $stmt = $conn->prepare("UPDATE document_tbl SET 
        document_number = ?, approving_authority = ?, document_type = ?, 
        filed_by = ?, retention_schedule = ?, access_level = ?, 
        remarks = ?, status = ? WHERE document_id = ?");
    $stmt->bind_param("ssssssssi",
        $_POST['document_number'],
        $_POST['approving_authority'],
        $_POST['document_type'],
        $_POST['filed_by'],
        $_POST['retention_schedule'],
        $_POST['access_level'],
        $_POST['remarks'],
        $_POST['status'],
        $id
    );

    if ($stmt->execute()) {
        $docNumber = htmlspecialchars($document['document_number']);
        $docType = htmlspecialchars($document['document_type']);
        
        $successMessage = urlencode("Document #$docNumber ($docType) has been successfully updated. " . 
                              "Changes will be reflected in the system immediately.");
        
        header("Location: ../permanent.php?success=$successMessage");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>