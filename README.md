# Car Parking Management System

## Overview

The **Car Parking Management System** is a web-based application designed to streamline the process of managing parking spaces in facilities. It offers real-time tracking of parking slot availability, user-friendly booking interfaces, and secure administrative controls, ensuring efficient and organized parking management.

## Features

- **User Authentication:** Secure login system for both users and administrators.
- **Real-Time Slot Monitoring:** View available and occupied parking slots in real-time.
- **Slot Booking:** Reserve parking spaces in advance to guarantee availability.
- **Automated Billing:** Calculate parking fees based on duration and generate invoices.
- **Profile Management:** Users can update personal information and view booking history.
- **Admin Dashboard:** Administrators can manage users, view system analytics, and configure settings.

## Technologies Used

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Server Environment:** XAMPP

## Installation

To set up the project locally:

1. **Install XAMPP:**
   - Download and install [XAMPP](https://www.apachefriends.org/index.html) on your machine.

2. **Clone the Repository:**
   - Navigate to your XAMPP `htdocs` directory:
     ```bash
     cd /path_to_xampp/htdocs/
     ```
   - Clone the repository:
     ```bash
     git clone https://github.com/jubaer-bhuiyan/Car-Parking-Management-System.git
     ```

3. **Set Up the Database:**
   - Start Apache and MySQL from the XAMPP control panel.
   - Open [phpMyAdmin](http://localhost/phpmyadmin/) in your browser.
   - Create a new database named `cpms_db`.
   - Import the provided SQL file:
     - Click on the `cpms_db` database.
     - Go to the "Import" tab.
     - Choose the `cpms_db.sql` file located in the `DB` directory of the project.
     - Click "Go" to import.

4. **Configure the Application:**
   - Ensure the database connection settings in `db_connection.php` (located in the `CPMS` directory) match your MySQL credentials:
     ```php
     <?php
     $con = mysqli_connect("localhost", "root", "", "cpms_db") or die(mysqli_error());
     ?>
     ```

5. **Run the Application:**
   - Open your browser and navigate to:
     ```
     http://localhost/Car-Parking-Management-System/CPMS/
     ```

## Usage

- **User Access:**
  - Register for a new account or log in with existing credentials.
  - View available parking slots and make reservations.
  - Manage your profile and view booking history.

- **Admin Access:**
  - Log in through the admin login interface.
  - Access the dashboard to manage users, view bookings, and configure system settings.

## Contributing

Contributions are welcome! To contribute:

1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature-name
