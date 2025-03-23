<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles1.css">
</head>
<body>

    <div class="register-container">
<?php

// Validate the submit button
if (isset($_POST["register"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];
    
    $passwordhash = password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($repeatPassword)) {
        array_push($errors, "All fields are required");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
    }
    if (strlen($password) < 8) {
        array_push($errors, "Password must be at least 8 characters long");
    }
    if ($password != $repeatPassword) {
        array_push($errors, "Passwords do not match");
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        require_once "config.php"; // Make sure config.php creates $conn
        $sql = "INSERT INTO user(Last_Name, First_Name, email, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn); // initializes a statement and returns an object suitable for mysqli_stmt_prepare()
        $preparestmt = mysqli_stmt_prepare($stmt, $sql);
        if ($preparestmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $lastname, $firstname, $email, $passwordhash); // Corrected variable and function names
            mysqli_stmt_execute($stmt); // Corrected function name
            echo "<div class='alert alert-success'>You are Registered Successfully!</div>"; // Corrected alert class
        } else {
            die("Something went wrong");
        }
    }
}

?>
        <h2>REGISTER</h2>
        <form action="register.php" method="post">

            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" required>

            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="repeatPassword">Repeat Password</label>
            <input type="password" name="repeatPassword" id="repeatPassword" required>

            <button type="submit" name="register">Register</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>
    <script src="script2.js"></script>
</body>
</html>