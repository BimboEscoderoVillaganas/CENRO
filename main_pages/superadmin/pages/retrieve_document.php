<?php
include '../../../src/db/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $document_id = $_POST['document_id'];

    $update_query = "UPDATE document_tbl SET deleted = 'no' WHERE document_id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($stmt, 'i', $document_id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: archived.php?success=Document+retrieved+successfully");
    } else {
        echo "Error retrieving document.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: archived.php");
    exit();
}
