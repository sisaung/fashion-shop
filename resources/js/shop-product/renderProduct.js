import { formatNumber } from "chart.js/helpers";
import updatUiWishlist from "./wishlist/updateUIWishList";

const renderProduct = async (product, wishlistProducts) => {
    const template = document.getElementById("product-template");

    if (!template) {
        console.log("not found template");
    }
    const clone = template.content.cloneNode(true);

    const productCard = clone.querySelector(".product-card");

    productCard.setAttribute("data-product-slug", product.slug);

    const image = clone.querySelector(".product-image");
    const productPrice = clone.querySelector(".product-price");
    const saleProductPrice = clone.querySelector(".sale-product-price");
    const productPromo = clone.querySelector(".product-promo");
    const wishlistBtn = clone.querySelector(".wishlist-btn");
    const wishlistIcon = clone.querySelector(".wishlist-icon");


    wishlistBtn.setAttribute("data-product-id", product.id);
    wishlistIcon.setAttribute("data-product-icon-id", product.id);

    if (wishlistProducts) {
        const existingWishlist = wishlistProducts?.find(
            (p) => p.id == product.id
        );

        if (existingWishlist) {
            updatUiWishlist(!!existingWishlist, wishlistIcon, wishlistProducts);
        }
    }

    // if (!!existingWishlist) {
    //     wishlistIcon.classList.add("fill-red-500"); // Example Tailwind class
    //     wishlistIcon.classList.remove("fill-none");
    // } else {
    //     wishlistIcon.classList.add("fill-none");
    //     wishlistIcon.classList.remove("fill-red-500");
    // }

    image.src =
        product?.product_images?.length > 0
            ? product.product_images[0].large
            : "https://www.svgrepo.com/show/508699/landscape-placeholder.svg";

    clone.querySelector(".product-brand").textContent =
        product.brand?.brand_name || "";
    clone.querySelector(".product-name").textContent = product.product_name;
    clone.querySelector(".code-text").textContent = product.product_code;

    if (product.discount_type) {
        saleProductPrice.textContent = `${Number(
            product.sale_price
        ).toLocaleString()} MMK `;
        productPrice.textContent = `${Number(
            product.display_price
        ).toLocaleString()} MMK `;
    } else {
        productPrice.textContent = `${Number(
            product.display_price
        ).toLocaleString()} MMK `;
    }

    if (product.discount_type == "percentage") {
        console.log("percentage");
        productPromo.classList.remove("hidden");
        productPromo.textContent = `Save ${product.discount_value} % OFF`;
        productPromo.classList.add("bg-red-500");
    } else if (product.discount_type == "fixed") {
        ;
        productPromo.classList.remove("hidden");
        productPromo.textContent = `Save ${formatNumber(
            product.discount_value
        )} MMK OFF`;
        productPromo.classList.add("bg-red-500");
    } else {
        productPromo.classList.add("hidden");
        productPromo.textContent = ``;
        productPromo.classList.remove("bg-red-500");
    }

    return clone;
};
export default renderProduct;
