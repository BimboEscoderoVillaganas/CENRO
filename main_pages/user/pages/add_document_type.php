<?php
// add_document_type.php

require '../../../src/db/db_connection.php'; // your existing mysqli connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newType = trim($_POST['newDocumentType']);
    $shelfLife = trim($_POST['shelfLife']);

    if (!empty($newType) && !empty($shelfLife)) {
        try {
            $stmt = $conn->prepare("INSERT INTO document_type (document_type, shelf_life) VALUES (?, ?)");
            $stmt->bind_param("ss", $newType, $shelfLife);
            $stmt->execute();
            $stmt->close();

            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit;
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
?>
