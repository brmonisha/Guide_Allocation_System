<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guide_name = $_POST['guideName'];
    $usn1 = $_POST['usn1'];
    $usn2 = $_POST['usn2'];
    $usn3 = $_POST['usn3'];
    $usn4 = $_POST['usn4'];
    $domain = $_POST['domain'];
    $project_title = $_POST['projectTitle'];
    $consent_letter = $_FILES['consentLetter']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($consent_letter);

    // Upload file
    if (move_uploaded_file($_FILES['consentLetter']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO requests (guide_name, usn1, usn2, usn3, usn4, domain, project_title, consent_letter)
                VALUES ('$guide_name', '$usn1', '$usn2', '$usn3', '$usn4', '$domain', '$project_title', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            header("Location: form.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>
