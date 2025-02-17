<?php
// Start the session
session_start();

// Check if admin is logged in, if not redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: AdminLogin.php");
    exit();
}

// Logout logic
if(isset($_POST['logout'])){
    // Unset all of the session variables
    $_SESSION = array();
    // Destroy the session.
    session_destroy();
    // Redirect to login page
    header("Location: AdminLogin.php");
    exit();
}

// Include database connection file
include_once "db_connection.php";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define array to store vehicle types and corresponding empty slot counts
    $vehicle_slots = array();

    // Loop through each vehicle type and get corresponding empty slot count from form data
    foreach ($_POST as $type => $count) {
        // Check if the field corresponds to a vehicle type
        if (strpos($type, 'vehicle_') !== false && is_numeric($count)) {
            // Extract the vehicle type from the field name
            $vehicle_type = substr($type, strlen('vehicle_'));
            // Check if the record already exists for this vehicle type
            $sql_check = "SELECT * FROM set_slot WHERE vehicle_type = '$vehicle_type'";
            $result_check = $conn->query($sql_check);
            if ($result_check->num_rows > 0) {
                // Record exists, update the empty slots count
                $sql_update = "UPDATE set_slot SET empty_slots = $count WHERE vehicle_type = '$vehicle_type'";
                if ($conn->query($sql_update) === TRUE) {
                    echo "<div class='alert alert-success' role='alert'>Empty slots for $vehicle_type updated successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Error updating empty slots for $vehicle_type: " . $conn->error . "</div>";
                }
            } else {
                // Record does not exist, insert new record
                $sql_insert = "INSERT INTO set_slot (vehicle_type, empty_slots) VALUES ('$vehicle_type', $count)";
                if ($conn->query($sql_insert) === TRUE) {
                    echo "<div class='alert alert-success' role='alert'>Empty slots for $vehicle_type set successfully.</div>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Error setting empty slots for $vehicle_type: " . $conn->error . "</div>";
                }
            }
        }
    }
}

// Fetch and display existing empty slots
$sql_select = "SELECT * FROM set_slot";
$result = $conn->query($sql_select);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Set Slot - Car Parking Management System</title>
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
          <a class="nav-link" href="Registration.php">Registration</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="AvailableSlot.php">Available Slots</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Fare.php">Fare</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="AboutUs.php">About Us</a>
        </li>
        <li class="nav-item">
          <form method="post">
            <button type="submit" class="btn btn-link nav-link" name="logout">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </nav>
</header>

<div class="container">
  <div class="jumbotron">
    <h2 class="display-5">Set Slot (Empty Slots)</h2>
    <hr class="my-4">
    <!-- Slot setting form -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="motorcycle">Motorcycle</label>
        <input type="number" class="form-control" id="motorcycle" name="vehicle_Motorcycle" placeholder="Enter number of empty slots">
      </div>
      <div class="form-group">
        <label for="car">Car</label>
        <input type="number" class="form-control" id="car" name="vehicle_Car" placeholder="Enter number of empty slots">
      </div>
      <div class="form-group">
        <label for="van">Van</label>
        <input type="number" class="form-control" id="van" name="vehicle_Van" placeholder="Enter number of empty slots">
      </div>
      <div class="form-group">
        <label for="truck">Truck</label>
        <input type="number" class="form-control" id="truck" name="vehicle_Truck" placeholder="Enter number of empty slots">
      </div>
      <button type="submit" class="btn btn-primary">Set Empty Slots</button>
    </form>
    <!-- Display existing empty slots -->
    <div class="mt-4">
      <h4>Existing Empty Slots:</h4>
      <ul>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<li>" . $row['vehicle_type'] . ": " . $row['empty_slots'] . " empty slots</li>";
            }
        } else {
            echo "<li>No empty slots set yet.</li>";
        }
        ?>
      </ul>
    </div>
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
