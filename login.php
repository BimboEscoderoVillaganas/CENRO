<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlayFull Bistro - Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- Add Bootstrap for Modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Login</h2>
            <?php if (!empty($errorMessage)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $errorMessage; ?>
                </div>
            <?php } ?>
            <form action="login.php" method="post">
                <div class="input-group">
                    <label>Username or Phone Number:</label>
                    <input type="text" name="username_or_phone" required class="<?php echo (isset($errorFields) && $errorFields == 'username_or_phone') ? 'is-invalid' : ''; ?>">
                    <?php if (isset($errorFields) && $errorFields == 'username_or_phone') { ?>
                        <div class="invalid-feedback">This username or phone number does not match.</div>
                    <?php } ?>
                </div>
                <div class="input-group">
                    <label>Password:</label>
                    <input type="password" name="password" required class="<?php echo (isset($errorFields) && $errorFields == 'password') ? 'is-invalid' : ''; ?>">
                    <?php if (isset($errorFields) && $errorFields == 'password') { ?>
                        <div class="invalid-feedback">The password entered is incorrect.</div>
                    <?php } ?>
                </div>
                <button type="submit" class="login-btn" formaction="pages/admin/dashboard.php">Login</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='index.php'">Cancel</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>
    </div>

    <!-- Modal for Unknown User Type Error -->
    <?php if (isset($showModal) && $showModal) { ?>
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>It seems like there is an issue with your user type.</p>
                        <ul>
                            <li><strong>Username:</strong> <?php echo isset($user['username']) ? htmlspecialchars($user['username']) : ''; ?></li>
                            <li><strong>Phone Number:</strong> <?php echo isset($user['phone_number']) ? htmlspecialchars($user['phone_number']) : ''; ?></li>
                            <li><strong>Password:</strong> [hidden]</li>
                        </ul>
                        <p>Please contact support for further assistance.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Show modal
            var myModal = new bootstrap.Modal(document.getElementById('errorModal'), {
                keyboard: false
            });
            myModal.show();
        </script>
    <?php } ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
