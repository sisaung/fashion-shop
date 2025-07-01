import numberFormat from "../utils/numberFormat";

const renderOrderedProduct = (cart) => {
    const template = document.getElementById("ordered-product-list-template");
    if (!template) return;

    const content = template.content.cloneNode(true);

    const image = content.querySelector(".ordered-product-image");
    const orderedProductName = content.querySelector(".ordered-product-name");
    const orderedProducCode = content.querySelector(".ordered-product-code");
    const orderedProductSize = content.querySelector(".ordered-product-size");
    const orderedQuantityValue = content.querySelector(
        ".ordered-quantity-value"
    );
    const orderedProductSalePrice = content.querySelector(
        ".ordered-product-sale-price"
    );
    const orderedProductDisplayPrice = content.querySelector(
        ".ordered-product-display-price"
    );

    const orderedItemRemove = content.querySelector(".ordered-product-remove");
    const redirectToDetail = content.querySelector(".redirect-to-detail");

    image.src = cart.product.product_images.length > 0? cart.product.product_images[0].preview :
        "https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Placeholder_view_vector.svg/1362px-Placeholder_view_vector.svg.png?20220519031949"
    orderedProductName.textContent = cart.product.product_name;
    orderedProductSize.textContent = cart.size;
    orderedQuantityValue.textContent = "Qty: " + cart.quantity;
    orderedProducCode.textContent = cart.product.product_code;

    if (cart.product.discount_percentage) {
        orderedProductSalePrice.textContent =
            numberFormat(cart.product.sale_price) + " MMK";
        orderedProductDisplayPrice.textContent =
            numberFormat(cart.product.display_price) + " MMK";
    } else {
        orderedProductDisplayPrice.textContent =
            numberFormat(cart.product.display_price) + " MMK";
    }

    orderedItemRemove.setAttribute("data-ordered-cart-id", cart.id);
    redirectToDetail.setAttribute("data-detail", cart.product.slug);
    return content;
};
export default renderOrderedProduct;
