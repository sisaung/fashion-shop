import renderProduct from "./renderProduct";

const renderProductList = async (data, container, wishlistProducts) => {
    container.innerHTML = "";

    if (data.length > 0) {
        for (let product of data) {
            const card = await renderProduct(product, wishlistProducts);
            container.appendChild(card);
        }
    } else {
        const emptyProductContainer = document.getElementById(
            "empty-product-container"
        );
        const emptyProductTemplate = document.getElementById(
            "product-empty-template"
        );
        emptyProductContainer.innerHTML = "";

        if (!emptyProductTemplate || !emptyProductContainer) return;
        const content = emptyProductTemplate.content.cloneNode(true);
        const backShopNow = content.querySelector(".back-shop-now");
       backShopNow.addEventListener("click", () => {
           window.location.href = "/shop";
       })
        emptyProductContainer.appendChild(content);
    }
};
export default renderProductList;
