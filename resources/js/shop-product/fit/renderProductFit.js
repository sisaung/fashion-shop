export const renderProductFit = (productFit) => {
    const productFitTemplate = document.querySelector(
        "#filter-product-fit-template"
    );
    if (!productFitTemplate) return;

    const urlParams = new URLSearchParams(window.location.search);
    const selectedProductFitId = urlParams.get("filters[productFit_id]");

    const content = productFitTemplate.content.cloneNode(true);

    const input = content.querySelector("input");
    const span = content.querySelector("span");

    input.setAttribute("data-product-fit", productFit.id);
    input.value = productFit.id;
    span.textContent = productFit.fit_name;

    console.log(selectedProductFitId)
    if (String(productFit.id) === selectedProductFitId) {
        input.checked = true;
        span.classList.add("bg-pearl-bush-400", "text-white");
    }

    return content;
};
