document.addEventListener("DOMContentLoaded", function () {
    // Load all shirts products when the page loads
    loadShirts();
});

// Helper function to load shirts and display them in the category section
function loadShirts() {
    const products = JSON.parse(localStorage.getItem("products")) || [];
    const shirtsSection = document.getElementById("Shirts-list");
    shirtsSection.innerHTML = ""; // Clear the section before reloading

    // Filter the products to display only shirts
    const shirts = products.filter(product => product.category === "Shirts");

    shirts.forEach(product => {
        const productItem = document.createElement("div");
        productItem.classList.add("product-item");

        const productImage = document.createElement("img");
        productImage.classList.add("product-image");
        productImage.src = `../assets/images/${product.image}`;
        productImage.alt = product.name;

        const productTitle = document.createElement("h3");
        productTitle.classList.add("product-title");
        productTitle.textContent = product.name;

        const productPrice = document.createElement("p");
        productPrice.classList.add("product-price");
        productPrice.textContent = `$${product.price}`;

        const addToCartButton = document.createElement("button");
        addToCartButton.classList.add("product-btn");
        addToCartButton.textContent = "Add to Cart";

        addToCartButton.onclick = function () {
            addToCart(product.id, product.name, "", product.price); // No size for shirts
        };

        // Append all elements
        productItem.appendChild(productImage);
        productItem.appendChild(productTitle);
        productItem.appendChild(productPrice);
        productItem.appendChild(addToCartButton);

        shirtsSection.appendChild(productItem);
    });
}

// Example function to add product to the cart (you can replace it with your actual cart functionality)
function addToCart(productId, productName, productSize, productPrice) {
    console.log(`Added ${productName} to cart for $${productPrice}`);
    // Add to the cart functionality can be implemented here
}
