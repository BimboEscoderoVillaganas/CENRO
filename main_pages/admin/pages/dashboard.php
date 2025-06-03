<?php
include '../../../src/db/db_connection.php';

// Get document statistics
$total_records = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM document_tbl"))['count'];
$permanent_records = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM document_tbl WHERE status = 'permanent'"))['count'];
$archive_queue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM document_tbl WHERE status = 'queued'"))['count'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM user_tbl"))['count'];

// Get monthly data for trend chart
$monthlyData = [];
$result = mysqli_query($conn, "SELECT 
    DATE_FORMAT(upload_date, '%Y-%m') as month, 
    COUNT(*) as count 
    FROM document_tbl 
    GROUP BY DATE_FORMAT(upload_date, '%Y-%m') 
    ORDER BY month ASC LIMIT 12");  // Changed to ASC for proper chronological order

while ($row = mysqli_fetch_assoc($result)) {
    $monthlyData[] = $row;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../../../src/css/nav.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .active2 {
            background-color: #b9b9b9;
            color: white;
        }

        .card-stat {
            transition: transform 0.3s ease;
            min-height: 150px;
        }

        .card-stat:hover {
            transform: translateY(-5px);
        }

        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 20px;
        }

        .menu-header {
            padding: 15px;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <!-- Your sidebar content remains the same -->
            <!-- ... -->
        </nav>

        <!-- Page Content -->
        <div id="content">
            <div class="menu-header">
                <button type="button" id="sidebarCollapse" class="btn menu-btn">
                    <img src="../../../assets/images/burger-bar.png" alt="Menu" width="30">
                </button>
                <span class="menu-text">Dashboard</span>
                <img src="../../../assets/images/logo.png" alt="Logo" class="header-logo">
            </div>

            <div class="container-fluid py-4">
                <h1 class="mb-4">Dashboard Overview</h1>

                <!-- Statistics Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card card-stat text-white h-100 shadow border-0" style="background: linear-gradient(135deg, #007bff, #4dabf7);">
                            <div class="card-body text-center">
                                <i class="fas fa-file-alt fs-1 mb-2"></i>
                                <h5 class="card-title">Total Records</h5>
                                <p class="card-text fs-3 fw-bold"><?php echo $total_records; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-stat text-white h-100 shadow border-0" style="background: linear-gradient(135deg, #28a745, #72e38f);">
                            <div class="card-body text-center">
                                <i class="fas fa-archive fs-1 mb-2"></i>
                                <h5 class="card-title">Permanent Records</h5>
                                <p class="card-text fs-3 fw-bold"><?php echo $permanent_records; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-stat text-dark h-100 shadow border-0" style="background: linear-gradient(135deg, #ffc107, #ffe680);">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fs-1 mb-2"></i>
                                <h5 class="card-title">Archive Queue</h5>
                                <p class="card-text fs-3 fw-bold"><?php echo $archive_queue; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-stat text-white h-100 shadow border-0" style="background: linear-gradient(135deg, #343a40, #6c757d);">
                            <div class="card-body text-center">
                                <i class="fas fa-users fs-1 mb-2"></i>
                                <h5 class="card-title">Registered Users</h5>
                                <p class="card-text fs-3 fw-bold"><?php echo $total_users; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row">
                    <!-- Pie Chart -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Document Distribution</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="documentPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Line Chart -->
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Monthly Document Trend</h5>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="monthlyTrendChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Ensure DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Chart data from PHP
            const totalRecords = <?php echo $total_records; ?>;
            const permanentRecords = <?php echo $permanent_records; ?>;
            const archiveQueue = <?php echo $archive_queue; ?>;
            const monthlyData = <?php echo json_encode($monthlyData); ?>;

            // Format monthly data for chart
            const monthlyLabels = monthlyData.map(item => {
                const [year, month] = item.month.split('-');
                return new Date(year, month-1).toLocaleDateString('en-US', {month: 'short', year: 'numeric'});
            });

            const monthlyCounts = monthlyData.map(item => item.count);

            // 1. Pie Chart - Document Distribution
            const pieCtx = document.getElementById('documentPieChart').getContext('2d');
            new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: ['Permanent Records', 'Archive Queue', 'Other Records'],
                    datasets: [{
                        data: [
                            permanentRecords, 
                            archiveQueue, 
                            Math.max(0, totalRecords - permanentRecords - archiveQueue)
                        ],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.7)',
                            'rgba(255, 193, 7, 0.7)',
                            'rgba(0, 123, 255, 0.7)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((value / total) * 100);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });

            // 2. Line Chart - Monthly Trend
            const trendCtx = document.getElementById('monthlyTrendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: monthlyLabels,
                    datasets: [{
                        label: 'Documents Uploaded',
                        data: monthlyCounts,
                        backgroundColor: 'rgba(13, 110, 253, 0.2)',
                        borderColor: 'rgba(13, 110, 253, 0.8)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // Sidebar toggle
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar, #content').toggleClass('active');
            });
        });

        function confirmLogout() {
            return confirm("Are you sure you want to log out?");
        }
    </script>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>