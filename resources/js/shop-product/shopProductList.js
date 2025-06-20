import { fetchProductShop } from "../services/fetchProductShop";
import urlString from "../utils/urlString";
import renderProductList from "./renderProductList";


const initializeSort = async () => {
    const sortBy = document.querySelector(".sort-product");
    const container = document.getElementById("product-container");

    if (!container) return;

    // initialRender
    const data = await fetchProductShop(`/shop/get`);

    if (data?.data) {
        renderProductList(data?.data, container);
    }


};

document.addEventListener("DOMContentLoaded", initializeSort);
export default initializeSort;

