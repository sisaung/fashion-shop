const renderStockByProductType = (productType) => {
    const template = document.getElementById("stock-by-product-type-template");

    if (!template) return;

    const content = template.content.cloneNode(true);

    const productTypeBtn = content.querySelector('.stock-by-product-type-btn')
    const productTypeName = content.querySelector(".product-type-name");
    const totalProductTypeStock = content.querySelector(
        ".total-product-type-stock"
    );

    productTypeName.textContent = productType.type_name;
    totalProductTypeStock.textContent = productType.total_stock;

    productTypeBtn.setAttribute('data-product-type-id', productType.id)
    // productTypeBtn.setAttribute('data-product-type-id', productType.id)



    return content;
};
export default renderStockByProductType
