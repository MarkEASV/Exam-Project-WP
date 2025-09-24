document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("searchToggle");
    const searchBar = document.getElementById("searchBar");

    if (toggleBtn && searchBar) {
        toggleBtn.addEventListener("click", function () {
            searchBar.classList.toggle("active");
        });
    }
});