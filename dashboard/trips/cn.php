<?php
$servername = "mx58.hostgator.mx";
$username = "tonatiuh_admin";
$password = "tonatiuh19";
$dbname = "tonatiuh_ag";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
