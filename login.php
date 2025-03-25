<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles1.css">
</head>
<body>
    <div class="login-container">
        <?php
        session_start(); // Start the session

        if (isset($_POST["login"])) {
            $email = trim($_POST["email"]); // Trim whitespace
            $password = trim($_POST["password"]); // Trim whitespace

            if (empty($email) || empty($password)) {
                echo "<div class='alert alert-danger'>Email and password are required</div>";
            } else {
                require_once "config.php";

                $sql = "SELECT * FROM loginregister WHERE email = ?";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    if ($user) {
                        if (password_verify($password, $user["password"])) {
                            $_SESSION["user_id"] = $user["id"]; // Store user ID in session
                            $_SESSION["user_email"] = $user["email"]; // Store user email in session
                            header("Location: admin_dashboard.php");
                            die();
                        } else {
                            echo "<div class='alert alert-danger'>Password does not match</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Email does not match</div>";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    error_log("Database error: " . mysqli_error($conn)); // Log the error
                    echo "<div class='alert alert-danger'>Database error: Please try again later.</div>";
                }
            }
        }

        ?>
        <h2>LOGIN</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <button type="submit" name="login">Login</button>
        </form>

        <div class="register-link">
            Don't have an account? <a href="register.php">Register</a>
        </div>
    </div>
    <script src="script2.js"></script>
</body>
</html>