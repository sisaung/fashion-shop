import renderCart from "./renderCart";

const renderCartList = (cart, container) => {
    container.innerHTML = "";
    const cartItemHeader = document.querySelector('.cart-items-header');
    const emptyCartOutput = document.querySelector(".empty-cart-output");
    const clearCartContainer = document.querySelector(".clear-cart-container");


    const template = document.getElementById("empty-cart-template");
    const content = template.content.cloneNode(true);

    if (cart.length > 0) {
        cart.forEach((cartItem) => {
            const content = renderCart(cartItem);
            container.appendChild(content);
        });
    } else {
        emptyCartOutput.appendChild(content);
        cartItemHeader.classList.add('hidden')
        clearCartContainer.classList.add('hidden')
    }
};
export default renderCartList;
