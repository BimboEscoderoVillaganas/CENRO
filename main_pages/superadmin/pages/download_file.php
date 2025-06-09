<?php
require '../../../src/db/db_connection.php';

$document_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$file_name = isset($_GET['file']) ? basename($_GET['file']) : '';

if ($document_id <= 0 || empty($file_name)) {
    die("Invalid request.");
}

$query = "SELECT file_name 
          FROM file_tbl 
          WHERE document_id = ? AND file_name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $document_id, $file_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("File not found.");
}

$file_path = '../../../uploads/documents/' . $file_name;

if (!file_exists($file_path)) {
    die("File not found on server.");
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file_path));
readfile($file_path);
exit;
