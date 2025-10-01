document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("searchToggle");
    const searchBar = document.getElementById("searchBar");

    if (toggleButton && searchBar) {
        toggleButton.addEventListener("click", function () {
            searchBar.classList.toggle("active");
        });
    }
});
