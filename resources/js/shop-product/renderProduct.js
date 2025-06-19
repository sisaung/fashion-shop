const renderProduct = (product) => {
    const template = document.getElementById("product-template");

    if(!template) {
        console.log('not found template');
    }
    const clone = template.content.cloneNode(true);

    const image = clone.querySelector(".product-image");

    image.src =
        product.product_images.length > 0
            ? product.product_images[0].large
            : "https://storage.mms-it.com/boss-nation/previews/galleries/pJyVBUw7Bpwl40N10pYZy2WrhwD4HXPViBVlLozF.jpg";

    clone.querySelector(".product-brand").textContent =
        product.brand?.brand_name || "";
    clone.querySelector(".product-name").textContent = product.product_name;
    clone.querySelector(".code-text").textContent = product.product_code;

    const priceElement = clone.querySelector(".product-price");
    if (product.discount_percentage > 0) {
        priceElement.innerHTML = `
            <span class="line-through text-pearl-bush-300">${Number(
                product.sale_price
            ).toLocaleString()} MMK</span>
            <span class="text-stone-500">${Number(
                product.display_price
            ).toLocaleString()} MMK</span>
        `;
    } else {
        priceElement.textContent = `${Number(
            product.display_price
        ).toLocaleString()} MMK`;
    }

    return clone;
};
export default renderProduct
