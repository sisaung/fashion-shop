import getWishlist from "./getWishlist";
import updatUiWishlist from "./updateUIWishList";

const initializeWishlist = async() => {

    const wishlistBtn = document.querySelectorAll(".wishlist-btn");
    console.log(wishlistBtn)

    const wishlistProducts = await getWishlist();
    wishlistBtn.forEach(async (btn) => {
        const wishlistIcon = btn.querySelector(".wishlist-icon");

        const productId = btn.dataset.productId;
        if (wishlistProducts) {
            const existingWishlist = wishlistProducts.find(
                (product) =>String(product.id) === String(productId)
            );

            console.log(btn)
            console.log(existingWishlist);
            btn.classList.add('bg-red-500','!important')
            // updatUiWishlist(
            //     !!existingWishlist,

            //     wishlistIcon
            // );
        }
    });


}
document.addEventListener('DOMContentLoaded', initializeWishlist);
export default initializeWishlist

