export const renderProductType = (productType) => {
    const productTypeTemplate = document.querySelector(
        "#filter-product-type-template"
    );
    if (!productTypeTemplate) return;

    const urlParams = new URLSearchParams(window.location.search);
    const selectedProductTypeId = urlParams.get("filters[productType_id]");

    const content = productTypeTemplate.content.cloneNode(true);

    const input = content.querySelector("input");
    const span = content.querySelector("span");

    input.setAttribute("data-product-type", productType.id);
    input.value = productType.id;
    span.textContent = productType.name;



    if (String(productType.id) == selectedProductTypeId) {
        input.checked = true;
        span.classList.add("bg-pearl-bush-400", "text-white");

    }

    return content;
};
