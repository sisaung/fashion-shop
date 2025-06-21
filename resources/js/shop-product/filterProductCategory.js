

const initializeFilterProductCategory = async () => {

    const filterProductCategoryBtn = document.querySelectorAll(
        ".filter-category-btn");

        console.log(filterProductCategoryBtn)

    filterProductCategoryBtn.forEach((btn) => {
        btn.addEventListener("click", async () => {
            const productCategory = btn.getAttribute("data-product-category");
            console.log(btn)
        });
    });
};

document.addEventListener("DOMContentLoaded", initializeFilterProductCategory);
export default initializeFilterProductCategory;
