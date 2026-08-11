// ===============================
// QUICKCART SCRIPT
// ===============================

// Load cart from Local Storage
let cart = JSON.parse(localStorage.getItem("cart")) || [];

// Update cart count when page loads
updateCartCount();


// ===============================
// ADD TO CART
// ===============================

function addToCart(name, price){

    let existing = cart.find(item => item.name === name);

    if(existing){

        existing.quantity++;

    }else{

        cart.push({

            name:name,

            price:price,

            quantity:1

        });

    }

    localStorage.setItem("cart",JSON.stringify(cart));

    updateCartCount();

    showToast(name + " added to cart");

}



// ===============================
// UPDATE CART COUNT
// ===============================

function updateCartCount(){

    let total = 0;

    cart.forEach(item=>{

        total += item.quantity;

    });

    const cartCount = document.getElementById("cart-count");

    if(cartCount){

        cartCount.innerHTML = total;

    }

}



// ===============================
// SEARCH PRODUCTS
// ===============================

const search = document.getElementById("search");

if(search){

search.addEventListener("keyup",function(){

    const value = this.value.toLowerCase();

    const cards = document.querySelectorAll(".card");

    cards.forEach(card=>{

        const title = card.querySelector("h3").innerText.toLowerCase();

        if(title.includes(value)){

            card.style.display="block";

        }else{

            card.style.display="none";

        }

    });

});

}



// ===============================
// TOAST MESSAGE
// ===============================

function showToast(message){

    const toast = document.createElement("div");

    toast.className="toast";

    toast.innerHTML=message;

    document.body.appendChild(toast);

    setTimeout(()=>{

        toast.classList.add("show");

    },100);

    setTimeout(()=>{

        toast.classList.remove("show");

        setTimeout(()=>{

            toast.remove();

        },300);

    },2500);

}



// ===============================
// SMOOTH SCROLL FOR BUTTONS
// ===============================

document.querySelectorAll('a[href^="#"]').forEach(anchor=>{

    anchor.addEventListener("click",function(e){

        e.preventDefault();

        document.querySelector(this.getAttribute("href"))
        .scrollIntoView({

            behavior:"smooth"

        });

    });

});