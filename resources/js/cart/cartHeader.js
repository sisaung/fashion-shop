const initializeCartHeader = () => {
    const totalCartItems = document.querySelector(".total-cart-items");
    const cartItems = document.querySelector(".cart-items");

    const cart = JSON.parse(localStorage.getItem("cartItems")) || {items:[], subtotal: 0, tax: 0, netTotal: 0};

    totalCartItems.textContent = cart.items.length || 0;
    if (cartItems.classList.contains("hidden") && cart.items.length > 0) {
        cartItems.classList.remove("hidden");
    }
};

document.addEventListener("DOMContentLoaded", initializeCartHeader);
