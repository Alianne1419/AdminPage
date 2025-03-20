<?php
// Replace with your database connection details
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_dbname";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$premiumMembers = [];
$regularMembers = [];

// Fetch Premium Members
$sqlPremium = "SELECT member_id, name, email, join_date, expiry_date, status FROM members WHERE membership_type = 'Premium'";
$resultPremium = $conn->query($sqlPremium);

if ($resultPremium->num_rows > 0) {
    while ($row = $resultPremium->fetch_assoc()) {
        $premiumMembers[] = $row;
    }
}

// Fetch Regular Members
$sqlRegular = "SELECT member_id, name, email, join_date FROM members WHERE membership_type = 'Regular'";
$resultRegular = $conn->query($sqlRegular);

if ($resultRegular->num_rows > 0) {
    while ($row = $resultRegular->fetch_assoc()) {
        $regularMembers[] = $row;
    }
}

$conn->close();

// Check if both arrays are empty
if (empty($premiumMembers) && empty($regularMembers)) {
    // Return empty arrays
    echo json_encode(['premium' => [], 'regular' => []]);
} else {
    // Return the data as usual
    echo json_encode(['premium' => $premiumMembers, 'regular' => $regularMembers]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members</title>
    <link rel="stylesheet" href="admin_sidebar_style.css">
    <link rel="stylesheet" href="view_members_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>
<body>
    <div class="sidebar close">
        <div class="logo">
            <span class="logo-name">Admin Panel</span>
        </div>
        <ul class="nav-list">
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-users"></i>
                        <span class="link-name">Memberships</span>
                    </a>
                    <i class="fas fa-caret-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="view_members.php">View Members</a></li>
                    <li><a href="#">Add Members</a></li>
                    <li><a href="#">Edit Members</a></li>
                    <li><a href="#">Membership Types</a></li>
                    <li><a href="#">Payments</a></li>
                    <li><a href="#">Documents</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-dumbbell"></i>
                        <span class="link-name">Fitness Management</span>
                    </a>
                    <i class="fas fa-caret-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="#">Class Schedule</a></li>
                    <li><a href="#">Instructors</a></li>
                    <li><a href="#">Training Sessions</a></li>
                    <li><a href="#">Resources Library</a></li>
                    <li><a href="#">Add Resources</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-comments"></i>
                        <span class="link-name">Community</span>
                    </a>
                    <i class="fas fa-caret-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="#">View Posts</a></li>
                    <li><a href="#">Manage Users</a></li>
                    <li><a href="#">Categories</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-bell"></i>
                        <span class="link-name">Notifications</span>
                    </a>
                    <i class="fas fa-caret-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="#">Send Notifications</a></li>
                    <li><a href="#">Email Templates</a></li>
                    <li><a href="#">Schedule Reminders</a></li>
                </ul>
            </li>
            <li>
                <div class="icon-link">
                    <a href="#">
                        <i class="fas fa-question-circle"></i>
                        <span class="link-name">Feedback</span>
                    </a>
                    <i class="fas fa-caret-down arrow"></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="#">View Feedback</a></li>
                    <li><a href="#">Manage Support</a></li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-cog"></i>
                    <span class="link-name">Settings</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-line"></i>
                    <span class="link-name">Reports</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="link-name">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="home-section">
        <div class="home-content">
            <i class="fas fa-bars toggle-btn"></i> <span class="text">View Members</span>
            <div class="breadcrumb">
                <a href="#">Home</a> / Memberships / View Members
            </div>
        </div>

        <div class="members-content">
            <h2>Premium Members</h2>
            <div class="table-container">
                <table id="premium-members-table">
                    <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Join Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6" class="data-placeholder">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2>Regular Members</h2>
            <div class="table-container">
                <table id="regular-members-table">
                    <thead>
                        <tr>
                            <th>Member ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Join Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="data-placeholder">Loading...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="admin_sidebar_jscript.js"></script>
    <script src="view_members_script.js"></script>
</body>
</html>