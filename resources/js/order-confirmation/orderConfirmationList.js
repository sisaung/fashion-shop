import renderSummary from "../cart/renderOrderSummary";
import { emptyCart, getCartData, saveCartData } from "../utils/cart";
import renderOrderedProductList from "./renderOrderedProductList";
import renderOrderSummary from "./renderOrderSummary";

const initializeOrderConfirmationList = () => {
    const container = document.querySelector(
        ".ordered-products-list-container"
    );
    const totalCartItems = document.querySelector(".total-cart-items");
    const cartItems = document.querySelector(".cart-items");

    if (!container) return;

    const cart = getCartData();

    renderOrderedProductList(cart, container);
    renderOrderSummary(cart);

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
            renderOrderedProductList(newCart, container);
            saveCartData(newCart);
            renderOrderSummary(newCart);
            totalCartItems.textContent = newCart.length;
            emptyCart(newCart.length, cartItems);

            // updateCart()
        }
    };
    container.addEventListener("click", handleClick);
};
document.addEventListener("DOMContentLoaded", initializeOrderConfirmationList);
