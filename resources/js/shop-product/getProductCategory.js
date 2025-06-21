import { fetchProductCategory } from "../services/fetchProductCategory";
import { fetchProductShop } from "../services/fetchProductShop";
import urlString from "../utils/urlString";
import { renderBreadcrumbTotalProduct } from "./renderBreadcrumbTotalProduct";
import { renderPaginationList } from "./renderPaginationList";
import renderProductCategoryList from "./renderProductCategoryLIst";
import renderProductList from "./renderProductList";

const initializeProductCategory = async () => {
    const container = document.getElementById(
        "filter-product-category-container"
    );
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );

    const paginationContainer = document.getElementById("pagination-container");

    if (!container) return;

    // initialRender
    const data = await fetchProductCategory(`/shop/get-product-category`);


    if (data) {
        renderProductCategoryList(data, container);
    }
};

document.addEventListener("DOMContentLoaded", initializeProductCategory);
export default initializeProductCategory;
