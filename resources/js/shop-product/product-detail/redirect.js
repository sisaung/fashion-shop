const initializeRedirect = () => {

    const container = document.getElementById("product-container");

    container.addEventListener("click", (e) => {
        const card = e.target.closest(".product-card");

        if (card && card.dataset.productSlug) {
            window.location.href = `/shop-product/${card.dataset.productSlug}`;
        }
    });
};

document.addEventListener("DOMContentLoaded", initializeRedirect);
export default initializeRedirect;
