<?php
include '../../../src/db/db_connection.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Access Denied</title>
    <!-- Include your CSS files -->
</head>
<body>
    <div class="container">
        <h1>Access Denied</h1>
        <p>You don't have permission to access this page.</p>
        <a href="dashboard.php">Return to Dashboard</a>
    </div>
</body>
</html>