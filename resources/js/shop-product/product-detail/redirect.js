const initializeRedirect = () => {

    const container = document.getElementById("product-container");

    if(!container) return;

    container.addEventListener("click", (e) => {
        const card = e.target.closest(".product-card");

        const wishlistBtn = e.target.closest('.wishlist-btn')

        if(wishlistBtn) {
            return;
        }



        if (card && card.dataset.productSlug) {
            window.location.href = `/shop-product/${card.dataset.productSlug}`;
        }
    });
};

document.addEventListener("DOMContentLoaded", initializeRedirect);
export default initializeRedirect;
