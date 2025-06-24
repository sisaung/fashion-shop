const initializeCartHeader = () => {
    const totalCartItems = document.querySelector(".total-cart-items");
    const cartItems = document.querySelector(".cart-items");

    const cart = JSON.parse(localStorage.getItem("cartItems")) || [];
    console.log(cart.items.length);

    totalCartItems.textContent = cart.items.length;
    if (cartItems.classList.contains("hidden") && cart.items.length > 0) {
        cartItems.classList.remove("hidden");
    }
};

document.addEventListener("DOMContentLoaded", initializeCartHeader);
