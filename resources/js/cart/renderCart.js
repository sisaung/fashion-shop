import numberFormat from "../utils/numberFormat";

const renderCart = (cartItem) => {
    const template = document.getElementById("cart-item-template");
    if (!template) return;
    const content = template.content.cloneNode(true);

    const image = content.querySelector(".cart-product-image");
    const cartProductName = content.querySelector(".cart-product-name");
    const cartProductSize = content.querySelector(".cart-product-size");
    const cartQuantityValue = content.querySelector(".cart-quantity-value");
    const cartDecreaseQty = content.querySelector(".cart-decrease-qty");
    const cartIncreaseQty = content.querySelector(".cart-increase-qty");
    const cartProductSalePrice = content.querySelector(
        ".cart-product-sale-price"
    );
    const cartProductDisplayPrice = content.querySelector(
        ".cart-product-display-price"
    );

    const cartTotal = content.querySelector(".cart-total");
    const cartItemRemove = content.querySelector(".cart-item-remove");



    image.src = cartItem.product.product_images[0].preview;
    cartProductName.textContent = cartItem.product.product_name;
    cartProductSize.textContent = cartItem.size;
    cartQuantityValue.textContent = cartItem.quantity;
    cartIncreaseQty.setAttribute("data-cart-id", cartItem.id);
    cartIncreaseQty.setAttribute("data-cart-size", cartItem.size);
    cartItemRemove.setAttribute("data-cart-id", cartItem.id);
    cartItemRemove.setAttribute("data-cart-size", cartItem.size);

    cartDecreaseQty.setAttribute("data-cart-id", cartItem.id);
    cartDecreaseQty.setAttribute("data-cart-size", cartItem.size);

    const cartItemSalePrice = numberFormat(cartItem.product.sale_price);
    const cartItemDisplayPrice = numberFormat(cartItem.product.display_price);

    const cartItemTotal = numberFormat(
        cartItem.product.display_price * cartItem.quantity
    );

    if (cartItem.product.discount_percentage > 0) {
        cartProductSalePrice.textContent = `${cartItemSalePrice} MMK`;
        cartProductDisplayPrice.textContent = `${cartItemDisplayPrice} MMK`;
    } else {
        cartProductDisplayPrice.textContent = `${cartItemSalePrice} MMK`;
    }
    cartTotal.textContent = `${cartItemTotal} MMK`;
    return content;
};
export default renderCart;
