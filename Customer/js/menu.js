const buttons = document.querySelectorAll(".categories button");
const cards = document.querySelectorAll(".food-item");

buttons.forEach(button => {

    button.addEventListener("click", () => {

        // Remove active button
        buttons.forEach(btn =>
            btn.classList.remove("active-category")
        );

        // Highlight selected button
        button.classList.add("active-category");

        const filter = button.dataset.filter;

        cards.forEach(card => {

            if (filter === "all") {

                card.style.display = "flex";

            } else if (card.classList.contains(filter)) {

                card.style.display = "flex";

            } else {

                card.style.display = "none";

            }

        });

    });

});