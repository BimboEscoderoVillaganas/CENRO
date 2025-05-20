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
<!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   
<!--For SimpleStatistics-->
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://unpkg.com/simple-statistics@7.0.2/dist/simple-statistics.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simple-statistics/7.8.1/simple-statistics.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>
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

<body>
    <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header" style="background: gray;">
            <h3 style="color: #ffffff;">
                <i class="fa-solid fa-user-circle me-2"></i>
            <?php
                session_start();
                if (!isset($_SESSION['username'])) {
                    header('Location: ../../../index.php');
                    exit();
                }
                echo '<a href="#">' . htmlspecialchars($_SESSION['username']) . '</a>';
            ?>
        </h3>
    </div>

    <li class="sidebar-header title" style="font-weight: bold; color: gray;">
        Key Performance Indicator
    </li>
    <li class="sidebar-item active2">
        <a href="dashboard.php" class="sidebar-link">
            <i class="fa-solid fa-chart-line pe-2"></i>
            Dashboard
        </a>
    </li>

    <li class="sidebar-header" style="font-weight: bold; color: gray;">
        Tools & Components
    </li>
    <li class="sidebar-item">
        <a href="form.php" class="sidebar-link">
            <i class="fa-solid fa-pen-to-square pe-2"></i>
            Form
        </a>
    </li>
    <li class="sidebar-item">
        <a href="records.php" class="sidebar-link">
            <i class="fa-solid fa-folder-open pe-2"></i>
            All File Records
        </a>
    </li>
    <li class="sidebar-item">
        <a href="permanent.php" class="sidebar-link">
            <i class="fa-solid fa-box-archive pe-2"></i>
            Permanent Records
        </a>
    </li>
    <li class="sidebar-item">
        <a href="archive_queue.php" class="sidebar-link">
            <i class="fa-solid fa-clock-rotate-left pe-2"></i>
            Archive Queue
        </a>
    </li>
    
    <li class="sidebar-item">
        <a href="archived.php" class="sidebar-link">
            <i class="fa-solid fa-box-archive pe-2"></i>
            Archived
        </a>
    </li>


    <li class="sidebar-header" style="font-weight: bold; color: gray;">
        Admin Action
    </li>
    <li class="sidebar-item">
        <a href="users.php" class="sidebar-link">
            <i class="fa-solid fa-users pe-2"></i>
            Users
        </a>
    </li>
    <li class="sidebar-item">
        <a href="user_log.php" class="sidebar-link">
            <i class="fa-solid fa-file-lines pe-2"></i>
            User Log
        </a>
    </li>
    <li class="sidebar-item">
        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#auth"
           aria-expanded="false" aria-controls="auth">
            <i class="fa-solid fa-user-gear pe-2"></i>
            Account Settings
        </a>
        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
            <li class="sidebar-item">
                <a href="edit_profile.php" class="sidebar-link">
                    <i class="fa-solid fa-user-pen pe-2"></i>
                    Edit Profile
                </a>
            </li>
            <li class="sidebar-item">
                <a href="logout.php" class="sidebar-link" onclick="return confirmLogout();">
                    <i class="fa-solid fa-right-from-bracket pe-2"></i>
                    Log Out
                </a>
            </li>
        </ul>
    </li>
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
   

    <section id="one-page">
        <div class="container">
            <div class="row mt-4">
                <!-- insertion section -->
                <div class="col-lg-5" id="insertion_section">


                </div>

                <!-- Book List -->
                <div class="col-lg-7" id="book_list">
                    <table class="table table-borderless table-striped mt-3 ">
                        <thead>
                            <tr>
                                <th scope="col">Document Title</th>
                                <th scope="col">Document Type</th>
                                <th scope="col">Date Created</th>
                                <th scope="col"></th>
                                <th scope="col">Serial</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tabs">
                            <tr class="tab">
                                <th scope="row">The Hunger Games</th>
                                <td>Suzanne Collins</td>
                                <td>Alfa</td>
                                <td>478</td>
                                <td>1</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">Harry Potter</th>
                                <td>J.K. Rowling</td>
                                <td>Beta</td>
                                <td>398</td>
                                <td>2</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                            <tr class="tab">
                                <th scope="row">To Kill a Mockingbird</th>
                                <td>Harper Lee  </td>
                                <td>Omega</td>
                                <td>685</td>
                                <td>3</td>
                                <td>
                                  <button type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">X</span>
                                  </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </section>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
        <script src="../js/data.js"></script>
        <script src="../js/form.js"></script>

</body>

</html>
