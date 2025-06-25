import renderCartList from "./renderCartList";
import renderSummary from "./renderOrderSummary";

const emptyCart = (cartLength, cartItems) => {
    if (cartLength < 1) {
        cartItems.classList.add("hidden");
    } else {
        cartItems.classList.remove("hidden");
    }
};

const initializeCartList = () => {
    const cartContainer = document.querySelector(".cart-container");
    const totalCartItems = document.querySelector(".total-cart-items");
    const cartItems = document.querySelector(".cart-items");
    const increaseQtyBtn = document.querySelectorAll(".cart-increase-qty");

    const getCartData = () => {
        const data = JSON.parse(localStorage.getItem("cartItems")) || {};
        return data.items || [];
    };

    const saveCartData = (items) => {
        const subtotal = items.reduce((acc, item) => {
            const productPrice = item.product.discount_percentage
                ? item.product.display_price
                : item.product.sale_price;
            return acc + productPrice * item.quantity;
        }, 0);
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

    const updateCart = () => {
        const cart = getCartData();
        renderCartList(cart, cartContainer);
        renderSummary(cart);
        totalCartItems.textContent = cart.length;
        emptyCart(cart.length, cartItems);
    };



    const handleClick = (e) => {
        const cart = getCartData();

        const increaseQty = e.target.closest(".cart-increase-qty");
        const decreaseQty = e.target.closest(".cart-decrease-qty");
        const removeCart = e.target.closest(".cart-item-remove");

        if (increaseQty) {
            const cartId = Number(increaseQty.dataset.cartId);
            const size = increaseQty.dataset.cartSize;

            const index = cart.findIndex(
                (item) => item.id === cartId && item.size == size
            );

            if (index !== -1) {
                const stocks = cart[index].product.stocks;

                stocks.forEach((stock) => {
                    if (
                        stock.size.size_name == size &&
                        stock.stock_quantity > cart[index].quantity
                    ) {
                        cart[index].quantity += 1;
                    } else {
                        // increaseQty.disabled = true;
                        // increaseQty.classList.add("opacity-30", "pointer-events-none");
                    }
                });

                saveCartData(cart);
                updateCart();
            }
        }

        if (decreaseQty) {
            const cartId = decreaseQty.dataset.cartId;
            const size = decreaseQty.dataset.cartSize;

            const currentCartId = cart.findIndex(
                (item) => item.id === Number(cartId) && item.size == size
            );

            if (cart[currentCartId]?.quantity <= 1) {
                const filteredCart = cart.filter(
                    (item) =>
                        item.id !== Number(currentCartId) && item.size !== size
                );

                saveCartData(filteredCart);
                updateCart(filteredCart, cartContainer);
            } else {
                cart[currentCartId].quantity -= 1;
                saveCartData(cart);
                updateCart(cart, cartContainer);
            }
        }

        if (removeCart) {
            const cartId = Number(removeCart.dataset.cartId);
            const size = removeCart.dataset.cartSize;

            const newCart = cart.filter(
                (item) => !(item.id === cartId && item.size == size)
            );

            saveCartData(newCart);
            updateCart();
        }
    };

    cartContainer.addEventListener("click", handleClick);
    updateCart(); // Run once on page load
};

document.addEventListener("DOMContentLoaded", initializeCartList);
