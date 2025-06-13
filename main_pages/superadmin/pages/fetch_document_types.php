<?php
require '../../../src/db/db_connection.php';

$query = $_GET['query'] ?? '';

if (!empty($query)) {
    $stmt = $conn->prepare("SELECT document_type FROM document_type WHERE document_type LIKE CONCAT('%', ?, '%') LIMIT 10");
    $stmt->bind_param("s", $query);
    $stmt->execute();
    $result = $stmt->get_result();

    $types = [];
    while ($row = $result->fetch_assoc()) {
        $types[] = htmlspecialchars($row['document_type']);
    }

    echo json_encode($types);
}
?>
