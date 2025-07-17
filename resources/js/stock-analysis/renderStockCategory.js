const renderStockCategory = async (stockCategory) => {
    const template = document.getElementById("total-stock-by-category-template");
    if (!template) return;

    const content = template.content.cloneNode(true);

    const stockCategoryName = content.querySelector(".stock-category-label");
    const totalStockCategory = content.querySelector(".stock-total-category");
    const colorDot = content.querySelector(".color-dot"); // select color dot div

    stockCategoryName.textContent = stockCategory.name;
    totalStockCategory.textContent = stockCategory.stock;

    // set background color
    if (colorDot) {
        colorDot.style.backgroundColor = stockCategory.color;
    }

    return content;
};



export default renderStockCategory
