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

// Fetch all rows
$files = [];
while ($row = $result->fetch_assoc()) {
    // Store doc info only once (same across rows)
    if (empty($doc)) {
        $doc = $row;
    }
    if (!empty($row['file_name'])) {
        $files[] = $row['file_name'];
    }
}
?>

<div class="p-2">
    <h5 class="mb-3 text-primary">📄 Document Details</h5>

    <table class="table table-bordered table-sm table-striped table-hover align-middle">
        <tbody>
            <tr>
                <th style="width: 30%;">Document ID</th>
                <td><?= htmlspecialchars($doc['document_id']) ?></td>
            </tr>
            <tr>
                <th>Document Number</th>
                <td><?= htmlspecialchars($doc['document_number']) ?></td>
            </tr>
            <tr>
                <th>Approving Authority</th>
                <td><?= htmlspecialchars($doc['approving_authority']) ?></td>
            </tr>
            <tr>
                <th>Document Type</th>
                <td><?= htmlspecialchars($doc['document_type']) ?></td>
            </tr>
            <tr>
                <th>Filed By</th>
                <td><?= htmlspecialchars($doc['filed_by']) ?></td>
            </tr>
            <tr>
                <th>Retention Schedule</th>
                <td><?= htmlspecialchars($doc['retention_schedule']) ?></td>
            </tr>
            <tr>
                <th>Access Level</th>
                <td><?= htmlspecialchars($doc['access_level']) ?></td>
            </tr>
            <tr>
                <th>Remarks</th>
                <td><?= nl2br(htmlspecialchars($doc['remarks'])) ?></td>
            </tr>
            <tr>
                <th>Date Created</th>
                <td><?= htmlspecialchars(date("F j, Y", strtotime($doc['date_created']))) ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><span class="badge bg-<?= $doc['status'] === 'active' ? 'success' : 'secondary' ?>">
                    <?= htmlspecialchars(ucfirst($doc['status'])) ?></span>
                </td>
            </tr>

            <?php if (!empty($files)): ?>
                <tr>
                    <th>Files</th>
                    <td>
                        <?php foreach ($files as $file): ?>
                            <div class="mb-1">
                                <a href="download_file.php?id=<?= urlencode($doc['document_id']) ?>&file=<?= urlencode($file) ?>"
                                class="btn btn-sm btn-outline-primary" target="_blank">
                                    <i class="bi bi-download me-1"></i> <?= htmlspecialchars($file) ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
                        
                        <!-- Download All Button -->
                        <button id="downloadAllBtn" class="btn btn-sm btn-primary mt-3">
                            <i class="bi bi-download me-1"></i> Download All Files
                        </button>
                    </td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
</div>

<script>
document.getElementById('downloadAllBtn').addEventListener('click', function() {
    if (confirm('Are you sure you want to download all files?')) {
        <?php
        // Get all file URLs for the document_id
        $fileUrls = [];
        foreach ($files as $file) {
            $fileUrls[] = '../../../uploads/documents/' . rawurlencode($file);
        }
        ?>
        const files = <?= json_encode($fileUrls) ?>;

        files.forEach(fileUrl => {
            // Open each file in a new tab (trigger download)
            window.open(fileUrl, '_blank');
        });
    }
});
</script>
