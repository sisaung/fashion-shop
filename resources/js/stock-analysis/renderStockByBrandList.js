import renderStockByBrand from "./renderStockByBrand";

const renderStockByBrandList = async(brand, container) => {

    container.innerHTML = ''

    if(brand.length > 0) {
        brand.forEach(async(data) => {
            const content = await renderStockByBrand(data)
            container.appendChild(content)
        });
    }
}
export default renderStockByBrandList
