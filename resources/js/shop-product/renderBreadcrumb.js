export const renderBreadcrumb = (total) => {
    const totalProductTemplate = document.querySelector(
        "#total-product-template"
    );
    if (!totalProductTemplate) return;

    const content = totalProductTemplate.content.cloneNode(true);

    const totalProduct = content.querySelector(".total-product");
    totalProduct.textContent = "0";

    totalProduct.textContent = `Total Product ${total}`;

    return content;
};
