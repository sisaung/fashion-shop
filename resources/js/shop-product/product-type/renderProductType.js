export const renderProductType = (productType) => {
    const productTypeTemplate = document.querySelector(
        "#filter-product-type-template"
    );
    if (!productTypeTemplate) return;

    const content = productTypeTemplate.content.cloneNode(true);

    const productTypeBtn = content.querySelector(".filter-productType-btn");

    productTypeBtn.textContent = productType.name;
   
    productTypeBtn.setAttribute("data-product-type", productType.id);

    return content;
};
