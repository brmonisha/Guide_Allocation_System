<?php 
session_start(); 
include 'config.php';

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(["message" => "Unauthorized"]);
    exit();
}

$username = $_SESSION['username'];

// Fetch guide allocation data for this student
$sql = "SELECT * FROM student_dash_guides WHERE name='$username'";
$guidesResult = $conn->query($sql);

if ($guidesResult === false) {
    http_response_code(500);
    echo json_encode(["message" => "Error fetching guide allocation data: " . $conn->error]);
    exit();
}

$guides = [];
while($row = $guidesResult->fetch_assoc()) {
    $guides[] = $row;
}

echo json_encode($guides);

$conn->close();
?>
