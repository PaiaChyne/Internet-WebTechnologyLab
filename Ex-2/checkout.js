// =======================================
// QUICKCART CHECKOUT
// =======================================

let cart = JSON.parse(localStorage.getItem("cart")) || [];

const summaryItems = document.getElementById("summary-items");
const summaryTotal = document.getElementById("summary-total");

displaySummary();

function displaySummary(){

    let total = 0;

    if(cart.length === 0){

        summaryItems.innerHTML = `
            <h3>Your cart is empty.</h3>
            <a href="index.html" class="btn">
                Continue Shopping
            </a>
        `;

        summaryTotal.innerHTML = "Total : ₹0";

        return;
    }

    summaryItems.innerHTML = "";

    cart.forEach(item=>{

        total += item.price * item.quantity;

        summaryItems.innerHTML += `

        <div class="summary-card">

            <h4>${item.name}</h4>

            <p>
                ₹${item.price} × ${item.quantity}
            </p>

            <hr>

        </div>

        `;

    });

    summaryTotal.innerHTML = "Total : ₹" + total.toLocaleString();

}

// =======================================
// PLACE ORDER
// =======================================

const form = document.getElementById("checkoutForm");

form.addEventListener("submit",function(e){

    e.preventDefault();

    if(cart.length===0){

        alert("Your cart is empty.");

        return;

    }

    alert("🎉 Order Placed Successfully!\n\nThank you for shopping with QuickCart.");

    // Clear cart

    localStorage.removeItem("cart");

    // Redirect to home page

    window.location.href="index.html";

});