import renderStockByProductType from "./renderStockByProductType";

const renderStockByProductTypeList = async (productType, container) => {

    container.innerHTML = ''

    if(productType.length > 0) {
        productType.forEach(async (data) => {
            const content = await renderStockByProductType(data)
            container.appendChild(content)
        });
    }
}
export default renderStockByProductTypeList
