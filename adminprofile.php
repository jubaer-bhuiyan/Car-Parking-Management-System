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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Profile - Car Parking Management System</title>
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
    <h2 class="display-5">Admin Profile</h2>
    <hr class="my-4">
    <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <!-- Buttons for setting fare and setting slot -->
    <div class="row">
      <div class="col-md-6">
        <a href="SetFare.php" class="btn btn-primary btn-lg btn-block">Set Fare</a>
      </div>
      <div class="col-md-6">
        <a href="SetSlot.php" class="btn btn-primary btn-lg btn-block">Set Slot</a>
      </div>
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
