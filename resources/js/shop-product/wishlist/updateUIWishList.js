const updatUiWishlist = (isAdded, wishlistIcon) => {

    if (wishlistIcon) {
        if (isAdded) {
            wishlistIcon.classList.add(
                "fill-pearl-bush-400", // test with default Tailwind colour
                "stroke-none",
                
            );

        } else {
            wishlistIcon.classList.remove(
                "fill-pearl-bush-400",
                "stroke-none",
                
            );
        }
    }
}
export default updatUiWishlist
