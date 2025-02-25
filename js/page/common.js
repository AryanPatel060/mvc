// ------------------- header ------------------------------
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".header-category-link").forEach(function (categoryLink) {
        categoryLink.addEventListener("click", function (event) {
            let subMenu = this.nextElementSibling;
            
            // If submenu exists, toggle visibility
            if (subMenu && subMenu.classList.contains("header-category-submenu")) {
                event.preventDefault(); // Prevent default only when toggling
                subMenu.classList.toggle("show");
            } else {
                // Allow navigation if it's a leaf category
                window.location.href = this.href;
            }
        });
    });
});
