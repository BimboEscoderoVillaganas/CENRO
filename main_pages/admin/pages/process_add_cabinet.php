<?php
// process_add_cabinet.php

// Start session (if needed for authentication)
session_start();


include '../../../src/db/db_connection.php';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Get POST data safely
$cabinet_number = isset($_POST['cabinet_number']) ? intval($_POST['cabinet_number']) : 0;
$cabinet_code = isset($_POST['cabinet_code']) ? $conn->real_escape_string($_POST['cabinet_code']) : null;
$cabinet_location = isset($_POST['cabinet_location']) ? $conn->real_escape_string($_POST['cabinet_location']) : null;

// 3. Prepare and bind statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO cabinet_tbl (cabinet_number, cabinet_code, cabinet_location) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $cabinet_number, $cabinet_code, $cabinet_location);

// 4. Execute and check
if ($stmt->execute()) {
    echo "Cabinet data saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// 5. Close statement and connection
$stmt->close();
$conn->close();
?>