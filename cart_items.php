<?php
include "includes/header.php";

?>
<div class="container " >
<div class="row" id="cart-container">
    
</div>
</div>

<?php
include "includes/footer.php";

?>
<script>
    document.addEventListener("DOMContentLoaded", displayCartItems);

    function removeFromCart(productId) {
    let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];

    // Filter out the product with the given ID
    cartItems = cartItems.filter(product => product.id !== productId);

    // Update localStorage
    localStorage.setItem("cartItems", JSON.stringify(cartItems));

    // Refresh the cart display
    displayCartItems();
}

    function displayCartItems() {
        let cartItems = JSON.parse(localStorage.getItem("cartItems")) || [];
        let cartContainer = document.getElementById("cart-container");

        cartContainer.innerHTML = ""; // Clear previous content

        if (cartItems.length === 0) {
            cartContainer.innerHTML = "<p>No items in cart.</p>";
            return;
        }

        cartItems.forEach((product, index) => {
            cartContainer.innerHTML += `
            <div class="col-md-6">
            <div class="card my-2">
                <div class="card-body">
                    <p><strong>Name:</strong> ${product.name}</p>
                    <p><strong>Brand:</strong> ${product.brand}</p>
                    <p><strong>Type:</strong> ${product.type}</p>
                    <p><strong>Stock Available:</strong> ${product.stock_available}</p>
                    <p><strong>Price:</strong> $${product.selling_price}</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-danger" onclick="removeFromCart(${product.id})"><i class="bi bi-trash"></i> Remove</button>
                    <button class="btn btn-success" "><a class="text-decoration-none text-light" href="checkout.php?product_id=${product.id}">Order Now</a></button>
                </div>
            </div>
            </div>
        `;
        });
    }
</script>