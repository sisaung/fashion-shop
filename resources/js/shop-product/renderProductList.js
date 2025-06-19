import renderProduct from "./renderProduct";

const renderProductList = (data, container) => {
    container.innerHTML = "";

    data.data.forEach((product) => {
        const card = renderProduct(product);
        container.appendChild(card);
    });
};
export default renderProductList
