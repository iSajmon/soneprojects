<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("ERROR, CONNECTION FAILED: " . $conn->connect_error);
}
?>
