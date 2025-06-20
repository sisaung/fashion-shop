import { fetchProductShop } from "../services/fetchProductShop";
import urlString from "../utils/urlString";
import { renderBreadcrumbTotalProduct } from "./renderBreadcrumbTotalProduct";
import renderProductList from "./renderProductList";

const initializeSort = async () => {
    const sortBy = document.querySelector(".sort-product");
    const container = document.getElementById("product-container");
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );

    if (!container) return;

    // initialRender
    const data = await fetchProductShop(`/shop/get`);

    if (data?.data) {
        renderProductList(data?.data, container);
        renderBreadcrumbTotalProduct(data?.total, totalProductContainer);
    }
};

document.addEventListener("DOMContentLoaded", initializeSort);
export default initializeSort;
