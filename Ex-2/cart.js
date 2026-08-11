// =====================================
// QUICKCART - CART.JS
// =====================================

// Get cart from Local Storage
let cart = JSON.parse(localStorage.getItem("cart")) || [];

const cartItems = document.getElementById("cart-items");
const totalPrice = document.getElementById("total-price");
const cartCount = document.getElementById("cart-count");

// Display cart when page loads
displayCart();

// =====================================
// DISPLAY CART
// =====================================

function displayCart(){

    cartItems.innerHTML = "";

    let total = 0;
    let items = 0;

    if(cart.length === 0){

        cartItems.innerHTML = `
        <div class="empty-cart">
            <h2>Your cart is empty 🛒</h2>
            <p>Looks like you haven't added anything yet.</p>
            <a href="index.html" class="btn">
                Continue Shopping
            </a>
        </div>
        `;

        totalPrice.innerHTML = "Total : ₹0";

        if(cartCount){
            cartCount.innerHTML = 0;
        }

        return;
    }

    cart.forEach((item,index)=>{

        total += item.price * item.quantity;
        items += item.quantity;

        cartItems.innerHTML += `

        <div class="cart-card">

            <div class="cart-info">

                <h3>${item.name}</h3>

                <p>Price : ₹${item.price}</p>

                <p>Quantity : ${item.quantity}</p>

                <h4>Subtotal : ₹${item.price * item.quantity}</h4>

            </div>

            <div class="cart-buttons">

                <button onclick="increase(${index})">+</button>

                <button onclick="decrease(${index})">−</button>

                <button class="remove-btn"
                onclick="removeItem(${index})">

                <i class="fa-solid fa-trash"></i>

                </button>

            </div>

        </div>

        `;

    });

    totalPrice.innerHTML = "Total : ₹" + total.toLocaleString();

    if(cartCount){
        cartCount.innerHTML = items;
    }

}

// =====================================
// INCREASE QUANTITY
// =====================================

function increase(index){

    cart[index].quantity++;

    saveCart();

}

// =====================================
// DECREASE QUANTITY
// =====================================

function decrease(index){

    if(cart[index].quantity > 1){

        cart[index].quantity--;

    }else{

        cart.splice(index,1);

    }

    saveCart();

}

// =====================================
// REMOVE ITEM
// =====================================

function removeItem(index){

    if(confirm("Remove this item from cart?")){

        cart.splice(index,1);

        saveCart();

    }

}

// =====================================
// SAVE CART
// =====================================

function saveCart(){

    localStorage.setItem("cart",JSON.stringify(cart));

    displayCart();

}