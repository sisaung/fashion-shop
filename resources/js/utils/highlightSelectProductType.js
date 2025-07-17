const highlightSelectProductType = async () => {
    const params = new URLSearchParams(location.search);
    const selectedProductTypeId = params.get("stock_by_product_type");
    const productTypeBtns = document.querySelectorAll(
        ".stock-by-product-type-btn"
    );
    const clearProductType = document.querySelector(
        ".clear-stock-by-product-type"
    );

    // Highlight button if already selected via URL
    if (selectedProductTypeId) {
        clearProductType.classList.remove("hidden");
        productTypeBtns.forEach((btn) => {
            if (btn.dataset.productTypeId === selectedProductTypeId) {
                btn.classList.add(
                    "bg-pearl-bush-100",
                    "text-pearl-bush-700",
                    "border",
                    "border-pearl-bush-300"
                );
            }
        });
        await updateBrandAndChart(selectedProductTypeId);
    }
};
export default highlightSelectProductType;
