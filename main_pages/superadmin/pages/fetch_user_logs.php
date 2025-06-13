<?php
require '../../../src/db/db_connection.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$timeFilter = $_POST['timeFilter'] ?? 'all-month';
$searchTerm = $_POST['searchTerm'] ?? '';

// Base query
$query = "SELECT ul.log_id, ul.user_name, u.email, u.phone_number, u.user_type, u.status, 
          ul.login_date, ul.logout_date 
          FROM user_log ul
          JOIN user_tbl u ON ul.user_id = u.user_id";

// Add time filter
switch($timeFilter) {
    case 'this-week':
        $query .= " WHERE YEARWEEK(ul.login_date, 1) = YEARWEEK(CURDATE(), 1)";
        break;
    case 'last-week':
        $query .= " WHERE YEARWEEK(ul.login_date, 1) = YEARWEEK(CURDATE(), 1) - 1";
        break;
    case 'all-month':
    default:
        $query .= " WHERE MONTH(ul.login_date) = MONTH(CURRENT_DATE())";
        break;
}

// Add search filter if provided
if (!empty($searchTerm)) {
    $query .= $timeFilter ? " AND " : " WHERE ";
    $query .= "(ul.user_name LIKE '%$searchTerm%' OR u.email LIKE '%$searchTerm%' OR u.phone_number LIKE '%$searchTerm%')";
}

$query .= " ORDER BY ul.login_date DESC";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $count = 1;
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='text-center text-muted'>".$count."</td>";
        echo "<td>".htmlspecialchars($row['user_name'] ?? 'N/A')."</td>";
        echo "<td class='text-center'>".htmlspecialchars($row['email'] ?? 'N/A')."</td>";
        echo "<td class='text-center'>".htmlspecialchars($row['phone_number'] ?? 'N/A')."</td>";
        echo "<td class='text-center'>".htmlspecialchars(ucfirst($row['user_type'] ?? 'N/A'))."</td>";
        echo "<td class='text-center'><div class='badge badge-".($row['status'] == 'enable' ? 'success' : 'warning')."'>".htmlspecialchars(ucfirst($row['status'] ?? 'N/A'))."</div></td>";
        echo "<td class='text-center'>".($row['login_date'] ? date('M d, Y h:i A', strtotime($row['login_date'])) : 'N/A')."</td>";
        echo "<td class='text-center'>".($row['logout_date'] ? date('M d, Y h:i A', strtotime($row['logout_date'])) : 'Still active')."</td>";
        echo "<td class='text-center'><button type='button' class='btn btn-primary btn-sm view-details' data-id='".$row['log_id']."'>Details</button></td>";
        echo "</tr>";
        $count++;
    }
} else {
    echo "<tr><td colspan='9' class='text-center'>No user activity found</td></tr>";
}

$conn->close();
?>