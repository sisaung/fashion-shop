import renderProduct from "./renderProduct";

const renderProductList = async (data, container,wishlistProducts) => {
    container.innerHTML = "";



    if (data) {
        for (let product of data) {
            const card = await renderProduct(product,wishlistProducts);
            container.appendChild(card);
        }
    }
};
export default renderProductList;
