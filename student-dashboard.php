<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: student-login.html');
    exit();
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: student-login.html");
    exit();
}

$username = $_SESSION['username'];

// Fetch guide allocation data for this student
$sql = "SELECT * FROM ad_allocation";
$guidesResult = $conn->query($sql);

if ($guidesResult === false) {
    die("Error fetching guide allocation data: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Allocation</title>
    <link rel="stylesheet" href="student.css">
</head>
<body>
    <div class="sidebar">
        <h2>Guide Allocation</h2>
        <ul>
            <li><a href="student-login.html">Back</a></li>
            <li><a href="#">Guidelines</a></li>
        </ul>
        <a href="index.html" class="logout">Logout</a>
    </div>
    <div class="content">
        <header>
            <input type="text" placeholder="Search for anything...">
            <div class="user-info">
                <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <span>MCE</span>
            </div>
        </header>
        <main>
            <h1>Welcome</h1>
            <table>
                <thead>
                    <tr>
                        <th>Guide Name</th>
                        <th>Total Slots</th>
                        <th>Alloted Slots</th>
                        <th>Remaining slots</th>
                        <th>Request</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $guidesResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['guide_name']); ?></td>
                        
                        <td><?php echo htmlspecialchars($row['slots']); ?></td>
                        <td>  </td>
                        <td>  </td>
                        <td>
                            <form action="form.html" method="post">
                                <input type="hidden" name="guide_name" value="<?php echo htmlspecialchars($row['guide_name']); ?>">
                                <button type="submit">Request Guide</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>
