<?php
require '../../../src/db/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) $_POST['document_id'];

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
        header("Location: records.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
