const buttons = document.querySelectorAll(".categories button");
const cards = document.querySelectorAll(".food-item");
const searchInput = document.querySelector(".search-box input");

function getActiveFilter() {
    const activeBtn = document.querySelector(".categories button.active-category");
    return activeBtn ? activeBtn.dataset.filter : "all";
}

function applyFilters() {

    const filter = getActiveFilter();
    const searchTerm = searchInput.value.trim().toLowerCase();

    cards.forEach(card => {

        const matchesCategory = (filter === "all") || card.classList.contains(filter);

        const name = card.querySelector("h3").textContent.toLowerCase();
        const desc = card.querySelector(".food-desc").textContent.toLowerCase();
        const matchesSearch = name.includes(searchTerm) || desc.includes(searchTerm);

        if (matchesCategory && matchesSearch) {
            card.style.display = "flex";
        } else {
            card.style.display = "none";
        }

    });

}

// Category button clicks
buttons.forEach(button => {

    button.addEventListener("click", () => {

        // Remove active button
        buttons.forEach(btn =>
            btn.classList.remove("active-category")
        );

        // Highlight selected button
        button.classList.add("active-category");

        applyFilters();

    });

});

// Live search as user types
searchInput.addEventListener("input", applyFilters);