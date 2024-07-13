<?php
session_start();
include 'config.php'; // Include your database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check admin credentials
    $sql = "SELECT * FROM admins WHERE username = ?  ";
    
    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if admin exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['userType'] = 'admin';

            // Redirect to admin dashboard
            header("Location: admin.html");
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
    $stmt->close();
    $conn->close();

}
?>
