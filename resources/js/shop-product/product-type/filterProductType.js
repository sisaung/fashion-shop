

const initializeFilterProductType = async () => {

    const filterProductTypeBtn = document.querySelectorAll(
        ".filter-category-btn");

        console.log(filterProductTypeBtn)

    filterProductTypeBtn.forEach((btn) => {
        btn.addEventListener("click", async () => {
            const productType = btn.getAttribute("data-product-type");
            console.log(btn)
        });
    });
};

document.addEventListener("DOMContentLoaded", initializeFilterProductType);
export default initializeFilterProductType;
