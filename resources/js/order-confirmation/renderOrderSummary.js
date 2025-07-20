import checkCoupon from "../services/checkCoupon";
import numberFormat from "../utils/numberFormat";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

const renderOrderSummary = (cart) => {
    const template = document.getElementById("summary-template");
    const container = document.querySelector(".summary-output");

    if (!template || !container) return;

    // Clear old summary
    container.innerHTML = "";

    const content = template.content.cloneNode(true);

    const subtotalEl = content.querySelector(".sub-total");
    const taxEl = content.querySelector(".tax");
    const couponDiscount = content.querySelector(".coupon-discount");
    const netTotalEl = content.querySelector(".net-total");

    const subtotal =
        cart.length > 0
            ? cart.reduce((acc, item) => {
                  const productPrice = item.product.discount_type
                      ? item.product.display_price
                      : item.product.sale_price;
                  return acc + productPrice * item.quantity;
              }, 0)
            : 0;

    const tax = subtotal * 0.05;
    const netTotal = subtotal + tax;

    const format = (num) => numberFormat(num);

    subtotalEl.textContent = `${format(subtotal)} MMK`;
    taxEl.textContent = `${format(tax)} MMK`;
    netTotalEl.textContent = `${format(netTotal)} MMK`;

    container.appendChild(content);

    const couponInput = container.querySelector(".coupon_code");
    const couponId = container.querySelector(".coupon-id");
    const applyBtn = container.querySelector(".coupon-apply-btn");

    if (couponInput) {
        couponInput.addEventListener("keyup", (e) => {
            if (e.target.value) {
                applyBtn.disabled = false;
                applyBtn.classList.remove("pointer-events-none");
            } else {
                applyBtn.disabled = true;
                applyBtn.classList.add("pointer-events-none");
                applyBtn.classList.add("select-none");
            }
        });
    }

    applyBtn.addEventListener("click", async () => {
        const couponCode = couponInput.value.trim();
        const data = await checkCoupon(couponCode);

        if (data.status === 404 || data.status === 401) {
            Toastify({
                text: "❗" + data.message,
                duration: 3000,
                gravity: "top",
                position: "right",
                style: {
                    background: "#fee2e2",
                    fontSize: "14px",
                    color: "red",
                    boxShadow: "0px",
                },
                close: true,
                avatar: "",
            }).showToast();
            couponInput.value = "";
            applyBtn.disabled = true;

            return;
        } else {
            Toastify({
                text: "Coupon Added successfully",
                duration: 3000,
                gravity: "top",
                position: "right",
                style: {
                    background: "#f9f6f3",
                    fontSize: "14px",
                    color: "#694943",
                    boxShadow: "0px",
                },
                close: true,
                avatar: "",
            }).showToast();
            couponInput.value = "";
            applyBtn.disabled = true;
        }

        if (data?.discount_type == "percentage" && data?.coupon_id) {
            const discountPrice = (data.coupon_discount / 100) * subtotal;
            couponDiscount.textContent = `${numberFormat(discountPrice)} MMK`;
            const total = subtotal - discountPrice;
            subtotalEl.textContent = `${numberFormat(total)} MMK`;
            taxEl.textContent = `${numberFormat(total * 0.05)} MMK`;
            netTotalEl.textContent = `${numberFormat(total * 1.05)} MMK`;
            couponId.value = data.coupon_id;
            applyBtn.disabled = true;
        } else {
            const discountPrice = data.coupon_discount;
            couponDiscount.textContent = `${numberFormat(discountPrice)} MMK`;
            const total = subtotal - discountPrice;
            subtotalEl.textContent = `${numberFormat(total)} MMK`;
            taxEl.textContent = `${numberFormat(total * 0.05)} MMK`;
            netTotalEl.textContent = `${numberFormat(total * 1.05)} MMK`;
            couponId.value = data.coupon_id;
            applyBtn.disabled = true;
        }
        couponInput.value = "";
    });

    localStorage.setItem(
        "cartItems",
        JSON.stringify({
            items: cart,
            subtotal: subtotal,
            tax: tax,
            netTotal: netTotal,
        })
    );
};
export default renderOrderSummary;
