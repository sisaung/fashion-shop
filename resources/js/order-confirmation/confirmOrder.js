import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";
import storeOrder from "../services/storeOrder";
import { emptyCart } from "../utils/cart";
import { showErrorToast, showSuccessToast } from "../utils/handleToast";
import renderOrderedProductList from "./renderOrderedProductList";
import renderOrderSummary from "./renderOrderSummary";

const initalizeConfirmOrder = () => {
    const container = document.querySelector(".confirm-order");
    const currentUser = document.querySelector(".current-user");
    const currentUserObj = JSON.parse(currentUser?.value) || {};
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    const containerOrderedProductsList = document.querySelector(
        ".ordered-products-list-container"
    );
    const totalCartItems = document.querySelector(".total-cart-items");
    const cartItems = document.querySelector(".cart-items");

    if (!container) return;

    const handleOrderConfirmBtn = async () => {
        const selectedAddress = document.querySelector(
            ".select-address.active-address"
        );
        const couponId = document.querySelector(".coupon-id");

        const addressId = selectedAddress
            ? selectedAddress.dataset.addressId
            : null;

        const cart = JSON.parse(localStorage.getItem("cartItems")) || {
            items: [],
            subtotal: 0,
            tax: 0,
            netTotal: 0,
        };

        if (!addressId) {
            // showErrorToast("Please select an address to place the order");
            Toastify({
                text: "Please select an address to place the order",
                duration: 3000,
                gravity: "top",
                position: "center",
                stopOnFocus: false,
                style: {
                    background: "#fee2e2",
                    fontSize: "14px",
                    color: "red",
                    boxShadow: "0px",
                },
            }).showToast();
            return;
        } else if (cart.items.length == 0) {
            // showErrorToast("Your cart is empty");
            Toastify({
                text: "Your cart is empty",
                duration: 3000,
                stopOnFocus: false,
                gravity: "top",
                position: "right",
                style: {
                    background: "#fee2e2",
                    fontSize: "14px",
                    color: "red",
                    boxShadow: "0px",
                },
            }).showToast();

            return;
        } else {
            const data = {
                customer: {
                    name: currentUserObj.name,
                    email: currentUserObj.email,
                    profile_image: currentUserObj.profile_image,
                },
                address_id: addressId,
                coupon_id: couponId?.value,
                order_date: new Date().toLocaleDateString("en-US"),
                total_amount: cart.subtotal,
                tax_amount: cart.tax,
                net_total: cart.netTotal,
                order_items: cart.items.map((item) => ({
                    stock_id: item.stock_id,
                    price: item.product.discount_type
                        ? item.product.display_price
                        : item.product.sale_price,
                    quantity: item.quantity,
                    total_price: item.product.discount_type
                        ? item.product.display_price
                        : item.product.sale_price * item.quantity,
                })),
            };

            
            const res = await storeOrder("/confirm-order", data, csrfToken);
            const orderData = await res.json();

            console.log(orderData);

            if (orderData.success) {
                showSuccessToast(orderData.message);
                window.location.href = location.origin + "/account/orders";
            } else {
                showErrorToast(orderData.message);
            }
            couponId.value = "";
            selectedAddress.classList.remove("active-address");
            renderOrderedProductList(
                { items: [], subtotal: 0, tax: 0, netTotal: 0 },
                containerOrderedProductsList
            );
            renderOrderSummary({
                items: [],
                subtotal: 0,
                tax: 0,
                netTotal: 0,
            });

            totalCartItems.textContent = 0;
            emptyCart(0, cartItems);

            localStorage.removeItem("cartItems");

            console.log(res);
        }
    };
    container.addEventListener("click", handleOrderConfirmBtn);
};

document.addEventListener("DOMContentLoaded", initalizeConfirmOrder);
