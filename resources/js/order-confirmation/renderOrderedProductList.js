import renderOrderedProduct from "./renderOrderedProduct";

const renderOrderedProductList = (cart, container) => {
    container.innerHTML = "";

    if (!container) return;

    cart.forEach((item) => {
        const content = renderOrderedProduct(item);
        container.appendChild(content);

    });
};

export default renderOrderedProductList;
