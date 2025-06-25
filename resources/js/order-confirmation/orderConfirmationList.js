import renderSummary from "../cart/renderOrderSummary";
import { emptyCart, getCartData, saveCartData } from "../utils/cart";
import renderOrderedProductList from "./renderOrderedProductList";

const initializeOrderConfirmationList = () => {
    const container = document.querySelector(
        ".ordered-products-list-container"
    );
    const totalCartItems = document.querySelector(".total-cart-items");
    const cartItems = document.querySelector(".cart-items");

    if (!container) return;

    const cart = getCartData();
    console.log(cart);
    renderOrderedProductList(cart, container);

    const handleClick = (e) => {
        const redirectProductDetail = e.target.closest(".redirect-to-detail");
        const removeProductCart = e.target.closest(".ordered-product-remove");

        const orderedCartId = removeProductCart.dataset.orderedCartId;

        if (redirectProductDetail) {
            const productSlug = redirectProductDetail.dataset.detail;
            window.location.href = `/shop-product/${productSlug}`;
        }

        if (removeProductCart) {
            const cart = getCartData();
            const newCart = cart.filter(
                (cartItem) => cartItem.id !== Number(orderedCartId)
            );
            console.log(newCart);
            renderOrderedProductList(newCart, container);
            saveCartData(newCart);
            renderSummary(newCart);
            totalCartItems.textContent = newCart.length;
            emptyCart(newCart.length, cartItems);
            // updateCart()
        }
    };
    container.addEventListener("click", handleClick);
};
document.addEventListener("DOMContentLoaded", initializeOrderConfirmationList);
