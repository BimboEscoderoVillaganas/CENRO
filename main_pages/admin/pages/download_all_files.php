<?php
require '../../../src/db/db_connection.php';

$document_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($document_id <= 0) {
    die("Invalid document ID.");
}

// Get all files for the document
$query = "SELECT file_name FROM file_tbl WHERE document_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $document_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No files found for this document.");
}

$files = [];
while ($row = $result->fetch_assoc()) {
    $files[] = $row['file_name'];
}

if (empty($files)) {
    die("No files to download.");
}

// Create a temp ZIP file
$zip = new ZipArchive();
$zipName = tempnam(sys_get_temp_dir(), 'doc_files_') . '.zip';

if ($zip->open($zipName, ZipArchive::CREATE) !== TRUE) {
    die("Could not create ZIP file.");
}

$uploadDir = '../../../uploads/documents/';

foreach ($files as $file) {
    $filePath = $uploadDir . $file;
    if (file_exists($filePath)) {
        // Add file to ZIP using the original filename
        $zip->addFile($filePath, basename($file));
    }
}

$zip->close();

// Send ZIP to browser for download
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="document_' . $document_id . '_files.zip"');
header('Content-Length: ' . filesize($zipName));
readfile($zipName);

// Delete temp ZIP after sending
unlink($zipName);
exit;
