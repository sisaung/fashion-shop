import renderStockCategory from "./renderStockCategory";

const renderStockCategoryList = (stockCategories, container) => {
    container.innerHTML = "";

    if (stockCategories.length > 0) {
        // find max stock
        stockCategories.sort((a, b) => b.stock - a.stock);

        const maxStock = Math.max(...stockCategories.map((c) => c.stock));

        // your fixed colors
        const fixedColors = [
            "#9b6c5b",
            "#a87d67",
            "#b79580",
            "#ccb6a5",
            "#e0d3c8",
        ];

        stockCategories.forEach(async (stockCategory, index) => {
            // assign bright color if highest
            if (stockCategory.stock === maxStock) {
                stockCategory.color = "#81584d"; // bright gold
            } else {
                stockCategory.color = fixedColors[index % fixedColors.length];
            }

            const content = await renderStockCategory(stockCategory);
            container.appendChild(content);
        });
    }
};
export default renderStockCategoryList;
