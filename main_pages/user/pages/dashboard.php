<?php
include '../../../src/db/db_connection.php';

$limit = 10; // number of records per page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Count total records
$countQuery = "SELECT COUNT(*) AS total FROM document_tbl";
$countResult = mysqli_query($conn, $countQuery);
$total = mysqli_fetch_assoc($countResult)['total'];
$pages = ceil($total / $limit);

$sql = "SELECT d.document_id, f.file_name, d.document_number, d.approving_authority, 
                 d.document_type, d.filed_by, d.retention_schedule, d.access_level, 
                 d.remarks, d.date_created, d.status
          FROM document_tbl d
          LEFT JOIN file_tbl f ON d.document_id = f.document_id
          ORDER BY d.date_created DESC
          LIMIT $limit OFFSET $start";


$result = $conn->query($sql);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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


    <li class="sidebar-header" style="font-weight: bold; color: gray;">
        Admin Action
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
                <span class="menu-text">All File Records</span>
                <img src="../../../assets/images/logo.png" alt="Logo" class="header-logo">
            </div>
            
    
        <!--remove responsive
        </div>-->

        <!-- Main Content Starts Here -->
<div class="container-fluid">
    <div class="container mt-4">

    <!--search bar-->
<div class="mb-3 d-flex">
    <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search all columns...">
    <button type="button" id="searchBtn" class="btn btn-sm btn-primary ms-2">
        <i class="fa fa-search"></i>
    </button>
</div>
<div>
        <button id="printBtn" class="btn btn-sm btn-secondary me-2">
            <i class="bi bi-printer"></i> Print
        </button>
        <button id="downloadBtn" class="btn btn-sm btn-success">
            <i class="bi bi-download"></i> Download CSV
        </button>
    </div><br><br>
<?php if (isset($_GET['msg']) && $_GET['msg'] === 'deleted'): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Document was successfully deleted and moved to archive.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

    <div class="table-responsive">
    <table class="table table-bordered table-striped table-sm small align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>Cabinet</th>
                <th>File Name</th>
                <th>Document Number</th>
                <th>Approving Authority</th>
                <th>Document Type</th>
                <th>Filed By</th>
                <th>Retention Schedule</th>
                <th>Access Level</th>
                <th>Remarks</th>
                <th>Date Created</th>
                <th>Status</th>
                <th>Action</th> <!-- New column -->
            </tr>
        </thead>

        <tbody>
        <?php

$loggedInUsername = $_SESSION['username']; // Adjust if you're using another session key

// Escape the username to prevent SQL injection (better to use prepared statements)
$escapedUsername = mysqli_real_escape_string($conn, $loggedInUsername);

$query = "SELECT d.document_id, f.file_name, d.document_number, d.approving_authority, 
                 d.document_type, d.filed_by, d.retention_schedule, d.access_level, 
                 d.remarks, d.date_created, d.status, d.location,
                 c.cabinet_code, c.cabinet_location
          FROM document_tbl d
          LEFT JOIN file_tbl f ON d.document_id = f.document_id
          LEFT JOIN cabinet_tbl c ON d.location = c.cabinet_number
          WHERE (d.deleted <> 'yes' OR d.deleted IS NULL)
            AND d.filed_by = '$escapedUsername'
          ORDER BY d.date_created DESC";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0):
    while ($row = mysqli_fetch_assoc($result)):
        // Combine cabinet location and code
        $cabinet_info = $row['cabinet_location'] && $row['cabinet_code'] 
                      ? $row['cabinet_location'] . '-' . $row['cabinet_code'] 
                      : 'N/A';
?>


                <tr>
                    <td><?= htmlspecialchars($cabinet_info) ?></td>
                    <td><?= htmlspecialchars($row['file_name']) ?></td>
                    <td><?= htmlspecialchars($row['document_number']) ?></td>
                    <td><?= htmlspecialchars($row['approving_authority']) ?></td>
                    <td><?= htmlspecialchars($row['document_type']) ?></td>
                    <td><?= htmlspecialchars($row['filed_by']) ?></td>
                    <td><?= htmlspecialchars($row['retention_schedule']) ?></td>
                    <td><?= htmlspecialchars($row['access_level']) ?></td>
                    <td><?= htmlspecialchars($row['remarks']) ?></td>
                    <td><?= htmlspecialchars($row['date_created']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td class="text-center">
                        <a href="#" class="btn btn-sm btn-primary view-document" data-id="<?= $row['document_id'] ?>" title="View">
                            <i class="bi bi-eye"></i>
                        </a>

                        <button class="btn btn-sm btn-warning edit-btn" 
                                data-id="<?= $row['document_id'] ?>" 
                                data-file_name="<?= htmlspecialchars($row['file_name']) ?>"
                                data-document_number="<?= htmlspecialchars($row['document_number']) ?>"
                                data-approving_authority="<?= htmlspecialchars($row['approving_authority']) ?>"
                                data-document_type="<?= htmlspecialchars($row['document_type']) ?>"
                                data-filed_by="<?= htmlspecialchars($row['filed_by']) ?>"
                                data-retention_schedule="<?= htmlspecialchars($row['retention_schedule']) ?>"
                                data-access_level="<?= htmlspecialchars($row['access_level']) ?>"
                                data-remarks="<?= htmlspecialchars($row['remarks']) ?>"
                                data-status="<?= htmlspecialchars($row['status']) ?>"
                                data-bs-toggle="modal" data-bs-target="#editModal"
                                title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <a href="delete_document.php?id=<?= urlencode($row['document_id']) ?>" 
                            class="btn btn-sm btn-danger" 
                            title="Delete" 
                            onclick="return confirm('Are you sure you want to delete this document? All files and data associated with this document will be moved to archive. You can retrieve it anytime');">
                            <i class="bi bi-trash"></i>
                        </a>

                    </td>
                </tr>

        <?php
            endwhile;
        else:
        ?>
            <tr>
                <td colspan="11" class="text-center">No records found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
    <nav>
    <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $pages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

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


<!-- Document View Modal -->
<div class="modal fade" id="documentViewModal" tabindex="-1" aria-labelledby="documentViewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="documentViewModalLabel">Document Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="documentModalBody">
        <!-- Content loaded via AJAX -->
      </div>
    </div>
  </div>
</div>

<!-- Edit Document Modal -->
 <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="update_document.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Document</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body row g-3">
          <input type="hidden" name="document_id" id="edit-document-id">

          <div class="col-md-6">
            <label class="form-label">Document Number</label>
            <input type="text" name="document_number" id="edit-document-number" class="form-control" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Approving Authority</label>
            <input type="text" name="approving_authority" id="edit-approving-authority" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Document Type</label>
            <input type="text" name="document_type" id="edit-document-type" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Filed By</label>
            <input type="text" name="filed_by" id="edit-filed-by" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Retention Schedule</label>
            <input type="text" name="retention_schedule" id="edit-retention-schedule" class="form-control">
          </div>

          <div class="col-md-6">
            <label class="form-label">Access Level</label>
            <input type="text" name="access_level" id="edit-access-level" class="form-control">
          </div>

          <div class="col-md-12">
            <label class="form-label">Remarks</label>
            <textarea name="remarks" id="edit-remarks" class="form-control" rows="3"></textarea>
          </div>

          <div class="col-md-6">
            <label class="form-label">Status</label>
            <select name="status" id="edit-status" class="form-select">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
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

<!-- script for search function -->
<script>
document.getElementById('searchInput').addEventListener('input', function () {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('table tbody tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchValue) ? '' : 'none';
    });
});
</script>

<!--modal for view document-->
<!-- jQuery Full Version (not slim) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Scrollbar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
$(document).on('click', '.view-document', function (e) {
    e.preventDefault();
    const docId = $(this).data('id');

    $.ajax({
        url: 'ajax_view_document.php',
        method: 'GET',
        data: { id: docId },
        success: function (response) {
            $('#documentModalBody').html(response);
            $('#documentViewModal').modal('show');
        },
        error: function () {
            $('#documentModalBody').html('<div class="alert alert-danger">Error loading document.</div>');
            $('#documentViewModal').modal('show');
        }
    });
});
</script>

<!-- script for edit document modal -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const editButtons = document.querySelectorAll('.edit-btn');

  editButtons.forEach(btn => {
    btn.addEventListener('click', function () {
      document.getElementById('edit-document-id').value = this.dataset.id;
      document.getElementById('edit-document-number').value = this.dataset.document_number;
      document.getElementById('edit-approving-authority').value = this.dataset.approving_authority;
      document.getElementById('edit-document-type').value = this.dataset.document_type;
      document.getElementById('edit-filed-by').value = this.dataset.filed_by;
      document.getElementById('edit-retention-schedule').value = this.dataset.retention_schedule;
      document.getElementById('edit-access-level').value = this.dataset.access_level;
      document.getElementById('edit-remarks').value = this.dataset.remarks;
      document.getElementById('edit-status').value = this.dataset.status;
    });
  });
});
</script>



<!-- script for download CSV -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
<script>
// Store filtered rows
let currentFilteredRows = [];

// Enhanced search function that tracks filtered rows
function performSearch() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const allRows = document.querySelectorAll('table tbody tr');
    currentFilteredRows = [];

    allRows.forEach(row => {
        const text = row.textContent.toLowerCase();
        if (text.includes(searchValue)) {
            row.style.display = '';
            currentFilteredRows.push(row);
        } else {
            row.style.display = 'none';
        }
    });
}

// Print only visible (filtered) data
document.getElementById('printBtn').addEventListener('click', function() {
    const table = document.querySelector('.table');
    const win = window.open('', '', 'height=700,width=900');
    
    // Use filtered rows if available, otherwise all visible rows
    const rowsToPrint = currentFilteredRows.length > 0 ? 
        currentFilteredRows : 
        Array.from(table.querySelectorAll('tbody tr')).filter(row => row.style.display !== 'none');
    
    // Columns to include (excluding Action and Status)
    const includedColumns = ['Cabinet', 'File Name', 'Document Number', 'Approving Authority', 
                           'Document Type', 'Filed By', 'Retention Schedule', 'Access Level', 
                           'Remarks', 'Date Created'];
    
    win.document.write('<html><head><title>Document Records</title>');
    win.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">');
    win.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">');
    win.document.write(`
        <style>
            body { margin: 20px; font-family: Arial, sans-serif; }
            .header-container { 
                position: relative; 
                margin-bottom: 40px;
                padding-top: 20px;
            }
            .logo-left { 
                position: absolute; 
                left: 0; 
                top: 0; 
                height: 70px;
                margin-right: 30px;
            }
            .logo-right { 
                position: absolute; 
                right: 0; 
                top: 0; 
                height: 70px;
                margin-left: 30px;
            }
            .title {
                margin: 0 auto;
                width: 60%;
                text-align: center;
                padding-top: 15px;
            }
            .print-table {
                width: 100%;
                border: 2px solid #000;
                border-collapse: collapse;
                margin-top: 30px;
                font-size: 12px;
            }
            .print-table th, .print-table td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            .print-table th {
                background-color: #212529 !important;
                color: white !important;
                text-align: center;
            }
            .no-print { display: none; }
            @page { size: auto; margin: 10mm; }
        </style>
    `);
    win.document.write('</head><body>');
    
    // Header with logos
    win.document.write(`
        <div class="header-container">
            <img src="../../../assets/images/bp.png" class="logo-left">
            <div class="title">
                <h4 style="margin-bottom: 5px;">Document Management System</h4>
                <h5>${currentFilteredRows.length > 0 ? 'All Records' : 'All Records'}</h5>
                <p style="font-size: 12px; margin-top: 5px;">Generated on: ${new Date().toLocaleString()}</p>
                ${document.getElementById('searchInput').value ? 
                  `<p style="font-size: 12px;">Filtered by: "${document.getElementById('searchInput').value}"</p>` : ''}
            </div>
            <img src="../../../assets/images/logo.png" class="logo-right">
        </div>
    `);
    
    // Create filtered table
    win.document.write('<table class="print-table">');
    win.document.write('<thead><tr>');
    
    // Get headers from original table
    const headers = Array.from(table.querySelectorAll('thead th'))
        .map(th => th.textContent)
        .filter(header => includedColumns.includes(header));
    
    // Write filtered headers
    headers.forEach(header => {
        win.document.write(`<th>${header}</th>`);
    });
    win.document.write('</tr></thead>');
    
    // Write filtered data
    win.document.write('<tbody>');
    
    if (rowsToPrint.length === 0) {
        win.document.write(`<tr><td colspan="${headers.length}" class="text-center">No matching records found</td></tr>`);
    } else {
        rowsToPrint.forEach(row => {
            const cells = Array.from(row.querySelectorAll('td'));
            win.document.write('<tr>');
            
            // Match cells with included columns
            Array.from(table.querySelectorAll('thead th')).forEach((th, index) => {
                if (includedColumns.includes(th.textContent) && cells[index]) {
                    win.document.write(`<td>${cells[index].textContent}</td>`);
                }
            });
            
            win.document.write('</tr>');
        });
    }
    
    win.document.write('</tbody></table>');
    
    // Footer
    win.document.write(`
        <div style="margin-top: 30px; font-size: 11px; text-align: right;">
            <p>Total Records: ${rowsToPrint.length}</p>
            <p>Prepared by: ___________________________</p>
            <p>Verified by: ___________________________</p>
        </div>
    `);
    
    win.document.write('</body></html>');
    win.document.close();
    setTimeout(() => win.print(), 500);
});

// Download only visible (filtered) data as CSV
document.getElementById('downloadBtn').addEventListener('click', function() {
    const table = document.querySelector('.table');
    
    // Use filtered rows if available, otherwise all visible rows
    const rowsToExport = currentFilteredRows.length > 0 ? 
        currentFilteredRows : 
        Array.from(table.querySelectorAll('tbody tr')).filter(row => row.style.display !== 'none');
    
    // Columns to include
    const includedColumns = ['Cabinet', 'File Name', 'Document Number', 'Approving Authority', 
                            'Document Type', 'Filed By', 'Retention Schedule', 'Access Level', 
                            'Remarks', 'Date Created'];
    
    // Get headers
    const headers = [];
    table.querySelectorAll('thead th').forEach(th => {
        if (includedColumns.includes(th.textContent)) {
            headers.push(th.textContent);
        }
    });
    
    let csv = [headers.join(',')];
    
    // Get data rows
    rowsToExport.forEach(row => {
        const rowData = [];
        const cells = row.querySelectorAll('td');
        
        Array.from(table.querySelectorAll('thead th')).forEach((th, index) => {
            if (includedColumns.includes(th.textContent) && cells[index]) {
                rowData.push('"' + cells[index].textContent.replace(/"/g, '""') + '"');
            }
        });
        
        if (rowData.length > 0) {
            csv.push(rowData.join(','));
        }
    });
    
    // Create and download CSV
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.setAttribute('href', url);
    
    const searchTerm = document.getElementById('searchInput').value;
    const filename = searchTerm ? 
        `document_records_filtered_${searchTerm.replace(/[^a-z0-9]/gi, '_')}_${new Date().toISOString().slice(0, 10)}.csv` :
        `document_records_${new Date().toISOString().slice(0, 10)}.csv`;
    
    link.setAttribute('download', filename);
    link.style.visibility = 'hidden';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
});

// Initialize search functionality
document.getElementById('searchInput').addEventListener('input', performSearch);
document.getElementById('searchBtn').addEventListener('click', performSearch);

// Initial search to populate filtered rows
performSearch();
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
        <script src="../js/data.js"></script>
        <script src="../js/form.js"></script>

</body>

</html>
