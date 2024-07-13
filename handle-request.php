<?php
session_start();
include 'config.php';

if (!isset($_SESSION['guide_username'])) {
    echo json_encode(['success' => false, 'message' => 'Guide not logged in']);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $requestId = $_POST['id'];

    // Fetch guide details
    $guideUsername = $_SESSION['guide_username'];
    $sqlGuide = "SELECT id FROM guides WHERE username='$guideUsername'";
    $resultGuide = $conn->query($sqlGuide);
    
    if ($resultGuide->num_rows > 0) {
        $guide = $resultGuide->fetch_assoc();
        $guideId = $guide['id'];

        // Fetch request details to get student details
        $sqlRequest = "SELECT * FROM guide_requests WHERE id='$requestId'";
        $resultRequest = $conn->query($sqlRequest);

        if ($resultRequest->num_rows > 0) {
            $request = $resultRequest->fetch_assoc();
            $studentUsername = $request['student_username'];

            if ($action === 'accept') {
                // Update request status to accepted
                $sqlAccept = "UPDATE guide_requests SET status='accepted' WHERE id='$requestId' AND guide_id='$guideId'";
                if ($conn->query($sqlAccept) === TRUE) {
                    // Update student dashboard
                    $sqlUpdateStudent = "UPDATE student_dash_guides SET status='accepted' WHERE student_username='$studentUsername' AND guide_id='$guideId'";
                    $conn->query($sqlUpdateStudent);

                    echo json_encode(['success' => true, 'message' => 'Request accepted successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error accepting request: ' . $conn->error]);
                }
            } elseif ($action === 'reject') {
                // Update request status to rejected
                $sqlReject = "UPDATE guide_requests SET status='rejected' WHERE id='$requestId' AND guide_id='$guideId'";
                if ($conn->query($sqlReject) === TRUE) {
                    // Update student dashboard
                    $sqlUpdateStudent = "UPDATE student_dash_guides SET status='rejected' WHERE student_username='$studentUsername' AND guide_id='$guideId'";
                    $conn->query($sqlUpdateStudent);

                    echo json_encode(['success' => true, 'message' => 'Request rejected successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error rejecting request: ' . $conn->error]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid action.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Request details not found.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Guide not found.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close();
?>
