const updatUiWishlist = (isAdded, wishlistIcon, wishlistProducts) => {
    const totalWishlistCount = document.querySelector(".total-wishlist-count");

    if (wishlistIcon) {
        if (isAdded) {
            wishlistIcon.classList.add(
                "fill-pearl-bush-400", // test with default Tailwind colour
                "stroke-none"
            );

            totalWishlistCount.textContent = wishlistProducts.length;
        } else {
            wishlistIcon.classList.remove("fill-pearl-bush-400", "stroke-none");
            if (wishlistProducts.length <= 0) {
                totalWishlistCount.classList.add("hidden");
            }
            totalWishlistCount.textContent = wishlistProducts.length;
        }
    }
};
export default updatUiWishlist;
