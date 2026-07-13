// ==============================
// Quantity Buttons
// ==============================

const cartCards = document.querySelectorAll(".cart-card");

function updateCart(){

    let totalItems = 0;
    let grandTotal = 0;

    cartCards.forEach(card=>{

        const qtyInput = card.querySelector(".quantity input");

        const price = parseFloat(
            card.querySelector("h3")
            .innerText.replace("Rs.","")
        );

        const qty = parseInt(qtyInput.value);

        totalItems += qty;

        grandTotal += price * qty;

    });

    document.querySelector("#summary-items").innerText = totalItems;

    document.querySelector("#summary-total").innerText =
        "Rs." + grandTotal.toFixed(2);

}

document.querySelectorAll(".quantity").forEach(box=>{

    const minus = box.children[0];

    const input = box.children[1];

    const plus = box.children[2];

    plus.onclick = ()=>{

        input.value++;

        updateCart();

    };

    minus.onclick = ()=>{

        if(input.value>1){

            input.value--;

            updateCart();

        }

    };

});