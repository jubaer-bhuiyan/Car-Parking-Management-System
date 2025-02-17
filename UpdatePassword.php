<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if user is not logged in
    header("Location: UserLogin.php");
    exit();
}

// Retrieve user ID from session
$username = $_SESSION['username'];

include_once "db_connection.php";

// Retrieve form data
$currentPassword = $_POST['currentPassword'];
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

// Validate new password
if ($newPassword !== $confirmPassword) {
    // New password and confirm password do not match
    header("Location: changepassword.php?error=nomatch");
    exit();
}


// Prepare and execute the SQL query to fetch the current password
$sql = "SELECT Password FROM Users WHERE Username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, fetch current password
    $row = $result->fetch_assoc();
    $currentStoredPassword = $row['Password'];

    // Verify if the current password matches the stored password
    if ($currentPassword !== $currentStoredPassword) {
        // Current password is incorrect
        header("Location: ChangePassword.php?error=incorrect");
        exit();
    }

    // Update the password in the database
    $updateSql = "UPDATE Users SET Password='$newPassword' WHERE Username='$username'";
    if ($conn->query($updateSql) === TRUE) {
        // Password updated successfully
        header("Location: UserProfile.php?success=passwordchanged");
        exit();
    } else {
        // Error updating password
        echo "Error: " . $updateSql . "<br>" . $conn->error;
    }
} else {
    // User not found
    header("Location: UserLogin.php?error=usernotfound");
    exit();
}

$conn->close();
?>