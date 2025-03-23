function toggleProfileMenu() {
    const profileMenu = document.getElementById('profileMenu');
    profileMenu.style.display = profileMenu.style.display === 'block' ? 'none' : 'block';
}

// Close profile menu when clicking outside
document.addEventListener('click', function(event) {
    const profileIcon = document.querySelector('.profile-icon');
    const profileMenu = document.getElementById('profileMenu');
    if (!profileIcon.contains(event.target)) {
        profileMenu.style.display = 'none';
    }
});