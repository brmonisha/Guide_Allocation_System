<?php
session_start();
include 'config.php'; // Include your database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check student credentials
    $sql = "SELECT * FROM students WHERE username = ?";
    
    // Prepare and bind
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if student exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['userType'] = 'student';

            // Redirect to student dashboard
            header("Location: student-dashboard.php");
            exit();
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
