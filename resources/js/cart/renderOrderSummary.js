import numberFormat from "../utils/numberFormat";

const renderSummary = (cart) => {
    const template = document.getElementById("summary-template");
    const container = document.querySelector(".summary-output");

    if (!template || !container) return;

    // Clear old summary
    container.innerHTML = "";

    const content = template.content.cloneNode(true);


    const subtotalEl = content.querySelector(".sub-total");
    const taxEl = content.querySelector(".tax");
    const netTotalEl = content.querySelector(".net-total");


    const subtotal = cart.reduce((acc, item) => {

        const productPrice = item.product.discount_percentage ? item.product.display_price : item.product.sale_price
        return acc + productPrice * item.quantity;
    }, 0);

    const tax = subtotal * 0.03;
    const netTotal = subtotal + tax;

    const format = (num) => numberFormat(num);

    subtotalEl.textContent = `${format(subtotal)} MMK`;
    taxEl.textContent = `${format(tax)} MMK`;
    netTotalEl.textContent = `${format(netTotal)} MMK`;

    container.appendChild(content);
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
export default renderSummary;
