import renderCartList from "../cart/renderCartList";
import renderSummary from "../cart/renderOrderSummary";

const cartContainer = document.querySelector(".cart-container");
const totalCartItems = document.querySelector(".total-cart-items");
const cartItems = document.querySelector(".cart-items");
const totalCartItemCount = document.querySelector(".total-cart-item-count")
const totalCartItemContainer = document.querySelector(".total-cart-item-container")

export const emptyCart = (cartLength, cartItems) => {
    if (cartLength < 1) {
        cartItems.classList.add("hidden");
    } else {
        cartItems.classList.remove("hidden");
    }
};
export const getCartData = () => {
    const data = JSON.parse(localStorage.getItem("cartItems")) || {};
    return data.items || [];
};

export const saveCartData = (items) => {
    const subtotal = items.length > 0 ?  items.reduce((acc, item) => {
        const productPrice = item.product.discount_type
            ? item.product.display_price
            : item.product.sale_price;

        return acc + productPrice * item.quantity;
    }, 0) : 0
    const tax = subtotal * 0.1;
    const netTotal = subtotal + tax;

    localStorage.setItem(
        "cartItems",
        JSON.stringify({
            items,
            subtotal,
            tax,
            netTotal,
        })
    );
};

export const updateCart = () => {
    const cart = getCartData();
    renderCartList(cart, cartContainer);
    renderSummary(cart);
    totalCartItems.textContent = cart.length;
    if(cart.length > 0){
        totalCartItemContainer.classList.remove("hidden")
    }
    totalCartItemCount.textContent = cart.length
    emptyCart(cart.length, cartItems);
};
