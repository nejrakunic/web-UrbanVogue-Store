document.addEventListener("DOMContentLoaded", function () {
    // Load all trousers products when the page loads
    loadTrousers();
});

// Helper function to load trousers and display them in the category section
function loadTrousers() {
    const products = JSON.parse(localStorage.getItem("products")) || [];
    const trousersSection = document.getElementById("trousers-list");
    trousersSection.innerHTML = ""; // Clear the section before reloading

    // Filter the products to display only trousers
    const trousers = products.filter(product => product.category === "trousers");

    trousers.forEach(product => {
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

        const sizeSelection = document.createElement("div");
        sizeSelection.classList.add("product-size-selection");

        const sizeLabel = document.createElement("label");
        sizeLabel.setAttribute("for", `${product.name}-size`);
        sizeLabel.textContent = "Select Size:";

        const sizeSelect = document.createElement("select");
        sizeSelect.id = `${product.name}-size`;
        sizeSelect.name = "size";

        // Example sizes for trousers (adjust according to your products)
        const sizes = ["EU 40", "EU 42", "EU 44", "EU 46"];
        sizes.forEach(size => {
            const option = document.createElement("option");
            option.value = size.toLowerCase().replace(" ", "-");
            option.textContent = size;
            sizeSelect.appendChild(option);
        });

        const addToCartButton = document.createElement("button");
        addToCartButton.classList.add("product-btn");
        addToCartButton.textContent = "Add to Cart";

        addToCartButton.onclick = function () {
            const selectedSize = sizeSelect.value;
            addToCart(product.id, product.name, selectedSize, product.price);
        };

        // Append all elements
        sizeSelection.appendChild(sizeLabel);
        sizeSelection.appendChild(sizeSelect);
        productItem.appendChild(productImage);
        productItem.appendChild(productTitle);
        productItem.appendChild(productPrice);
        productItem.appendChild(sizeSelection);
        productItem.appendChild(addToCartButton);

        trousersSection.appendChild(productItem);
    });
}

// Example function to add product to the cart (you can replace it with your actual cart functionality)
function addToCart(productId, productName, productSize, productPrice) {
    console.log(`Added ${productName} (${productSize}) to cart for $${productPrice}`);
    // Add to the cart functionality can be implemented here
}
