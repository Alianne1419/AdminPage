<?php
// Replace with your database connection details
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed.']));
}

$name = $_POST['name'];
$email = $_POST['email'];
$join_date = $_POST['join_date'];
$expiry_date = $_POST['expiry_date'];
$membership_type = $_POST['membership_type'];

$sql = "INSERT INTO members (name, email, join_date, expiry_date, membership_type) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $email, $join_date, $expiry_date, $membership_type);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>