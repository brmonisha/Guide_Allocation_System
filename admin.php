<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbgas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'add') {
        $guide_name = $_POST['guide_name'];
        $slots = $_POST['slots'];

        $sql = "INSERT INTO ad_allocation(guide_name, slots) VALUES ('$guide_name', $slots)";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action == 'edit') {
        $id = $_POST['id'];
        $guide_name = $_POST['guide_name'];
        $slots = $_POST['slots'];

        $sql = "UPDATE ad_allocation SET guide_name='$guide_name', slots=$slots WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($action == 'delete') {
        $id = $_POST['id'];

        $sql = "DELETE FROM ad_allocation WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Fetch all guides
$sql = "SELECT * FROM ad_allocation";
$guidesResult = $conn->query($sql);
$guides = [];

if ($guidesResult->num_rows > 0) {
    while($row = $guidesResult->fetch_assoc()) {
        $guides[] = $row;
    }
}

$conn->close();

// Return the guide data as JSON
header('Content-Type: application/json');
echo json_encode($guides);
?>
