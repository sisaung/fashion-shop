import storeWishList from "../services/storeWishList";
import destroyWishlist from "../services/destroyWishlist";
import getWishlist from "../shop-product/wishlist/getWishlist";
import updatUiWishlist from "./updateUiWishlist";

const initializeWishList = async () => {
    const wishListBtn = document.querySelector(".add-to-wishlist");


    if (!wishListBtn) return;

    const productId = wishListBtn.dataset.productId;



    let wishlistProducts = await getWishlist();

    

    // Initial UI update
    if (wishlistProducts) {
        const existingWishlist = wishlistProducts.find(
            (product) => product.id == productId
        );
        updatUiWishlist(!!existingWishlist,wishlistProducts);
    }

    const handleAddToWishList = async () => {
        wishlistProducts = await getWishlist();
        const exists = wishlistProducts?.find(
            (product) => product.id == productId
        );

        if (exists) {
            // Call destroy if exists
            await destroyWishlist(`/wishlist-destroy/${productId}`);
            wishlistProducts = await getWishlist(); // Refresh list after deletion
            updatUiWishlist(false,wishlistProducts);
        } else {
            // Call store if not exists
            const data = await storeWishList("/store-wishlist", {
                product_id: productId,
            });

            if (data.message === "Unauthenticated.") {
                location.href = `/login`;
                return;
            }

            wishlistProducts = data.wishlist.products;
            updatUiWishlist(true,wishlistProducts);
        }
    };

    wishListBtn.addEventListener("click", handleAddToWishList);
};

document.addEventListener("DOMContentLoaded", initializeWishList);
