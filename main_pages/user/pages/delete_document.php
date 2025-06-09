<?php
require_once '../../../src/db/db_connection.php'; // make sure this connects to your database

if (isset($_GET['id'])) {
    $document_id = $_GET['id'];

    // Fetch the file info first
    $file_query = "SELECT file_name FROM file_tbl WHERE document_id = ?";
    $stmt = $conn->prepare($file_query);
    $stmt->bind_param("s", $document_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $file = $result->fetch_assoc();

    if ($file) {
        $file_name = $file['file_name'];
        $current_path = '../../../uploads/documents/' . $file_name;      // Adjust path if needed
        $archive_path = '../../../uploads/archive/' . $file_name;

        // Move the file to archive if it exists
        if (file_exists($current_path)) {
            if (!is_dir('archive')) {
                mkdir('archive', 0755, true); // Create archive folder if not exist
            }
            rename($current_path, $archive_path); // Move file
        }
    }

    // Update the `deleted` column to 'Yes'
    $update_query = "UPDATE document_tbl SET deleted = 'Yes' WHERE document_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("s", $document_id);
    $update_stmt->execute();

    // Optional: Show success message or redirect
    header("Location: records.php?msg=deleted");
    exit();
} else {
    echo "Invalid request.";
}
?>
