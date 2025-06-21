import { fetchProductType } from "../../services/fetchProductType";
import renderProductTypeList from "./renderProductTypeLIst";


const initializeProductType = async () => {
    const container = document.getElementById(
        "filter-product-type-container"
    );

    console.log(container)
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );

    console.log(container);
    const paginationContainer = document.getElementById("pagination-container");

    if (!container) return;

    // initialRender
    const data = await fetchProductType(`/shop/get-product-type`);


    if (data) {
        renderProductTypeList(data, container);
    }
};

document.addEventListener("DOMContentLoaded", initializeProductType);
export default initializeProductType;
