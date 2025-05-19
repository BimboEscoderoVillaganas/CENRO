<?php
// Connect to the database
include '../../../src/db/db_connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and collect POST data
$documentTitle = $_POST['documentTitle'];
$documentNumber = $_POST['documentNumber'];
$approvingAuthority = $_POST['approvingAuthority'];
$documentType = $_POST['documentType'];
$dateCreated = $_POST['dateCreated'];
$filedBy = $_POST['filedBy'];
$location = $_POST['location'];
$retentionSchedule = $_POST['retentionSchedule'];
$accessLevel = $_POST['accessLevel'];
$description = $_POST['description'];
$remarks = $_POST['remarks'];
$status = 'Active'; // you can customize this

// Insert into document_tbl
$sql = "INSERT INTO document_tbl (
    document_number, description, approving_authority, document_type, date_created,
    filed_by, location, retention_schedule, access_level, remarks, status
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "issssssssss",
    $documentNumber, $description, $approvingAuthority, $documentType, $dateCreated,
    $filedBy, $location, $retentionSchedule, $accessLevel, $remarks, $status
);

if ($stmt->execute()) {
    echo "Document record saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
