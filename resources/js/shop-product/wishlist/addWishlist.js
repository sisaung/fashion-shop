import destroyWishlist from "../../services/destroyWishlist";
import getWishlist from "./getWishlist";
import updatUiWishlist from "./updateUIWishList";
import storeWishList from "../../services/storeWishList";
import initializeSort from "../shopProductList";

const initializeAddShopWishlist = async () => {
    const container = document.getElementById("product-container");
    
    const searchParam = location.search;

    let wishlistProducts = await getWishlist();

    container.addEventListener("click", async (e) => {
        e.preventDefault();
        e.stopPropagation();
        const wishlistBtn = e.target.closest(".wishlist-btn");
        const wishlistIcon = e.target.closest(".wishlist-icon");
        if (!wishlistBtn) return;

        const productId = wishlistBtn.dataset.productId;

        //  wishlistProducts = await getWishlist();
        const exists = wishlistProducts?.find(
            (product) => product.id == productId
        );

        if (exists) {
            // Call destroy if exists
            await destroyWishlist(`/wishlist-destroy/${productId}`);
            // wishlistProducts = await getWishlist(); // Refresh list after deletion
            wishlistProducts = wishlistProducts.filter(
                (product) => product.id != productId
            ); // Update local wishlistProducts
            updatUiWishlist(false, wishlistIcon, wishlistProducts);
        } else {
            // Call store if not exists
            const data = await storeWishList("/store-wishlist", {
                product_id: productId,
            });

            if (data.message === "Unauthenticated.") {
                location.href = `/login`;
                return;
            }

            // wishlistProducts = data.wishlist.products;
            wishlistProducts = await getWishlist();
            updatUiWishlist(true, wishlistIcon, wishlistProducts);
            console.log(searchParam)
            initializeSort()


        }
    });
};

document.addEventListener("DOMContentLoaded", initializeAddShopWishlist);
