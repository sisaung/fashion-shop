import fetchLatestStyle from "../services/fetchLatestStyle";

import renderProductList from "./renderProductList";
import getWishlist from "./wishlist/getWishlist";


const initializeLatestStyle = async () => {

    const container = document.getElementById("product-container");
    // const totalProductContainer = document.getElementById(
    //     "total-product-container"
    // );


    if (!container) return;

    // initialRender

    const data = await fetchLatestStyle();


    const wishlistProducts = await getWishlist();

    console.log(wishlistProducts)

    if (data) {
       console.log(data)
        await renderProductList(data, container, wishlistProducts);


        // initializeRedirect();
    }
};

document.addEventListener("DOMContentLoaded", initializeLatestStyle);
export default initializeLatestStyle;

