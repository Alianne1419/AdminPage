let btn = document.querySelector(".toggle-btn"); // Correct selector

let sidebar = document.querySelector(".sidebar");

btn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

let arrows = document.querySelectorAll(".arrow");
for (let i = 0; i < arrows.length; i++) {
    arrows[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement;
        arrowParent.classList.toggle("show");
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const logoutLink = document.querySelector('.fa-sign-out-alt').parentElement;
    const logoutModal = document.getElementById('logoutModal');
    const confirmLogoutButton = document.getElementById('confirmLogoutButton');
    const cancelLogoutButton = document.getElementById('cancelLogoutButton');

    logoutLink.addEventListener('click', function(e) {
        e.preventDefault();
        console.log("Logout link clicked!");
        logoutModal.style.display = 'block';
    });

    confirmLogoutButton.addEventListener('click', function() {
        window.location.href = 'logout.php';
    });

    cancelLogoutButton.addEventListener('click', function() {
        logoutModal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === logoutModal) {
            logoutModal.style.display = 'none';
        }
    });
});