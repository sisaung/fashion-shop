import renderProduct from "./renderProduct";

const renderProductList = (data, container) => {
    container.innerHTML = "";

    if (data) {
        for (let product of data) {
            const card = renderProduct(product);
            container.appendChild(card);
        }
    }
};
export default renderProductList;
