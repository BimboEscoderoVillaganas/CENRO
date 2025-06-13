<?php
require '../../../src/db/db_connection.php'; // Make sure this file contains your DB connection setup

// Validate and sanitize input
$document_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($document_id <= 0) {
    echo "<div class='alert alert-danger'>Invalid document ID.</div>";
    exit;
}

// Fetch document details
$query = "SELECT d.*, f.file_name 
          FROM document_tbl d
          LEFT JOIN file_tbl f ON d.document_id = f.document_id
          WHERE d.document_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $document_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-warning'>Document not found.</div>";
    exit;
}

$doc = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-4">
        <h2 class="mb-4">Document Details</h2>
        <table class="table table-bordered table-sm">
            <tbody>
                <tr><th>Document ID</th><td><?= htmlspecialchars($doc['document_id']) ?></td></tr>
                <tr><th>File Name</th><td><?= htmlspecialchars($doc['file_name']) ?></td></tr>
                <tr><th>Document Number</th><td><?= htmlspecialchars($doc['document_number']) ?></td></tr>
                <tr><th>Approving Authority</th><td><?= htmlspecialchars($doc['approving_authority']) ?></td></tr>
                <tr><th>Document Type</th><td><?= htmlspecialchars($doc['document_type']) ?></td></tr>
                <tr><th>Filed By</th><td><?= htmlspecialchars($doc['filed_by']) ?></td></tr>
                <tr><th>Retention Schedule</th><td><?= htmlspecialchars($doc['retention_schedule']) ?></td></tr>
                <tr><th>Access Level</th><td><?= htmlspecialchars($doc['access_level']) ?></td></tr>
                <tr><th>Remarks</th><td><?= htmlspecialchars($doc['remarks']) ?></td></tr>
                <tr><th>Date Created</th><td><?= htmlspecialchars($doc['date_created']) ?></td></tr>
                <tr><th>Status</th><td><?= htmlspecialchars($doc['status']) ?></td></tr>
            </tbody>
        </table>
        <a href="your_previous_page.php" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>
