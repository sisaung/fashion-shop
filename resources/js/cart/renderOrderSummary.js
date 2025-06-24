import numberFormat from "../utils/numberFormat";

const  renderSummary = (cart) => {
    const template = document.getElementById("summary-template");
    const container = document.querySelector(".summary-output");

    if (!template || !container) return;

    // Clear old summary
    container.innerHTML = "";

    const content = template.content.cloneNode(true);

    // Select target elements inside cloned template
    const subtotalEl = content.querySelector(".sub-total");
    const taxEl = content.querySelector(".tax");
    const netTotalEl = content.querySelector(".net-total");

    const subtotal = cart.reduce((sum, item) => {
        return sum + item.product.display_price * item.quantity;
    }, 0);

    const tax = subtotal * 0.05; // 10% tax
    const netTotal = subtotal + tax;

    const format = (num) =>
       numberFormat(num);

    subtotalEl.textContent = `${format(subtotal)} MMK`;
    taxEl.textContent = `${format(tax)} MMK`;
    netTotalEl.textContent = `${format(netTotal)} MMK`;

    container.appendChild(content);
}
export default renderSummary
