<?php
session_start();
include 'config.php'; // Include your database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST['userType'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query based on user type
    if ($userType == 'student') {
        $sql = "SELECT * FROM students WHERE username = ? AND password = ?";
    } elseif ($userType == 'admin') {
        $sql = "SELECT * FROM admins WHERE username = ? AND password = ?";
    } elseif ($userType == 'guide') {
        $sql = "SELECT * FROM guides WHERE username = ? AND password = ?";
    }

    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['userType'] = $userType;

        // Redirect based on user type
        if ($userType == 'student') {
            header("Location: student-login.php");
            
        } elseif ($userType == 'admin') {
            header("Location: admin-login.html");
        } elseif ($userType == 'guide') {
            header("Location: guide-login.html");
        }
    } else {
        echo "Invalid username or password";
    }
}
?>
