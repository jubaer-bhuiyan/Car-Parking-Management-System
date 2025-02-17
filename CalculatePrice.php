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

// Include database connection file
include_once "db_connection.php";

// Retrieve selected vehicle type and hours from the form
$vehicleType = $_POST['vehicleType'];
$hours = $_POST['hours'];

// Query to fetch user data from the database
$sqlUserData = "SELECT * FROM users WHERE Username='$username'";
$resultUserData = $conn->query($sqlUserData);

// Check if user data exists
if ($resultUserData->num_rows > 0) {
    // Fetch user data
    $row = $resultUserData->fetch_assoc();
    $fullName = $row['Name'];
    $email = $row['Email'];
    // Add other fields as needed
} else {
    // Redirect to login page if user data not found
    header("Location: UserLogin.php");
    exit();
}

// Query to fetch fare for the selected vehicle type from the set_fare table
$sqlFare = "SELECT fare FROM set_fare WHERE vehicle_type='$vehicleType'";
$resultFare = $conn->query($sqlFare);

// Check if fare data exists
if ($resultFare->num_rows > 0) {
    // Fetch fare data
    $row = $resultFare->fetch_assoc();
    $fare = $row['fare'];
    // Calculate total price
    $totalPrice = $fare * $hours;
} else {
    // Redirect to the booking page if fare data not found
    header("Location: BookSlot.php");
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Price - Car Parking Management System</title>
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
        <h2 class="display-5">Booking Summary</h2>
        <hr class="my-4">
        <h4>User Information:</h4>
        <p><strong>Full Name:</strong> <?php echo $fullName; ?></p>
        <p><strong>Email Address:</strong> <?php echo $email; ?></p>
        <h4>Booking Details:</h4>
        <p><strong>Vehicle Type:</strong> <?php echo $vehicleType; ?></p>
        <p><strong>Hours:</strong> <?php echo $hours; ?></p>
        <p><strong>Total Price:</strong> $<?php echo $totalPrice; ?></p>
        <form action="PrintReceipt.php" method="post">
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <input type="hidden" name="vehicleType" value="<?php echo $vehicleType; ?>">
            <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
            <button type="submit" class="btn btn-primary">Pay and Print Receipt</button>
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
