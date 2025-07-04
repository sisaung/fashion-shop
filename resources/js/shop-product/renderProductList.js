import renderProduct from "./renderProduct";

const renderProductList = async (data, container,wishlistProducts) => {
    container.innerHTML = "";



    if (data.length > 0) {
        for (let product of data) {
            const card = await renderProduct(product,wishlistProducts);
            container.appendChild(card);
        }
    }else {
        // const emptyProductTemplate = document.getElementById(
        //     "empty-product-template"
        // );
        // const content = emptyProductTemplate.content.cloneNode(true);
        // container.appendChild(content);
        
    }
};
export default renderProductList;
