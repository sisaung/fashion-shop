const renderStockByBrand = (brand) => {
    const template = document.getElementById("stock-by-brand-template");

    if (!template) return;

    const content = template.content.cloneNode(true);

    const brandName = content.querySelector(".brand-name");
    const totalBrandStock = content.querySelector(".total-brand-stock");

    const brandBtn = content.querySelector(".stock-by-brand-btn");

    brandBtn.setAttribute("data-brand-id", brand.id);

    brandName.textContent = brand.brand_name;
    totalBrandStock.textContent = brand.total_stock;

    return content;
};
export default renderStockByBrand;
