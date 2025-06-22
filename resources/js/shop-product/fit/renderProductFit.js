export const renderProductFit = (productFit) => {
    const productFitTemplate = document.querySelector(
        "#filter-product-fit-template"
    );
    if (!productFitTemplate) return;

    const content = productFitTemplate.content.cloneNode(true);
    // const fitHeader = content.querySelector(".fit-heading");
    // fitHeader.textContent = "Product Fit Filter";

    const productFitBtn = content.querySelector(".filter-product-fit-btn");

    productFitBtn.textContent = productFit.fit_name;

    productFitBtn.setAttribute("data-product-fit", productFit.id);

    return content;
};
