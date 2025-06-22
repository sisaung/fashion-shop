import { fetchProductCategory } from "../services/fetchProductCategory";
import renderProductCategoryList from "./renderProductCategoryLIst";

const initializeProductCategory = async () => {
    const container = document.getElementById(
        "filter-product-category-container"
    );
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );



    if (!container) return;

    // initialRender

    const data = await fetchProductCategory(`/shop/get-product-category`);

    if (data) {
        renderProductCategoryList(data, container);


    }
};

document.addEventListener("DOMContentLoaded", initializeProductCategory);
export default initializeProductCategory;
