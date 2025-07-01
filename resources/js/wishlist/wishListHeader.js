import fetchWishlist from "../services/fetchWishlist";

const initializeWishListHeader = async () => {
    const wishlistCount = document.querySelector(".wishlist-count");
    const totalWishlistCount = document.querySelector(".total-wishlist-count");
    const data = await fetchWishlist("/get-wishlist");

    if (data?.wishlist?.products?.length > 0) {
        wishlistCount.classList.remove("hidden");
        totalWishlistCount.textContent = data.wishlist ? data.wishlist.products.length : ''
    }
};

document.addEventListener("DOMContentLoaded", initializeWishListHeader);
