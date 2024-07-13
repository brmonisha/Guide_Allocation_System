<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: student-login.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $requiredFields = ['guideName', 'usn1', 'name1', 'email1', 'contact1', 'section1', 'usn2', 'name2', 'email2', 'contact2', 'section2', 'usn3', 'name3', 'email3', 'contact3', 'section3', 'usn4', 'name4', 'email4', 'contact4', 'section4', 'domain', 'projectTitle'];

    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            die("Error: Please fill all the required fields.");
        }
    }

    $guideName = $_POST['guideName'];
    $usn1 = $_POST['usn1'];
    $name1 = $_POST['name1'];
    $email1 = $_POST['email1'];
    $contact1 = $_POST['contact1'];
    $section1 = $_POST['section1'];

    $usn2 = $_POST['usn2'];
    $name2 = $_POST['name2'];
    $email2 = $_POST['email2'];
    $contact2 = $_POST['contact2'];
    $section2 = $_POST['section2'];

    $usn3 = $_POST['usn3'];
    $name3 = $_POST['name3'];
    $email3 = $_POST['email3'];
    $contact3 = $_POST['contact3'];
    $section3 = $_POST['section3'];

    $usn4 = $_POST['usn4'];
    $name4 = $_POST['name4'];
    $email4 = $_POST['email4'];
    $contact4 = $_POST['contact4'];
    $section4 = $_POST['section4'];

    $domain = $_POST['domain'];
    $projectTitle = $_POST['projectTitle'];

    // Handling file upload for consent letter
    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $fileType = mime_content_type($_FILES['consentLetter']['tmp_name']);
    if (!in_array($fileType, $allowedTypes)) {
        die("Error: Invalid file type. Only PDF, DOC, and DOCX files are allowed.");
    }

    // Generate a unique name for the file to avoid conflicts
    $consentLetter = uniqid() . '-' . basename($_FILES['consentLetter']['name']);
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . $consentLetter;

    if ($_FILES['consentLetter']['error'] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($_FILES['consentLetter']['tmp_name'], $uploadFile)) {
            // Insert data into database
            $stmt = $conn->prepare("INSERT INTO student_requests (guide_name, usn1, name1, email1, contact1, section1, usn2, name2, email2, contact2, section2, usn3, name3, email3, contact3, section3, usn4, name4, email4, contact4, section4, domain, project_title, consent_letter)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssssssssssssssss", $guideName, $usn1, $name1, $email1, $contact1, $section1, $usn2, $name2, $email2, $contact2, $section2, $usn3, $name3, $email3, $contact3, $section3, $usn4, $name4, $email4, $contact4, $section4, $domain, $projectTitle, $consentLetter);

            if ($stmt->execute()) {
                
                $_SESSION['success_msg'] = "Your request to guide $guideName has been submitted successfully.";
                // Redirect or display success message
                header('Location: student-dashboard.php');
                exit();
            } else {
                die("Error submitting request: " . $conn->error);
            }

            $stmt->close();
        } else {
            die("Error moving uploaded file.");
        }
    } else {
        die("Error uploading file: " . $_FILES['consentLetter']['error']);
    }

    $conn->close();
}
?>
