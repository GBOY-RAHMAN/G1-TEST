// script.js

document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.getElementById("menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    const menuOpenIcon = document.getElementById("menu-open-icon");
    const menuCloseIcon = document.getElementById("menu-close-icon");

    menuToggle.addEventListener("click", function() {
        mobileMenu.classList.toggle("hidden");
        menuOpenIcon.classList.toggle("hidden");
        menuCloseIcon.classList.toggle("hidden");
    });
});

const toggleButton = document.getElementById('toggleButton');
        const sidebar = document.getElementById('sidebar');
        const arrowIcon = document.getElementById('arrowIcon');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('w-14');
            sidebar.classList.toggle('w-40');
            arrowIcon.classList.toggle('rotate-180');
            const spans = sidebar.querySelectorAll('span');
            spans.forEach(span => {
                span.classList.toggle('hidden');
            });
        });