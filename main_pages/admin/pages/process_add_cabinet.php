<?php
// process_add_cabinet.php

session_start();
include '../../../src/db/db_connection.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get and sanitize input
    $cabinet_code = trim($_POST['cabinet_code'] ?? '');
    $cabinet_location = trim($_POST['cabinet_location'] ?? '');

    // Validate input
    if (empty($cabinet_code) || empty($cabinet_location)) {
        throw new Exception("Both Cabinet Code and Location are required.");
    }

    // Check for existing cabinet with same code AND location
    $check_stmt = $conn->prepare("SELECT COUNT(*) FROM cabinet_tbl 
                                WHERE cabinet_code = :code AND cabinet_location = :location");
    $check_stmt->bindParam(':code', $cabinet_code);
    $check_stmt->bindParam(':location', $cabinet_location);
    $check_stmt->execute();
    
    if ($check_stmt->fetchColumn() > 0) {
        throw new Exception("A cabinet with this code and location already exists.");
    }

    // Insert new cabinet
    $insert_stmt = $conn->prepare("INSERT INTO cabinet_tbl (cabinet_code, cabinet_location) 
                                 VALUES (:code, :location)");
    $insert_stmt->bindParam(':code', $cabinet_code);
    $insert_stmt->bindParam(':location', $cabinet_location);
    
    if ($insert_stmt->execute()) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'title' => 'Success',
            'message' => 'Cabinet added successfully!'
        ];
    } else {
        throw new Exception("Failed to add cabinet.");
    }

} catch (PDOException $e) {
    $_SESSION['alert'] = [
        'type' => 'error',
        'title' => 'Database Error',
        'message' => 'Error: ' . $e->getMessage()
    ];
} catch (Exception $e) {
    $_SESSION['alert'] = [
        'type' => 'error',
        'title' => 'Error',
        'message' => $e->getMessage()
    ];
}

header("Location: form.php");
exit();
?>