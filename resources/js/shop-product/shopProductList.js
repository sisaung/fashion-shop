import { fetchProductShop } from "../services/fetchProductShop";

import { renderBreadcrumbTotalProduct } from "./renderBreadcrumbTotalProduct";
import { renderPaginationList } from "./renderPaginationList";
import renderProductList from "./renderProductList";
import getWishlist from "./wishlist/getWishlist";


const initializeSort = async () => {
    const sortBy = document.querySelector(".sort-product");
    const container = document.getElementById("product-container");
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );

    const paginationContainer = document.getElementById("pagination-container");
    const searchParam = window.location.search;

    if (!container) return;

    // initialRender

    const data =
        searchParam != ""
            ? await fetchProductShop(`/shop/get${searchParam}`)
            : await fetchProductShop(`/shop/get`);
    // const data = await fetchProductShop(`/shop`);

    const wishlistProducts = await getWishlist();
    console.log(wishlistProducts)

    if (data?.data) {
        await renderProductList(data?.data, container, wishlistProducts);
        renderBreadcrumbTotalProduct(data?.total, totalProductContainer);
        await renderPaginationList(
            data?.links,
            paginationContainer,
            wishlistProducts
        );



        // initializeRedirect();
    }
};

document.addEventListener("DOMContentLoaded", initializeSort);
export default initializeSort;
