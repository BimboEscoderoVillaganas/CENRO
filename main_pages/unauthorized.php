<?php
include '../src/db/db_connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .access-denied-container {
            max-width: 600px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        .denied-icon {
            font-size: 5rem;
            color: #dc3545;
            margin-bottom: 20px;
        }
        .btn-go-back {
            margin-top: 20px;
            padding: 10px 25px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="access-denied-container">
            <div class="denied-icon">
                <i class="fas fa-ban"></i>
            </div>
            <h1 class="text-danger">Access Denied</h1>
            <p class="lead">You don't have permission to access this page.</p>
            <button onclick="window.history.back();" class="btn btn-primary btn-go-back">
                <i class="fas fa-arrow-left me-2"></i> Go Back
            </button>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Alternative if history back doesn't work
        function goBack() {
            if (document.referrer) {
                window.location.href = document.referrer;
            } else {
                window.location.href = '../../dashboard.php';
            }
        }
    </script>
</body>
</html>