// Optional: JavaScript to close dropdown when clicking outside of it
document.addEventListener('click', function (e) {
    const dropdown = document.querySelector('.dropdown-content');
    if (!e.target.closest('.dropdown')) {
        dropdown.style.display = 'none';
    }
});
