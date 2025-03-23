<!DOCTYPE html>
<html>
<head>
    <title>M3 Membership Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="index.js"></script>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="wellness.png" alt="M3 Logo">
            <span>M3 Membership Management</span>
        </div>
        <div class="nav">
            <a href="#faqs">FAQs</a>
            <a href="#about-us">About Us</a>
            <div class="profile-icon" onclick="toggleProfileMenu()">
                <img src="profile_icon.png" alt="Profile">
                <div class="profile-menu" id="profileMenu">
                    <a href="register.php">Register</a>
                    <a href="login.php">Log In</a>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="text-container">
            <h1>M3 MEMBERSHIP</h1>
            <p>Your one-stop solution for membership management</p>
            <a href="register.php" class="join-now">JOIN NOW</a>
        </div>
    </div>

    <div class="faqs" id="faqs">
        <h2>FAQs</h2>
        <p>Frequently asked questions about our services.</p>
    </div>

    <div class="about-us" id="about-us">
        <h2>About Us</h2>
        <p>Gym Information:</p>
        <p>Address: [Your Gym Address]</p>
        <p>Contact: [Your Gym Contact]</p>
        <p>Email: [Your Gym Email]</p>
    </div>
</body>
</html>