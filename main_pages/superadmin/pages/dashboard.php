<?php
include '../../../src/db/db_connection.php';
?>
<?php
include '../../../src/db/db_connection.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../../../index.php');
    exit();
}

// Check user type
$username = $_SESSION['username'];
$query = "SELECT user_type FROM user_tbl WHERE user_name = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
    $user_type = $user['user_type'];
    
    // Only allow admin and superadmin
    if (!in_array(strtolower($user_type), ['admin', 'superadmin'])) {
        header('Location: ../../unauthorized.php'); // Redirect to styled unauthorized page
        exit();
    }
} else {
    // User not found in database
    header('Location: ../../../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../assets/images/logo.png" type="image/x-icon">
    <title>Dashboard</title>
    <!-- Bootstrap CSS CDN --> 
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../../../src/css/nav.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
<link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
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
                if (!isset($_SESSION['username'])) {
                    header('Location: ../../../index.php');
                    exit();
                }
                echo '<a href="#" style="color:white">' . htmlspecialchars($_SESSION['username']) . '</a>';
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
                <span class="menu-text">Dashboard</span>
                <img src="../../../assets/images/logo.png" alt="Logo" class="header-logo">
            </div>
            
    
        <!--remove responsive
        </div>-->

        <!-- Main Content Starts Here -->
<div class="container-fluid">
    <div class="container mt-4">
   
<div class="row">
 <?php

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query for total documents
$total_query = "SELECT COUNT(*) AS total FROM document_tbl WHERE deleted = 'no'";
$total_result = $conn->query($total_query);
$total_row = $total_result->fetch_assoc();
$total_documents = $total_row['total'];

// Query for permanent documents
$perm_query = "SELECT COUNT(*) AS permanent FROM document_tbl WHERE retention_schedule = 'PERMANENT' AND deleted = 'no'";
$perm_result = $conn->query($perm_query);
$perm_row = $perm_result->fetch_assoc();
$permanent_documents = $perm_row['permanent'];

// Query for archive queue
$archive_query = "SELECT COUNT(*) AS archive FROM document_tbl 
                 WHERE retention_schedule != 'PERMANENT' 
                 AND STR_TO_DATE(retention_schedule, '%Y-%m-%d') < CURDATE() 
                 AND deleted = 'no'";
$archive_result = $conn->query($archive_query);
$archive_row = $archive_result->fetch_assoc();
$archive_queue = $archive_row['archive'];

?>


            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-midnight-bloom" onclick="window.location.href='records.php'" style="cursor: pointer;">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Total Number of Documents</div>
                            <div class="widget-subheading">All Documents</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span><?php echo $total_documents; ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-arielle-smile" onclick="window.location.href='permanent.php'" style="cursor: pointer;">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Permanent Documents</div>
                            <div class="widget-subheading">Number of Permanent Documents</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span><?php echo $permanent_documents; ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content bg-grow-early" onclick="window.location.href='archive_queue.php'" style="cursor: pointer;">
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading">Queue to Archive</div>
                            <div class="widget-subheading">Number of documents to be archive</div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span><?php echo $archive_queue; ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
                            
                        </div>



               <?php
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current year and last year
$currentYear = date('Y');
$lastYear = $currentYear - 1;

// Default to current year
$selectedYear = $currentYear;
$activeTab = 'current';

// Check if user wants to see last year's data
if (isset($_GET['year'])) {
    if ($_GET['year'] == 'last') {
        $selectedYear = $lastYear;
        $activeTab = 'last';
    }
}

// Get all document data for selected year, ordered by date_created in ascending order
$docsQuery = "SELECT d.*, dt.document_type 
              FROM document_tbl d
              JOIN document_type dt ON d.document_type = dt.document_type
              WHERE YEAR(d.date_created) = ?
              ORDER BY d.date_created desc";  // Added ORDER BY clause here
$stmt = $conn->prepare($docsQuery);
$stmt->bind_param("i", $selectedYear);
$stmt->execute();
$docsResult = $stmt->get_result();

// Process documents for both sections
$documents = [];
$monthlyData = [];
$typeTotals = [];
$overallTotal = 0;

// Initialize monthly data structure for all document types
$docTypesQuery = "SELECT document_type FROM document_type";
$docTypesResult = $conn->query($docTypesQuery);
while ($typeRow = $docTypesResult->fetch_assoc()) {
    $monthlyData[$typeRow['document_type']] = array_fill(1, 12, 0);
    $typeTotals[$typeRow['document_type']] = 0;
}

while ($row = $docsResult->fetch_assoc()) {
    // For Document Logs
    $documents[] = $row;
    
    // For Statistics
    $month = date('n', strtotime($row['date_created']));
    $docType = $row['document_type'];
    
    $monthlyData[$docType][$month]++;
    $typeTotals[$docType]++;
    $overallTotal++;
}

// Prepare data for Chart.js
$labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
$datasets = [];
$colors = [
    'rgba(255, 99, 132, 0.7)',
    'rgba(54, 162, 235, 0.7)',
    'rgba(255, 206, 86, 0.7)',
    'rgba(75, 192, 192, 0.7)',
    'rgba(153, 102, 255, 0.7)',
    'rgba(255, 159, 64, 0.7)'
];
$colorIndex = 0;

foreach ($monthlyData as $type => $counts) {
    $datasets[] = [
        'label' => $type,
        'data' => array_values($counts),
        'backgroundColor' => $colors[$colorIndex % count($colors)],
        'borderColor' => $colors[$colorIndex % count($colors)],
        'borderWidth' => 1
    ];
    $colorIndex++;
}
?>

<div class="row">
    <div class="col-md-12 col-lg-6">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                    Documents Report
                </div>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="?year=last" class="nav-link <?= $activeTab == 'last' ? 'active' : '' ?>">Last</a>
                    </li>
                    <li class="nav-item">
                        <a href="?year=current" class="nav-link <?= $activeTab == 'current' ? 'active' : '' ?>">Current</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tabs-eg-77">
                        <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                                    <canvas id="documentsChart" height="250"></canvas>
                                </div>
                            </div>
                        </div>
                        <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">Document Logs</h6>
                        <div class="scroll-area-sm" style="max-height: 300px; overflow-y: auto;">
                            <div class="scrollbar-container">
                                <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                    <?php foreach ($documents as $doc): 
                                        $formattedDate = date('M d, Y', strtotime($doc['date_created']));
                                    ?>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <?php 
                                                    $docTypeIcon = match($doc['document_type']) {
                                                        'CERTIFICATIONS' => 'fa-certificate',
                                                        'CHARTS' => 'fa-chart-bar',
                                                        'DELIVERY RECEIPTS' => 'fa-truck',
                                                        default => 'fa-file'
                                                    };
                                                    ?>
                                                    <div class="icon-wrapper rounded-circle">
                                                        <i class="fa <?= $docTypeIcon ?> icon-gradient bg-amy-crisp"></i>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?= htmlspecialchars($doc['description']) ?></div>
                                                    <div class="widget-subheading opacity-7">
                                                        <span class="pr-2">#<?= $doc['document_number'] ?></span>
                                                        <span class="badge badge-pill badge-info"><?= $doc['document_type'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <div class="font-size-sm text-muted">
                                                        <div><?= $formattedDate ?></div>
                                                        <div class="text-primary"><?= $doc['filed_by'] ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-6">
    <div class="mb-3 card h-100"> <!-- Added h-100 to make card fill available height -->
        <div class="card-header-tab card-header py-2"> <!-- Reduced padding with py-2 -->
            <div class="card-header-title">
                <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"></i>
                Document Statistics
            </div>
        </div>
        <div class="tab-content h-100 d-flex flex-column"> <!-- Flex layout for proper distribution -->
            <div class="tab-pane fade active show flex-grow-1 d-flex flex-column" id="tab-eg-55"> <!-- Flex grow to fill space -->
                <div class="widget-chart p-2 flex-grow-1" style="min-height: 150px;"> <!-- Reduced padding and flexible height -->
                    <canvas id="lineChart" style="height: 100%; width: 100%;"></canvas> <!-- Canvas fills container -->
                </div>
                <div class="widget-chart-content text-center py-1"> <!-- Reduced padding -->
                    <div class="widget-description text-warning small"> <!-- Added small class -->
                        <i class="fa fa-calendar"></i>
                        <span class="pl-1"><?= $selectedYear ?></span>
                        <span class="text-muted opacity-8 pl-1">Total: <?= $overallTotal ?></span>
                    </div>
                </div>
                <div class="card-body p-2 flex-grow-0"> <!-- Reduced padding and prevent growth -->
                    <div class="row">
                        <?php 
                        $docTypesQuery = "SELECT document_type FROM document_type";
                        $docTypesResult = $conn->query($docTypesQuery);
                        $documentTypes = [];
                        while ($typeRow = $docTypesResult->fetch_assoc()) {
                            $documentTypes[] = $typeRow['document_type'];
                        }
                        
                        $colorOptions = ['danger', 'success', 'primary', 'warning', 'info', 'dark', 'focus', 'alternate'];
                        $colorIndex = 0;
                        
                        foreach ($documentTypes as $docType): 
                            $count = $typeTotals[$docType] ?? 0;
                            $percentage = $overallTotal > 0 ? round(($count / $overallTotal) * 100) : 0;
                            $color = $colorOptions[$colorIndex % count($colorOptions)];
                            $colorIndex++;
                        ?>
                        <div class="col-md-6 mb-1"> <!-- Reduced margin-bottom -->
                            <div class="widget-content p-1"> <!-- Reduced padding -->
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper align-items-center"> <!-- Center align items -->
                                        <div class="widget-content-left pr-1"> <!-- Reduced padding -->
                                            <div class="widget-numbers text-muted small font-weight-bold"><?= $count ?></div> <!-- Smaller text -->
                                        </div>
                                        <div class="widget-content-right flex-grow-1">
                                            <div class="text-muted opacity-6 small text-truncate" title="<?= $docType ?>"><?= $docType ?></div> <!-- Truncate long names -->
                                        </div>
                                    </div>
                                    <div class="progress progress-xs mt-1"> <!-- Extra small progress -->
                                        <div class="progress-bar bg-<?= $color ?>" 
                                             role="progressbar" 
                                             style="width: <?= $percentage ?>%;"
                                             aria-valuenow="<?= $percentage ?>" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        
                        <div class="col-md-6 mb-1">
                            <div class="widget-content p-1">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper align-items-center">
                                        <div class="widget-content-left pr-1">
                                            <div class="widget-numbers text-muted small font-weight-bold"><?= $overallTotal ?></div>
                                        </div>
                                        <div class="widget-content-right flex-grow-1">
                                            <div class="text-muted opacity-6 small">Total</div>
                                        </div>
                                    </div>
                                    <div class="progress progress-xs mt-1">
                                        <div class="progress-bar bg-warning" 
                                             role="progressbar" 
                                             style="width: 100%;"
                                             aria-valuenow="100" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Bar Chart for Documents by Type
    const barCtx = document.getElementById('documentsChart').getContext('2d');
    const barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: <?= json_encode($datasets) ?>
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Monthly Documents by Type (<?= $selectedYear ?>)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Documents'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    });

    // Line Chart for Monthly Totals
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    const monthlyTotals = Array(12).fill(0);
    <?php 
    // Calculate monthly totals across all document types
    foreach ($monthlyData as $type => $counts) {
        foreach ($counts as $month => $count) {
            echo "monthlyTotals[$month-1] += $count;";
        }
    }
    ?>
    
    const lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: <?= json_encode($labels) ?>,
            datasets: [{
                label: 'Total Documents',
                data: monthlyTotals,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Monthly Document Trends (<?= $selectedYear ?>)'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Documents'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            }
        }
    });
});
</script>




                        <?php

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get total number of users
$totalUsersQuery = "SELECT COUNT(*) as total FROM user_tbl";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_assoc()['total'];

// Query to get enabled/active accounts (exclude status = 'disable')
$activeUsersQuery = "SELECT COUNT(DISTINCT u.user_id) as active 
                     FROM user_tbl u 
                     LEFT JOIN user_log l ON u.user_id = l.user_id 
                     WHERE u.status != 'disable' 
                     AND (
                         u.status = 'enable' 
                         OR (l.login_date > DATE_SUB(NOW(), INTERVAL 30 DAY))
                     )";
$activeUsersResult = $conn->query($activeUsersQuery);
$activeUsers = $activeUsersResult->fetch_assoc()['active'];

// Query to get inactive accounts (no recent activity)
$inactiveUsersQuery = "SELECT COUNT(DISTINCT u.user_id) as inactive 
                       FROM user_tbl u 
                       LEFT JOIN user_log l ON u.user_id = l.user_id 
                       WHERE (u.status IS NULL OR u.status != 'enable') 
                       AND (l.login_date IS NULL OR l.login_date < DATE_SUB(NOW(), INTERVAL 30 DAY))
                       AND u.status != 'disable'";
$inactiveUsersResult = $conn->query($inactiveUsersQuery);
$inactiveUsers = $inactiveUsersResult->fetch_assoc()['inactive'];

// Query to get disabled accounts
$disabledUsersQuery = "SELECT COUNT(*) as disabled FROM user_tbl WHERE status = 'disable'";
$disabledUsersResult = $conn->query($disabledUsersQuery);
$disabledUsers = $disabledUsersResult->fetch_assoc()['disabled'];
?>
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content" onclick="window.location.href='users.php'" style="cursor: pointer;">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left"><div class="widget-heading">Number of users</div>
                                            <div class="widget-subheading">Total registered accounts</div>

                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-success"><?php echo $totalUsers; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content" onclick="window.location.href='users.php'" style="cursor: pointer;">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left"><div class="widget-heading">Inactive Accounts</div>
                                            <div class="widget-subheading">Inactive for 30+ days</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-warning"><?php echo $inactiveUsers; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content" onclick="window.location.href='users.php'" style="cursor: pointer;">
                                    <div class="widget-content-outer">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Number of disabled accounts</div>
                                                <div class="widget-subheading">Accounts currently deactivated or suspended</div>
                                            </div>
                                            <div class="widget-content-right">
                                                <div class="widget-numbers text-danger"><?php echo $disabledUsers; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>\
                        </div>


                        
                        <div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">User Activity Log
                <div class="btn-actions-pane-right">
                    <div class="d-flex align-items-center">
                        <div role="group" class="btn-group-sm btn-group mr-3">
                            <button class="btn btn-focus filter-btn" data-filter="this-week">This Week</button>
                            <button class="btn btn-focus filter-btn" data-filter="last-week">Last Week</button>
                            <button class="btn btn-focus filter-btn active" data-filter="all-month">All Month</button>
                        </div>
                        <div class="input-group" style="width: 300px;">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search users..." onkeyup="dynamicSearch()">
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button" id="searchButton">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="userLogTable">
                    <thead>
                        <tr>
                            <th class="text-center position-sticky top-0 bg-white">#</th>
                            <th class="position-sticky top-0 bg-white">User Name</th>
                            <th class="text-center position-sticky top-0 bg-white">Email</th>
                            <th class="text-center position-sticky top-0 bg-white">Phone</th>
                            <th class="text-center position-sticky top-0 bg-white">User Type</th>
                            <th class="text-center position-sticky top-0 bg-white">Status</th>
                            <th class="text-center position-sticky top-0 bg-white">Login Date</th>
                            <th class="text-center position-sticky top-0 bg-white">Logout Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default query for all month
$query = "SELECT ul.log_id, ul.user_name, u.email, u.phone_number, u.user_type, u.status, 
         ul.login_date, ul.logout_date 
         FROM user_log ul
         JOIN user_tbl u ON ul.user_id = u.user_id
         WHERE MONTH(ul.login_date) = MONTH(CURRENT_DATE())
         ORDER BY ul.login_date DESC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $count = 1;
    while($row = $result->fetch_assoc()) {
        // Set default status to "Enable" if empty or null
        $status = (!empty($row['status']) && $row['status'] != 'no data') ? $row['status'] : 'enable';
        $badgeClass = ($status == 'enable') ? 'success' : 'warning';
        
        echo "<tr>";
        echo "<td class='text-center text-muted'>".$count."</td>";
        echo "<td>".htmlspecialchars($row['user_name'] ?? 'N/A')."</td>";
        echo "<td class='text-center'>".htmlspecialchars($row['email'] ?? 'N/A')."</td>";
        echo "<td class='text-center'>".htmlspecialchars($row['phone_number'] ?? 'N/A')."</td>";
        echo "<td class='text-center'>".htmlspecialchars(ucfirst($row['user_type'] ?? 'N/A'))."</td>";
        echo "<td class='text-center'><div class='badge badge-".$badgeClass."'>".htmlspecialchars(ucfirst($status))."</div></td>";
        echo "<td class='text-center'>".($row['login_date'] ? date('M d, Y h:i A', strtotime($row['login_date'])) : 'N/A')."</td>";
        echo "<td class='text-center'>".($row['logout_date'] ? date('M d, Y h:i A', strtotime($row['logout_date'])) : 'Still active')."</td>";
        echo "</tr>";
        $count++;
    }
} else {
    echo "<tr><td colspan='9' class='text-center'>No user activity found</td></tr>";
}
?>
                    </tbody>
                </table>
            </div>
            <div class="d-block text-center card-footer">
                <button class="btn-wide btn btn-success" onclick="exportToExcel()">Export to Excel</button>
            </div>
        </div>
    </div>
</div>

<script>
// Debounce function to limit how often search executes
let searchTimer;
function dynamicSearch() {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        const searchTerm = document.getElementById('searchInput').value.trim();
        const activeFilter = document.querySelector('.filter-btn.active').getAttribute('data-filter');
        fetchUserLogs(activeFilter, searchTerm);
    }, 300); // 300ms delay after typing stops
}

// Filter buttons functionality
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.getAttribute('data-filter');
        const searchTerm = document.getElementById('searchInput').value.trim();
        fetchUserLogs(filter, searchTerm);
    });
});

// Search button functionality
document.getElementById('searchButton').addEventListener('click', function() {
    const searchTerm = document.getElementById('searchInput').value.trim();
    const activeFilter = document.querySelector('.filter-btn.active').getAttribute('data-filter');
    fetchUserLogs(activeFilter, searchTerm);
});



// Export to Excel function
function exportToExcel() {
    const table = document.getElementById('userLogTable');
    const html = table.outerHTML;
    const blob = new Blob([html], {type: 'application/vnd.ms-excel'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'user_activity_log.xls';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}
</script>
                        






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


                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
        <script src="../js/data.js"></script>
        <script src="../js/form.js"></script>

</body>

</html>
