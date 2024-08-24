<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align: center; padding: 15%;">
        <p style="font-size: 50px; font-weight: bold;">
            Hello <?php
            $email = $_SESSION['email'];
            $stmt = $conn->prepare("SELECT firstName, lastName FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($firstName, $lastName);
            if ($stmt->fetch()) {
                echo $firstName . ' ' . $lastName;
            } else {
                echo "User not found.";
            }
            $stmt->close();
            ?>
            :)
        </p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
