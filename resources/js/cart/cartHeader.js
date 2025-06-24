const initializeCartHeader = () => {
    const totalCartItems = document.querySelector(".total-cart-items");
    const cartItems = document.querySelector(".cart-items");

    const cart = JSON.parse(localStorage.getItem("cartItems")) || [];

    totalCartItems.textContent = cart.length;
    if (cartItems.classList.contains("hidden") && cart.length > 0) {
        cartItems.classList.remove("hidden");
    }
};

document.addEventListener("DOMContentLoaded", initializeCartHeader);
