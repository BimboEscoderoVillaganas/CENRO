<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cenro_records_db";
$conn = new mysqli($servername, $username, $password, $dbname);

/*$servername = "sql107.infinityfree.com";
$username = "if0_39220723";
$password = "9u8ZFBRRu1O5t4";
$dbname = "if0_39220723_cenro_records";*/
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
