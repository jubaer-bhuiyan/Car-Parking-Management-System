<?php
// Initialize variables for form input values
$name = $username = $email = $password = $confirmPassword = "";
// Initialize variable for error message
$error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize input
    $name = sanitizeInput($_POST["name"]);
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);
    $confirmPassword = sanitizeInput($_POST["confirmPassword"]);

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        $error = "Password and Confirm Password do not match.";
    } else {
        // Insert data into the database
        // Replace 'your_database_name', 'your_username', 'your_password' with your actual database credentials
        $conn = new mysqli("localhost", "root", "", "cpms_db");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if username already exists
        $checkUsernameQuery = "SELECT * FROM Users WHERE Username='$username'";
        $result = $conn->query($checkUsernameQuery);
        if ($result->num_rows > 0) {
            $error = "Username already exists. Please choose another one.";
        } else {
            // Prepare SQL statement
            $stmt = $conn->prepare("INSERT INTO Users (Username, Name, Email, Password) VALUES (?, ?, ?, ?)");
            // Bind parameters
            $stmt->bind_param("ssss", $username, $name, $email, $password);

            // Execute statement
            if ($stmt->execute()) {
                // Data successfully inserted, show success message and inserted data
                echo "<div class='container'>";
                echo "<div class='jumbotron'>";
                echo "<h2 class='display-5'>Registration Successful!</h2>";
                echo "<hr class='my-4'>";
                echo "<p>Name: $name</p>";
                echo "<p>Username: $username</p>";
                echo "<p>Email: $email</p>";
                echo "<p>Password: $password</p>";
                echo "</div>";
                echo "</div>";
            } else {
                // Error inserting data
                $error = "Error: " . $stmt->error;
            }

            // Close connection
            $stmt->close();
        }

        $conn->close();
    }
}

// Function to sanitize input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration - Car Parking Management System</title>
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
        <li class="nav-item active">
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
    <h2 class="display-5">Registration</h2>
    <hr class="my-4">
    <?php if (!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $error; ?>
    </div>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username">
      </div>
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password">
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <?php if ($error == ""): ?>
    <hr class="my-4">
    <p>If you see this message, registration was successful!</p>
    <?php endif; ?>
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
