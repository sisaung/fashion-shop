import { fetchProductShop } from "../services/fetchProductShop";
import urlString from "../utils/urlString";
import renderProductList from "./renderProductList";

const initializeSortProduct = () => {
    const sortBy = document.querySelector(".sort-product");
    const container = document.getElementById("product-container");

    if(!container) return;
    // sort product
    const handleChange = async (e) => {
        const sort = e.target.value;

        const [sortBy, sortDirection] = sort.split("&");
        const url = urlString(sortBy, sortDirection, true);
        const data = await fetchProductShop(`/shop/get${url}`);

        if (data?.data) {
            renderProductList(data, container);
        }
        history.pushState({}, "", url);
    };

    sortBy.addEventListener("change", handleChange);
};

document.addEventListener("DOMContentLoaded", initializeSortProduct);
