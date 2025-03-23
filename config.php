<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "root";
$dbName = "login_register";
$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Example: Handling registration data from POST request (adjust as needed)
if (isset($_POST["register"])) {
    $name = $_POST["firstname"] . " " . $_POST["lastname"]; // Assuming you have firstname and lastname in POST
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password

    $stmt = $conn->prepare("INSERT INTO registration (name, email, password) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sss", $name, $email, $password);
        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// Close the connection when you're done
if (isset($conn)) {
    $conn->close();
}

?>