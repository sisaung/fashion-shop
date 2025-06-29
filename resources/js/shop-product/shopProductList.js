import { fetchProductShop } from "../services/fetchProductShop";
import urlString from "../utils/urlString";
import initializeRedirect from "./product-detail/redirect";
import { renderBreadcrumbTotalProduct } from "./renderBreadcrumbTotalProduct";
import { renderPaginationList } from "./renderPaginationList";
import renderProductList from "./renderProductList";

const initializeSort = async () => {
    const sortBy = document.querySelector(".sort-product");
    const container = document.getElementById("product-container");
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );

    const paginationContainer = document.getElementById("pagination-container");

    if (!container) return;

    // initialRender
    const data = await fetchProductShop(`/shop/get`);
    // const data = await fetchProductShop(`/shop`);



    if (data?.data) {
        renderProductList(data?.data, container);
        renderBreadcrumbTotalProduct(data?.total, totalProductContainer);
        renderPaginationList(
            data?.links,

            paginationContainer
        );
        // initializeRedirect();
    }
};

document.addEventListener("DOMContentLoaded", initializeSort);
export default initializeSort;
