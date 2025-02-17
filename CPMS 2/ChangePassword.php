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

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Car Parking Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f0f8ff; /* light sky blue */
        }
        .navbar {
            background-color: #87ceeb; /* sky blue */
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #fff; /* white */
        }
        .footer {
            background-color: #87ceeb; /* sky blue */
            color: #fff; /* white */
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .footer p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="Home.php">Car Parking System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="Home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="UserProfile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="BookSlot.php">Book Slot</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ChangePassword.php">Change Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <div class="jumbotron">
        <h2 class="display-5">Change Password</h2>
        <hr class="my-4">
        <form action="UpdatePassword.php" method="post">
            <div class="form-group">
                <label for="currentPassword">Current Password</label>
                <input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Enter your current password">
            </div>
            <div class="form-group">
                <label for="newPassword">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter a new password">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm New Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your new password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Car Parking Management System</p>
    </div>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
