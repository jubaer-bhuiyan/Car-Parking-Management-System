<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Car Parking Management System</title>
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
    .jumbotron {
      background-color: #fff; /* white */
      margin-top: 20px;
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
        <li class="nav-item active">
          <a class="nav-link" href="AboutUs.php">About Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Log In
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="UserLogin.php">User</a>
            <a class="dropdown-item" href="AdminLogin.php">Admin</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>

<div class="container">
  <div class="jumbotron">
    <h2 class="display-5">About Us</h2>
    <p>This is a simple Car Parking Management System developed as a project. It helps users to manage parking spaces effectively.</p>
    <p>For any inquiries or feedback, please contact us at: darkdesire2210@gmail.com</p>
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
