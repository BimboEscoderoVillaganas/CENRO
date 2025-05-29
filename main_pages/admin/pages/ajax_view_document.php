<?php
require '../../../src/db/db_connection.php';

$document_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($document_id <= 0) {
    echo "<div class='alert alert-danger'>Invalid document ID.</div>";
    exit;
}

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

<table class="table table-bordered table-sm">
    <tbody>
        <tr><th>Document ID</th><td><?= htmlspecialchars($doc['document_id']) ?></td></tr>
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

<?php if (!empty($doc['file_name'])): ?>
    <div class="mt-4">
        <h6>Attached File:</h6>
        <iframe src="preview.php?file=<?= urlencode($doc['file_name']) ?>" width="100%" height="600"></iframe>

        <iframe src="../../../uploads/documents/<?= urlencode($doc['file_name']) ?>" width="100%" height="600px" style="border:1px solid #ccc;"></iframe>
    </div>
<?php else: ?>
    <div class="alert alert-info">No file attached.</div>
<?php endif; ?>
