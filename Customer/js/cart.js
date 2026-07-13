// ==============================
// Cart Logic: Quantity + Remove
// ==============================

function updateCart() {

    const cartCards = document.querySelectorAll(".cart-card");

    let totalItems = 0;
    let grandTotal = 0;

    cartCards.forEach(card => {

        const qtyInput = card.querySelector(".quantity input");
        const priceEl = card.querySelector("h3");

        // unit price stored once as data attribute so it never gets overwritten
        if (!card.dataset.unitPrice) {
            card.dataset.unitPrice = parseFloat(
                priceEl.innerText.replace("Rs.", "")
            );
        }

        const unitPrice = parseFloat(card.dataset.unitPrice);
        const qty = parseInt(qtyInput.value) || 1;

        // update this item's line total (Rs.650 -> Rs.1300 if qty = 2)
        priceEl.innerText = "Rs." + (unitPrice * qty).toFixed(0);

        totalItems += qty;
        grandTotal += unitPrice * qty;

    });

    const itemsEl = document.querySelector("#summary-items");
    const subtotalEl = document.querySelector("#summary-subtotal");
    const totalEl = document.querySelector("#summary-total");
    const checkoutBtn = document.querySelector(".checkout-btn");

    if (itemsEl) itemsEl.innerText = totalItems;
    if (subtotalEl) subtotalEl.innerText = "Rs." + grandTotal.toFixed(0);
    if (totalEl) totalEl.innerText = "Rs." + grandTotal.toFixed(0); // pickup is FREE

    // handle empty cart
    if (cartCards.length === 0) {
        const cartLeft = document.querySelector(".cart-left") || document.body;
        if (!document.querySelector("#empty-cart-msg")) {
            const msg = document.createElement("p");
            msg.id = "empty-cart-msg";
            msg.innerText = "Your cart is empty.";
            cartLeft.appendChild(msg);
        }
        if (checkoutBtn) {
            checkoutBtn.classList.add("disabled");
            checkoutBtn.setAttribute("aria-disabled", "true");
        }
    }

}

function attachCardEvents(card) {

    const box = card.querySelector(".quantity");
    const minus = box.children[0];
    const input = box.children[1];
    const plus = box.children[2];
    const removeBtn = card.querySelector(".remove-btn");

    plus.onclick = () => {
        input.value = parseInt(input.value) + 1;
        updateCart();
    };

    minus.onclick = () => {
        if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
            updateCart();
        }
    };

    if (removeBtn) {
        removeBtn.onclick = () => {
            card.remove();
            updateCart();
        };
    }

}

// initialize on page load
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".cart-card").forEach(card => attachCardEvents(card));
    updateCart();
});