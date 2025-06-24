import renderOrderedProduct from "./renderOrderedProduct";

const initializeRenderOrderedProductList = () => {
    const container = document.querySelector(
        ".ordered-products-list-container"
    );
    container.innerHTML = "";

    const getCartData = () => {
        const data = JSON.parse(localStorage.getItem("cartItems")) || {};
        return data.items || [];
    };
    const cart = getCartData();
    cart.forEach((item) => {
        const content = renderOrderedProduct(item, container);
        container.appendChild(content);
        const handleClick = (e) => {
            const redirectProductDetail = e.target.closest(
                ".redirect-to-detail"
            );
            const removeProductCart = e.target.closest(
                ".ordered-product-remove"
            );

            if (redirectProductDetail) {
                const productSlug = redirectProductDetail.dataset.detail;
                window.location.href = `/shop-product/${productSlug}`;
            }

            if (removeProductCart) {

                const cart = getCartData();
                const newCart = cart.filter(
                    (cartItem) => cartItem.id !== item.id
                );
                console.log(newCart)
                // localStorage.setItem("cartItems", JSON.stringify(newCart));
                // renderOrderedProduct(newCart, container);
            }
        };
        container.addEventListener("click", handleClick);
    });
};
document.addEventListener(
    "DOMContentLoaded",
    initializeRenderOrderedProductList
);
