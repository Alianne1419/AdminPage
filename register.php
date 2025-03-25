<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles1.css">
</head>
<body>
    <div class="register-container">
        <?php
        $errors = array();
        $firstname = "";
        $lastname = "";
        $email = "";
        $passwordhash = "";

        if (isset($_POST["register"])) {
            $firstname = trim($_POST["firstname"]);
            $lastname = trim($_POST["lastname"]);
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            $repeatPassword = trim($_POST["repeatPassword"]);

            // Input Validation
            if (empty($firstname)) {
                $errors[] = "First name is required";
            }
            if (empty($lastname)) {
                $errors[] = "Last name is required";
            }
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
            if (empty($password) || strlen($password) < 8) {
                $errors[] = "Password must be at least 8 characters";
            }
            if ($password !== $repeatPassword) {
                $errors[] = "Passwords do not match";
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                require_once "config.php";

                if (!$conn) {
                    die("Database connection failed: " . mysqli_connect_error());
                }

                $passwordhash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO loginregister(Last_Name, First_Name, email, password) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "ssss", $lastname, $firstname, $email, $passwordhash);
                    if (mysqli_stmt_execute($stmt)) {
                        echo "<div class='alert alert-success'>You are Registered Successfully!</div>";
                    } else {
                        if (mysqli_errno($conn) == 1062) {
                            echo "<div class='alert alert-danger'>Email is already in use.</div>";
                        } else {
                            error_log("Database error: " . mysqli_stmt_error($stmt));
                            echo "<div class='alert alert-danger'>Database error: Please try again later.</div>";
                        }
                    }
                } else {
                    error_log("Database error: " . mysqli_error($conn));
                    echo "<div class='alert alert-danger'>Database error: Please try again later.</div>";
                }
                mysqli_stmt_close($stmt);
            }
        }
        if (isset($conn)) {
            mysqli_close($conn);
        }
        ?>
        <h2>REGISTER</h2>
        <form action="register.php" method="post">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" id="firstname" value="<?php echo htmlspecialchars($firstname); ?>" required>

            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo htmlspecialchars($lastname); ?>" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>

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