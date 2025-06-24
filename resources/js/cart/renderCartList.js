import renderCart from "./renderCart";

const renderCartList = (cart,container) => {

    container.innerHTML = ''

    cart.forEach((cartItem) => {
        const content =  renderCart(cartItem)
        container.appendChild(content)
     });
}
export default renderCartList
