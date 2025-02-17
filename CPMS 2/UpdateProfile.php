<?php
// Start the session
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION["username"])) {
    header("Location: UserLogin.php");
    exit;
}

// Include database connection file
include_once "db_connection.php";

// Get username from session
$username = $_SESSION["username"];

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];

    // Update user data in the database
    $sql = "UPDATE users SET Name='$fullName', Email='$email' WHERE Username='$username'";
    if ($conn->query($sql) === TRUE) {
        // Redirect to profile page after successful update
        header("Location: UserProfile.php");
        exit;
    } else {
        // Display error message if update fails
        echo "Error updating record: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
