import renderOrderedProduct from "./renderOrderedProduct";

const renderOrderedProductList = (cart, container) => {
    container.innerHTML = "";

    if (!container) return;

    const template = document.getElementById("empty-cart-template");
    const content = template.content.cloneNode(true);



    if (cart.length > 0) {
        cart.forEach((item) => {
            const content = renderOrderedProduct(item);
            container.appendChild(content);
        });
    } else {
        container.appendChild(content);
    }
};

export default renderOrderedProductList;
