const updatUiWishlist = (isAdded, wishlistIcon, wishlistProducts) => {
    const totalWishlistCount = document.querySelector(".total-wishlist-count");
    const wishlistCount = document.querySelector('.wishlist-count')

    if (!totalWishlistCount) return;

    if (wishlistIcon) {
        if (isAdded) {
            wishlistIcon.classList.add("fill-pearl-bush-400", "stroke-none");

            wishlistCount.classList.remove("hidden");

            totalWishlistCount.textContent = wishlistProducts.length;
        } else {
            wishlistIcon.classList.remove("fill-pearl-bush-400", "stroke-none");
            if (wishlistProducts.length <= 0) {
                wishlistCount.classList.add("hidden");
            }
            totalWishlistCount.textContent = wishlistProducts.length;
        }
    }
};
export default updatUiWishlist;
