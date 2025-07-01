
const updatUiWishlist = (isAdded,wishlistProducts) => {
    const heartIcon = document.querySelector(".add-to-wishlist-heart");
    const status = document.querySelector(".status-wishlist");
    const wishlistCount = document.querySelector(".wishlist-count");
    const totalWishlistCount = document.querySelector(".total-wishlist-count");



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
}

export default updatUiWishlist
