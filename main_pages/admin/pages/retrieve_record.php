<?php
include '../../../src/db/db_connection.php';

if (isset($_POST['retrieve'])) {
    $record_id = mysqli_real_escape_string($conn, $_POST['record_id']);

    $query = "UPDATE location_tbl SET deleted = 'no' WHERE record_id = '$record_id'";
    if (mysqli_query($conn, $query)) {
        header("Location: archived.php?msg=restored");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
