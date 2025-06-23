export const renderProductSize = (productSize) => {
    const productSizeTemplate = document.querySelector(
        "#filter-product-size-template"
    );
    if (!productSizeTemplate) return;

    const urlParams = new URLSearchParams(window.location.search);
    const selectedProductSizeId = urlParams.get("filters[productSize_id]");

    const content = productSizeTemplate.content.cloneNode(true);
    const input = content.querySelector("input");
    const span = content.querySelector("span");

    input.setAttribute("data-product-size", productSize.id);
    input.value = productSize.id;
    span.textContent = productSize.size_name;

    if (String(productSize.id) === selectedProductSizeId) {
        input.checked = true;
        span.classList.add("bg-pearl-bush-400", "text-white");
    }

    return content;
};
