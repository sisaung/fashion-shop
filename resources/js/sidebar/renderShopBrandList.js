import { renderShopBrand } from "./renderShopBrand";

export const renderShopBrandList = async(data, container) => {
    container.innerHTML = "";
    if (data) {
        for (let brand of data) {
            const brandList = await renderShopBrand(brand);

            container.appendChild(brandList);
        }
    }
};
