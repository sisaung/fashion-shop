import { fetchProductShop } from "../services/fetchProductShop";
import urlString from "../utils/urlString";
import initializeRedirect from "./product-detail/redirect";
import { renderBreadcrumbTotalProduct } from "./renderBreadcrumbTotalProduct";
import { renderPaginationList } from "./renderPaginationList";
import renderProductList from "./renderProductList";
import getWishlist from "./wishlist/getWishlist";
import initializeWishlist from "./wishlist/showWishlist";
import updatUiWishlist from "./wishlist/updateUIWishList";

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

    if (data?.data) {
        await renderProductList(data?.data, container, wishlistProducts);
        renderBreadcrumbTotalProduct(data?.total, totalProductContainer);
        await renderPaginationList(
            data?.links,
            paginationContainer,
            wishlistProducts
        );

        // const wishlistProducts = await getWishlist();
        // const wishlistBtn = document.querySelectorAll(".wishlist-btn");

        // wishlistBtn.forEach(async (btn) => {
        //     const productId = btn.dataset.productId;
        //     console.log(productId)
        //     const wishlistIcon = btn.querySelector(".wishlist-icon");
        //     if (wishlistProducts) {
        //         const existingWishlist = wishlistProducts.find(
        //             (product) => product.id == productId
        //         );
        //         updatUiWishlist(!!existingWishlist,wishlistIcon);
        //     }
        // });

        // initializeWishlist()

        // initializeRedirect();
    }
};

document.addEventListener("DOMContentLoaded", initializeSort);
export default initializeSort;
