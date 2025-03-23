document.addEventListener("DOMContentLoaded", function () {
    console.log("Checking login status...");

    if (window.location.pathname.includes("cart.html")) {
        const username = getLoggedInUser();
        if (!username) {
            alert("You must be logged in to access the cart.");
            window.location.href = "login.html"; 
            return;
        }

        // Load cart for the specific user
        displayCart(username);

        // Checkout button click
        document.getElementById("checkout-btn").addEventListener("click", function () {
            saveCartObject(username); // Save the cart object before proceeding
            checkout(username);
        });
    }
});

// Helper function to get logged-in user's username
function getLoggedInUser() {
    const storedUser = localStorage.getItem("loggedInUser");
    return storedUser ? JSON.parse(storedUser).username : null;
}

function getUserCart(username) {
    return JSON.parse(localStorage.getItem(`cart_${username}`)) || [];
}

function saveUserCart(username, cart) {
    localStorage.setItem(`cart_${username}`, JSON.stringify(cart));
}

function calculateTotal(cart) {
    return cart.reduce((acc, item) => acc + (item.price * item.quantity), 0).toFixed(2);
}

function displayCart(username) {
    const cartItemsContainer = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");

    let cart = getUserCart(username);
    cartItemsContainer.innerHTML = "";

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = "<p class='empty-cart'>Your cart is empty.</p>";
        cartTotal.textContent = "$0.00";
        return;
    }

    let total = 0;
    cart.forEach(item => {
        const itemDiv = document.createElement("div");
        itemDiv.classList.add("cart-item");

        

        const itemName = document.createElement("span");
        itemName.classList.add("item-name");
        itemName.textContent = `${item.name} (Size: ${item.size}) x${item.quantity}`;

        const itemPrice = document.createElement("span");
        itemPrice.classList.add("item-price");
        itemPrice.textContent = `$${(item.price * item.quantity).toFixed(2)}`;

        const removeButton = document.createElement("button");
        removeButton.classList.add("remove-btn");
        removeButton.textContent = "Remove One";
        removeButton.onclick = () => removeOneItemFromCart(username, item.id, item.size);

        // Append elements
        
        itemDiv.appendChild(itemName);
        itemDiv.appendChild(itemPrice);
        itemDiv.appendChild(removeButton);
        cartItemsContainer.appendChild(itemDiv);

        total += item.price * item.quantity;
    });

    cartTotal.textContent = `$${total.toFixed(2)}`;
    localStorage.setItem(`cartTotal_${username}`, total.toFixed(2));

    // Save cart object
    saveCartObject(username);

    console.log("Cart items:", cart);

}


function removeOneItemFromCart(username, productId, productSize) {
    let cart = getUserCart(username);
    const itemIndex = cart.findIndex(item => item.id === productId && item.size === productSize);

    if (itemIndex !== -1) {
        if (cart[itemIndex].quantity > 1) {
            cart[itemIndex].quantity -= 1;
        } else {
            cart.splice(itemIndex, 1);
        }
    }

    saveUserCart(username, cart);

    console.log(cart);
    displayCart(username);
}

// Function to save the cart object to localStorage
function saveCartObject(username) {
    let cart = getUserCart(username);

    const cartObject = {
        id: Date.now(), // Unique ID for this cart session
        user: username,
        items: cart,
        totalAmount: calculateTotal(cart)
    };

    localStorage.setItem(`cartObject_${username}`, JSON.stringify(cartObject));
}

function checkout(username) {
    let cart = getUserCart(username);

    if (cart.length === 0) {
        alert("Your cart is empty. Add items first.");
        return;
    }

    localStorage.setItem(`cartTotal_${username}`, calculateTotal(cart));
    window.location.href = "checkout.html";
}

function logout() {
    localStorage.removeItem("loggedInUser");
    window.location.href = "login.html";
}

function addToCart(productId, productName, productSize, productPrice, productImage) {
    const username = getLoggedInUser();
    if (!username) {
        alert("You must be logged in to add items to the cart.");
        window.location.href = "login.html"; 
        return;
    }

    let cart = getUserCart(username);
    const existingItemIndex = cart.findIndex(item => item.id === productId && item.size === productSize);

    if (existingItemIndex !== -1) {
        cart[existingItemIndex].quantity += 1;
    } else {
        if (!productImage) {
            console.warn("Missing image for product:", productName);
            productImage = "placeholder.png"; // Use a default image
        }
        cart.push({ 
            id: productId, 
            name: productName, 
            size: productSize, 
            price: productPrice, 
            quantity: 1, 
            image: productImage // Ensure image is stored
        });
    }

    saveUserCart(username, cart);
    saveCartObject(username); 
    alert("Item added to cart!");
}


