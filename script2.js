document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript Loaded Successfully!"); // Debugging check

    
    const loginBtn = document.getElementById("loginBtn");
    const registerBtn = document.getElementById("registerBtn");
    const showRegisterLink = document.getElementById("showRegisterLink");
    const showLoginLink = document.getElementById("showLoginLink");
    const logoutLink = document.getElementById("logoutLink");

    
    const homePage = document.getElementById("home-page");
    const loginForm = document.getElementById("login-form");
    const registerForm = document.getElementById("register-form");
    const dashboard = document.getElementById("dashboard");

    
    function showSection(section) {
        homePage.style.display = "none";
        loginForm.style.display = "none";
        registerForm.style.display = "none";
        dashboard.style.display = "none";

        section.style.display = "block";
    }
    
    if (loginBtn) loginBtn.addEventListener("click", function () { showSection(loginForm); });
    if (registerBtn) registerBtn.addEventListener("click", function () { showSection(registerForm); });
    if (showRegisterLink) showRegisterLink.addEventListener("click", function () { showSection(registerForm); });
    if (showLoginLink) showLoginLink.addEventListener("click", function () { showSection(loginForm); });
    if (logoutLink) logoutLink.addEventListener("click", function () { 
        alert("You have logged out."); 
        showSection(homePage);
    });

    
    document.getElementById('registerForm').addEventListener('submit', function (event) {
        event.preventDefault();
        alert("Registration successful!");
        showSection(loginForm);
    });

    
    document.getElementById('loginForm').addEventListener('submit', function (event) {
        event.preventDefault();
        alert("Login successful!");
        showSection(dashboard);
    });
});