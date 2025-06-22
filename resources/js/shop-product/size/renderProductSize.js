export const renderProductSize = (productSize) => {
    const productSizeTemplate = document.querySelector(
        "#filter-product-size-template"
    );
    if (!productSizeTemplate) return;

    const content = productSizeTemplate.content.cloneNode(true);


    const productSizeBtn = content.querySelector(".filter-product-size-btn");

    productSizeBtn.textContent = productSize.size_name;

    productSizeBtn.setAttribute("data-product-size", productSize.id);

    return content;
};
