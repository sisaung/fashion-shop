import fetchWishlist from "../../services/fetchWishlist";
import getWishlist from "./getWishlist";

const initializeAddShopWishlist = async () => {
    const container = document.getElementById("product-container");


    let wishlistProducts = await getWishlist();


    const updateUI = (isAdded) => {
        if (isAdded) {
            heartIcon.classList.add(
                "fill-pearl-bush-500",
                "stroke-none",
                "size-6"
            );
            status.textContent = "Added to wishlist";
            wishlistCount.classList.remove("hidden");
        } else {
            heartIcon.classList.remove(
                "fill-pearl-bush-500",
                "stroke-none",
                "size-6"
            );
            status.textContent = "Add to wishlist";
            if (wishlistProducts.length <= 0) {
                wishlistCount.classList.add("hidden");
            }
        }
        totalWishlistCount.textContent = wishlistProducts.length;
    };


    container.addEventListener("click", (e) => {
        const wishlistBtn = e.target.closest(".wishlist-btn");
        if (!wishlistBtn) return;

        e.preventDefault();
        e.stopPropagation();





    });
};

document.addEventListener("DOMContentLoaded", initializeAddShopWishlist);
