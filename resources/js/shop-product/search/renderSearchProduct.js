const renderSearchProduct = (product) => {
    const template = document.getElementById("search-product-template");
    if (!template) return;
    const content = template.content.cloneNode(true);

    const productImage = content.querySelector(".search-product-image");
    const productName = content.querySelector(".search-product-name");
    const brandName = content.querySelector(".search-brand-name");
    const productType = content.querySelector(".search-product-type");
    const searchProductItem = content.querySelector(".search-product-item");

    searchProductItem.setAttribute("data-product-slug", product.slug);

    productImage.src =
        product.product_images.length > 0
            ? product.product_images[0].large
            : "https://user-images.githubusercontent.com/237508/90246627-ecbda400-de2c-11ea-8bfb-b4307bfb975d.png";
    productName.textContent = product.product_name;
    brandName.textContent = product.brand.brand_name;
    productType.textContent = product.product_type.name;

    return content;
};

export default renderSearchProduct;
