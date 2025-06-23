const initializeRedirect = () => {
    // const productCards = document.querySelectorAll(".product-card");
    // if (!productCards.length) {
    //     console.log("No product cards found.");
    //     return;
    // }

    // productCards.forEach((product) => {
    //     product.addEventListener("click", () => {
    //         const slug = product.getAttribute("data-product-slug");
    //         if (slug) {
    //             window.location.href = `/product/${slug}`;
    //         }
    //     });
    // });

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
