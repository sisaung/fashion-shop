import checkCoupon from "../services/checkCoupon";
import numberFormat from "../utils/numberFormat";

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

    const subtotal = cart.reduce((acc, item) => {
        const productPrice = item.product.discount_percentage
            ? item.product.display_price
            : item.product.sale_price;
        return acc + productPrice * item.quantity;
    }, 0);

    const tax = subtotal * 0.05;
    const netTotal = subtotal + tax;

    const format = (num) => numberFormat(num);

    subtotalEl.textContent = `${format(subtotal)} MMK`;
    taxEl.textContent = `${format(tax)} MMK`;
    netTotalEl.textContent = `${format(netTotal)} MMK`;

    container.appendChild(content);

    const couponInput = container.querySelector(".coupon_code");
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

        if (data?.coupon_discount) {

            const discountPrice = (data.coupon_discount / 100) * subtotal;
            couponDiscount.textContent = `${numberFormat(discountPrice)} MMK`;
            const total = subtotal - discountPrice;
            subtotalEl.textContent = `${numberFormat(total)} MMK`;
            taxEl.textContent = `${numberFormat(total * 0.05)} MMK`;
            netTotalEl.textContent = `${numberFormat(total * 1.05)} MMK`;

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
