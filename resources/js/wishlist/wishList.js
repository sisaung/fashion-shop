import fetchWishlist from "../services/fetchWishlist";
import storeWishList from "../services/storeWishList";
import destroyWishlist from "../services/destroyWishlist";

const initializeWishList = async () => {
    const wishListBtn = document.querySelector(".add-to-wishlist");
    const heartIcon = document.querySelector(".add-to-wishlist-heart");
    const status = document.querySelector(".status-wishlist");
    const wishlistCount = document.querySelector(".wishlist-count");
    const totalWishlistCount = document.querySelector(".total-wishlist-count");

    if (!wishListBtn) return;

    const productId = wishListBtn.dataset.productId;

    const getWishlist = async () => {
        const data = await fetchWishlist("/get-wishlist");
        return data.wishlist.products;
    };

    let wishlistProducts = await getWishlist();

    const updateUI = (isAdded) => {
        if (isAdded) {
            heartIcon.classList.add("fill-pearl-bush-500", "stroke-none", "size-6");
            status.textContent = "Added to wishlist";
            wishlistCount.classList.remove("hidden");
        } else {
            heartIcon.classList.remove("fill-pearl-bush-500", "stroke-none", "size-6");
            status.textContent = "Add to wishlist";
            if (wishlistProducts.length <= 0) {
                wishlistCount.classList.add("hidden");
            }
        }
        totalWishlistCount.textContent = wishlistProducts.length;
    };

    // Initial UI update
    const existingWishlist = wishlistProducts.find(
        (product) => product.id == productId
    );
    updateUI(!!existingWishlist);

    const handleAddToWishList = async () => {
        wishlistProducts = await getWishlist();
        const exists = wishlistProducts.find(
            (product) => product.id == productId
        );

        if (exists) {
            // Call destroy if exists
            await destroyWishlist(`/wishlist-destroy/${productId}`);
            wishlistProducts = await getWishlist(); // Refresh list after deletion
            updateUI(false);
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
            updateUI(true);
        }
    };

    wishListBtn.addEventListener("click", handleAddToWishList);
};

document.addEventListener("DOMContentLoaded", initializeWishList);
