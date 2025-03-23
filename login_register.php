<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M3 Membership System</title>
    <link rel="stylesheet" href="styles1.css">
</head>
<body>
    <div class="container">
        <div id="home-page">
            <h1>Welcome to M3 Membership System</h1>
            <p>Your one-stop solution for managing memberships.</p>
            <button id="loginBtn">Login</button>
            <button id="registerBtn">Register</button>
        </div>

        <div class="form-box" id="login-form" style="display: none;">
            <form id="loginForm">
                <h2>Login</h2>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <p>Don't have an account? <a href="#" id="showRegisterLink">Register</a></p>
            </form>
        </div>
        
        <div class="form-box" id="register-form" style="display: none;">
            <form id="registerForm">
                <h2>Register</h2>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="">Please Select Role</option>
                    <option value="user">User </option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit">Register</button>
                <p>Already have an account? <a href="#" id="showLoginLink">Login</a></p>
            </form>
        </div>
        
        <div class="dashboard" id="dashboard" style="display: none;">
            <h2>Dashboard</h2>
            <p>Welcome to your dashboard!</p>
            <p><a href="#" id="logoutLink">Logout</a></p>
        </div>
    </div> 

    <script src="script2.js"></script>
</body>
</html>