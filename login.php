<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles1.css">
</head>
<body>
    <div class="login-container">
        <?php

            if (isset($_POST["login"])) { // Corrected: Added name attribute check
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "config.php"; // Assuming database.php creates $conn

                $sql = "SELECT * FROM users WHERE email = '$email'"; // Corrected: Added * and concatenation
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        header("Location: index.php"); // Corrected: Moved inside if block
                        die();
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email does not match</div>";
                }
            }

        ?>
        <h2>LOGIN</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" name="login">Login</button> </form>

        <div class="register-link">
            Don't have an account? <a href="register.php">Register</a>
        </div>
    </div>
    <script src="script2.js"></script>
</body>
</html>