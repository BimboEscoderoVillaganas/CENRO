<?php
include '../../../src/db/db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/images/logo.png" type="image/x-icon">
    <title>Form</title>
    <!-- Bootstrap CSS CDN --> 
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../../src/css/nav.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

<!--For SimpleStatistics-->
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://unpkg.com/simple-statistics@7.0.2/dist/simple-statistics.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simple-statistics/7.8.1/simple-statistics.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>
<style>
/* Alert styling */
.alert {
    max-width: 400px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
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

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header" style="background: gray;">
                <h3 style="color: #ffffff;">
                
                <?php
                    session_start();
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
                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link">
                        <i class="fa-regular fa-file-lines pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-header" style="
    font-weight: bold; color:gray;">
                        Tools & Components
                    </li>
                    <li class="sidebar-item active2">
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


       

        <!-- Page Content  -->
        <div id="content">
            
            <div class="menu-header">
                <button type="button" id="sidebarCollapse" class="btn menu-btn">
                    <img src="../../../assets/images/burger-bar.png" alt="Menu" width="30" style="margin-left: 10px;">
                </button>
                <span class="menu-text">Form</span>
                <img src="../../../assets/images/logo.png" alt="Logo" class="header-logo">
            </div>
            
    
        <!--remove responsive
        </div>-->

        <!-- Main Content Starts Here -->
<div class="container-fluid">
    <div class="container mt-4">
   

    <!-- Main Form Section -->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-20 col-xl-18">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h4 class="mb-4 text-center text-primary">Document Information Form</h4>
                            <!-- Add Cabinet Button -->
<div class="d-flex justify-content-end mb-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCabinetModal">
        <i class="fa fa-plus"></i> Add Cabinet
    </button>
</div>

                           <form class="form-group" method="POST" action="process_document.php">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="documentTitle" class="form-label">Document Title</label>
            <input type="text" class="form-control" id="documentTitle" name="documentTitle" required>
        </div>
        <div class="col-md-6">
            <label for="documentNumber" class="form-label">Document Number</label>
            <input type="text" class="form-control" id="documentNumber" name="documentNumber" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="approvingAuthority" class="form-label">Approving Authority</label>
            <input type="text" class="form-control" id="approvingAuthority" name="approvingAuthority" required>
        </div>
        <div class="col-md-4">
            <label for="documentType" class="form-label">Document Type</label>
            <input type="text" class="form-control" id="documentType" name="documentType" required>
        </div>
        <div class="col-md-4">
            <label for="dateCreated" class="form-label">Date Created</label>
            <input type="date" class="form-control" id="dateCreated" name="dateCreated" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="filedBy" class="form-label">Filed By</label>
            <input type="text" class="form-control" id="filedBy" name="filedBy" required>
        </div>
        <div class="col-md-6">
    <label for="location" class="form-label">Location</label>
    <select class="form-select" id="location" name="location" required>
        <option value="">Select Location</option>
        <?php
        // Database connection
        $host = 'localhost';
        $dbname = 'cenro_records_db';
        $username = 'root';
        $password = '';
        
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Fetch cabinet locations
            $stmt = $conn->query("SELECT cabinet_number, cabinet_code, cabinet_location FROM cabinet_tbl ORDER BY cabinet_location, cabinet_number");
            $cabinets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($cabinets as $cabinet) {
                $displayText = htmlspecialchars($cabinet['cabinet_location']) . '-' . htmlspecialchars($cabinet['cabinet_code']);
                $value = htmlspecialchars($cabinet['cabinet_number']);
                echo "<option value='$value'>$displayText</option>";
            }
        } catch(PDOException $e) {
            echo "<option value=''>Error loading locations</option>";
        }
        ?>
    </select>
</div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="retentionSchedule" class="form-label">Retention Schedule</label>
            <input type="text" class="form-control" id="retentionSchedule" name="retentionSchedule" required>
        </div>
        <div class="col-md-6">
            <label for="accessLevel" class="form-label">Access Level</label>
            <select class="form-select" id="accessLevel" name="accessLevel" required>
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
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="col-md-6">
            <label for="remarks" class="form-label">Remarks</label>
            <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

    <!-- Add Cabinet Modal -->
<div class="modal fade" id="addCabinetModal" tabindex="-1" aria-labelledby="addCabinetModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="process_add_cabinet.php"> <!-- Adjust the action if needed -->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCabinetModalLabel">Add Cabinet</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="cabinetCode" class="form-label">Cabinet Code</label>
                <input type="text" class="form-control" id="cabinetCode" name="cabinet_code" required>
            </div>
            <div class="mb-3">
                <label for="cabinetLocation" class="form-label">Cabinet Location</label>
                <input type="text" class="form-control" id="cabinetLocation" name="cabinet_location" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Cabinet</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

    </div>

<br>
<br>
<br>
<br>
<br>
<br>

<footer class="footer" style="margin-top: 100px; padding: 0px 110px 0px 110px;">
    <div class="container">
        <div class="footer-content">
            <!-- Partnership Logos and Description -->
            <div class="footer-section about">
                <div class="logos">
                    <img src="../../../assets/images/logo.png" alt="Your Logo" class="partner-logo">
                </div>

                <!-- DENR Mission and Vision -->
                <div class="denr-mission-vision" style="margin-top: 15px;">
                    <p><strong>DENR's Mission</strong><br>
                    To mobilize the citizenry to protect, conserve, and manage the environment and natural resources for present and future generations.</p>

                    <p><strong>DENR's Vision</strong><br>
                    A nation enjoying and sustaining its natural resources and a clean and healthy environment.</p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="about-us.html">About Us</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="footer-section contact">
                <h4>Contact Us</h4>
                <p><i class="fas fa-phone-alt"></i> +63 123 4567 890</p>
                <p><i class="fas fa-envelope"></i> info@denr_cenro_mf.com</p>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> DENR-CENRO. All Rights Reserved.</p>
        </div>
    </div>
</footer>

</div>

   
</div>





<!-- Bootstrap JS (required for modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar, #content').toggleClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
    </script>
    <script>
    function disable() {
          return confirm("Are you sure you want to disable/enable this account?");
      }
      function confirmDelete() {
          return confirm("Are you sure you want to delete this account?");
      }
      function confirmLogout() {
          return confirm("Are you sure you want to log out?");
      }
  </script>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.btn-toggle-status');

        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const currentStatus = this.getAttribute('data-status');
                const newStatus = currentStatus === 'disable' ? 'enable' : 'disable';

                // Send AJAX request to update the status
                fetch('update_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `user_id=${userId}&status=${newStatus}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the button text and status attribute
                        this.textContent = newStatus === 'disable' ? 'Enable' : 'Disable';
                        this.setAttribute('data-status', newStatus);
                    } else {
                        alert('Failed to update status.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
</script>
<script>
// Display alert message if exists
<?php if (isset($_SESSION['alert'])): ?>
    document.addEventListener('DOMContentLoaded', function() {
        const alertType = '<?php echo $_SESSION['alert']['type']; ?>';
        const alertMessage = '<?php echo $_SESSION['alert']['message']; ?>';
        
        // Create and show Bootstrap alert
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${alertType} alert-dismissible fade show`;
        alertDiv.style.position = 'fixed';
        alertDiv.style.top = '20px';
        alertDiv.style.right = '20px';
        alertDiv.style.zIndex = '9999';
        alertDiv.innerHTML = `
            ${alertMessage}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        document.body.appendChild(alertDiv);
        
        // Remove alert after 5 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
        
        // Clear the session alert
        <?php unset($_SESSION['alert']); ?>
    });
<?php endif; ?>

// For the Add Cabinet modal - clear form on close
document.getElementById('addCabinetModal').addEventListener('hidden.bs.modal', function () {
    this.querySelector('form').reset();
});
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
        <script src="../js/data.js"></script>
        <script src="../js/form.js"></script>

</body>

</html>
