import renderCartList from "./renderCartList";
import renderSummary from "./renderOrderSummary";

const emptyCard = (cartLength, cartItems) => {
    if (cartLength < 1) {
        cartItems.classList.add("hidden");
    }
};

const initializeCartList = () => {
    const cart = JSON.parse(localStorage.getItem("cartItems")) || [];
    const cartContainer = document.querySelector(".cart-container");
    const totalCartItems = document.querySelector(".total-cart-items");
    const cartItems = document.querySelector(".cart-items");


    const updateCart = () => {
        const cart = JSON.parse(localStorage.getItem("cartItems")) || [];
        renderCartList(cart, cartContainer);
        renderSummary(cart);
    };



    const handleClick = (e) => {
        const cart = JSON.parse(localStorage.getItem("cartItems")) || [];
        const increaseQty = e.target.closest(".cart-increase-qty");
        const decreaseQty = e.target.closest(".cart-decrease-qty");
        const removeCart = e.target.closest(".cart-item-remove");

        if (increaseQty) {
            const cartId = increaseQty.dataset.cartId;
            const size = increaseQty.dataset.cartSize;

            const currentCartId = cart.findIndex(
                (item) => item.id == cartId && item.size == size
            );

            cart[currentCartId].quantity += 1;
            localStorage.setItem("cartItems", JSON.stringify(cart));
            updateCart(cart, cartContainer);
        }

        if (decreaseQty) {
            const cartId = decreaseQty.dataset.cartId;
            const size = decreaseQty.dataset.cartSize;

            const currentCartId = cart.findIndex(
                (item) => item.id === Number(cartId)
            );

            if (cart[currentCartId].quantity <= 1) {
                const filteredCart = cart.filter(
                    (item) =>
                        item.id !== Number(currentCartId) && item.size !== size
                );

                localStorage.setItem("cartItems", JSON.stringify(filteredCart));
                updateCart(filteredCart, cartContainer);

                emptyCard(filteredCart.length, cartItems);
            } else {
                cart[currentCartId].quantity -= 1;
                localStorage.setItem("cartItems", JSON.stringify(cart));
                updateCart(cart, cartContainer);
            }
        }

        if (removeCart) {
            const cartId = Number(removeCart.dataset.cartId);
            const size = removeCart.dataset.size;

            const newCart = cart.filter((item) => item.id !== Number(cartId));

            totalCartItems.textContent = newCart.length;

            emptyCard(newCart.length, cartItems);

            localStorage.setItem("cartItems", JSON.stringify(newCart));
            updateCart(newCart, cartContainer);
        }
    };

    cartContainer.addEventListener("click", handleClick);
    updateCart();
};

document.addEventListener("DOMContentLoaded", initializeCartList);
