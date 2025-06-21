export const renderProductCategory = (category) => {
    const productCategoryTemplate = document.querySelector(
        "#filter-product-category-template"
    );
    if (!productCategoryTemplate) return;

    const content = productCategoryTemplate.content.cloneNode(true);

    const categoryBtn = content.querySelector(".filter-category-btn");

    categoryBtn.textContent = category.category_name;
    categoryBtn.setAttribute("data-product-category", category.id);



    return content;
};
