export const renderProductCategory = (category) => {
    const productCategoryTemplate = document.querySelector(
        "#filter-product-category-template"
    );
    if (!productCategoryTemplate) return;



    const urlParams = new URLSearchParams(window.location.search);
    const selectedProductCategoryId = urlParams.get(
        "filters[productCategory_id]"
    );

    const content = productCategoryTemplate.content.cloneNode(true);
    const input = content.querySelector("input");
    const span = content.querySelector("span");

    input.setAttribute("data-product-categpry", category.id);
    input.value = category.id;
    span.textContent = category.category_name;


    if (String(category.id) === selectedProductCategoryId) {
        input.checked = true;
        span.classList.add("bg-pearl-bush-400", "text-white");
    }

    return content;
};
