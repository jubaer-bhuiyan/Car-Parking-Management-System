<?php
// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if user is not logged in
    header("Location: UserLogin.php");
    exit();
}

// Include database connection file
include_once "db_connection.php";

// Query to fetch vehicle types from set_fare table
$sqlFare = "SELECT * FROM set_fare";
$resultFare = $conn->query($sqlFare);

// Query to fetch available slots from set_slot table
$sqlSlot = "SELECT * FROM set_slot";
$resultSlot = $conn->query($sqlSlot);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Slot - Car Parking Management System</title>
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
        <h2 class="display-5">Book Slot</h2>
        <hr class="my-4">
        <form action="CalculatePrice.php" method="post">
            <div class="form-group">
                <label for="vehicleType">Vehicle Type</label>
                <select class="form-control" id="vehicleType" name="vehicleType">
                    <?php
                    // Fetch and display vehicle types from set_fare table
                    if ($resultFare->num_rows > 0) {
                        while ($row = $resultFare->fetch_assoc()) {
                            echo "<option value='" . $row['vehicle_type'] . "'>" . $row['vehicle_type'] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="hours">Hours</label>
                <input type="number" class="form-control" id="hours" name="hours" placeholder="Enter number of hours">
            </div>
            <button type="submit" class="btn btn-primary">Calculate Price</button>
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
