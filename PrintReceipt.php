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

// Retrieve data from the form
$vehicleType = $_POST['vehicleType'];
$totalPrice = $_POST['totalPrice'];

// Remove one slot of the selected vehicle from the database table
$sqlRemoveSlot = "UPDATE set_slot SET empty_slots = empty_slots - 1 WHERE vehicle_type='$vehicleType' LIMIT 1";
if ($conn->query($sqlRemoveSlot) === TRUE) {
    // Slot removed successfully
} else {
    // Error removing slot
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Receipt - Car Parking Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f0f8ff; /* light sky blue */
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .jumbotron {
            padding: 2rem;
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

<div class="container">
    <div class="jumbotron">
        <h2 class="display-5">Receipt</h2>
        <hr class="my-4">
        <p><strong>User ID:</strong> <?php echo $username; ?></p>
        <p><strong>Vehicle Type:</strong> <?php echo $vehicleType; ?></p>
        <p><strong>Total Price:</strong> $<?php echo $totalPrice; ?></p>
        <hr>
        <button onclick="window.print()" class="btn btn-primary">Print Receipt</button>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Car Parking Management System</p>
    </div>
</footer>

</body>
</html>
