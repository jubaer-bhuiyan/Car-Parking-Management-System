<?php
// Database configuration
$db_host = "localhost"; // Database host (usually localhost)
$db_user = "root"; // Database username
$db_password = ""; // Database password
$db_name = "cpms_db"; // Database name

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
