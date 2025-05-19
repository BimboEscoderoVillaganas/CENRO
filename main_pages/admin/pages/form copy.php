<?php
include '../../../src/db/db_connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../../../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="shortcut icon" href="../../../assets/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../src/css/nav.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
       .active2 {
        background-color: #b9b9b9;
        color: white;
    }

    a.active1 {
        background-color: #515151;
        color: white;
    }

    /* Ensure container pushes content down */
    .container-fluid {
        margin-top: 1px;
        margin-bottom: 50px;
    }
    </style>
</head>

<body>
<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header" style="background: gray;">
                <h3 style="color: #ffffff;">
                
                <?php
                
                    if (!isset($_SESSION['username'])) {
                        header('Location: ../../../index.php');
                        exit();
                    }
                    if (isset($_SESSION['username'])) {
                        echo '<a href="#">' . htmlspecialchars($_SESSION['username']) . '</a>';
                    } else {
                        echo '<a href="#">Admin</a>';
                    }
                ?>

            </h3>
                
            </div>

            <li class="sidebar-header title" style="
    font-weight: bold; color:gray;">
                        Key Performans Indicator
                    </li>
                    <li class="sidebar-item active2">
                        <a href="dashboard.php" class="sidebar-link">
                        <i class="fa-regular fa-file-lines pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-header" style="
    font-weight: bold; color:gray;">
                        Tools & Components
                    </li>
                    <li class="sidebar-item">
                <a href="form.php" class="sidebar-link">
                    <i class="fa-regular fa-file-lines pe-2"></i>
                    Form
                </a>
            </li>
            <li class="sidebar-item">
                <a href="records.php" class="sidebar-link">
                    <i class="fa-regular fa-file-lines pe-2"></i>
                    All file Records
                </a>
            </li>
            <li class="sidebar-item">
                <a href="permanent.php" class="sidebar-link">
                    <i class="fa-regular fa-file-lines pe-2"></i>
                    Permanent Records
                </a>
            </li>
            <li class="sidebar-item">
                <a href="archive_queue.php" class="sidebar-link">
                    <i class="fa-regular fa-file-lines pe-2"></i>
                    Archive Queue
                </a>
            </li>
                    <!--<li class="sidebar-item">
                        <a href="reports.php" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pages"
                            aria-expanded="false" aria-controls="pages">
                            <i class="fa-solid fa-list pe-2"></i>
                            Records
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                                <a href="records.php" class="sidebar-link">All file Records</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="permanent.php" class="sidebar-link">Permanent Records</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="archive_queue.php" class="sidebar-link">Archive Queue</a>
                            </li>
                            
                        </ul>
                    </li>-->
                    <li class="sidebar-header" style="
    font-weight: bold; color:gray;">
                        Admin Action
                    </li>
                    <li class="sidebar-item">
                        <a href="users.php" class="sidebar-link">
                        <i class="fa-regular fa-file-lines pe-2"></i>
                            Users
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="user_log.php" class="sidebar-link">
                        <i class="fa-regular fa-file-lines pe-2"></i>
                            User Log
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#auth"
                            aria-expanded="false" aria-controls="auth">
                            <i class="fa-regular fa-user pe-2"></i>
                            Account Settings
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                          
                        <li class="sidebar-item">
                                <a href="edit_profile.php" class="sidebar-link">Edit Profile</a>
                            </li>
                            <li class="sidebar-item">
                            <a href="logout.php" class="sidebar-link" onclick="return confirmLogout();">Log Out</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
        </nav>

    <!-- Page Content -->
    <div id="content">
        <div class="menu-header">
            <button type="button" id="sidebarCollapse" class="btn menu-btn">
                <img src="../../../assets/images/burger-bar.png" alt="Menu" width="30">
            </button>
            <span class="menu-text">Form</span>
            <img src="../../../assets/images/logo.png" alt="Logo" class="header-logo">
        </div>

        <!-- Main Form Section -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-20 col-xl-18">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h4 class="mb-4 text-center text-primary">Document Information Form</h4>
                           <form class="form-group">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="documentTitle" class="form-label">Document Title</label>
            <input type="text" class="form-control" id="documentTitle">
        </div>
        <div class="col-md-6">
            <label for="documentNumber" class="form-label">Document Number</label>
            <input type="text" class="form-control" id="documentNumber">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="approvingAuthority" class="form-label">Approving Authority</label>
            <input type="text" class="form-control" id="approvingAuthority">
        </div>
        <div class="col-md-4">
            <label for="documentType" class="form-label">Document Type</label>
            <input type="text" class="form-control" id="documentType">
        </div>
        <div class="col-md-4">
            <label for="dateCreated" class="form-label">Date Created</label>
            <input type="date" class="form-control" id="dateCreated">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="filedBy" class="form-label">Filed By</label>
            <input type="text" class="form-control" id="filedBy">
        </div>
        <div class="col-md-6">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="retentionSchedule" class="form-label">Retention Schedule</label>
            <input type="text" class="form-control" id="retentionSchedule">
        </div>
        <div class="col-md-6">
            <label for="accessLevel" class="form-label">Access Level</label>
            <select class="form-select" id="accessLevel">
                <option value="">Select Access Level</option>
                <option value="Public">Public</option>
                <option value="Restricted">Restricted</option>
                <option value="Confidential">Confidential</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="3"></textarea>
        </div>
        <div class="col-md-6">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="remarks" rows="3"></textarea>
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer mt-5 py-4 bg-light text-center">
            <div class="container">
                <p class="mb-0 text-muted">&copy; <?= date('Y'); ?> Your Organization Name. All rights reserved.</p>
            </div>
        </footer>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
