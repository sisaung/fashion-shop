import { fetchBrand } from "../services/fetchBrand";
import { renderShopBrandList } from "./renderShopBrandList";

export const initializeGetBrand = async () => {
    const filterBrand = document.getElementById("filter-brand");
    const searchParam = window.location.search;

    if (!filterBrand) return;

    const brand = await fetchBrand(`/shop/get-brand${searchParam}`);
    if (brand) {
        await renderShopBrandList(brand, filterBrand);
     



    }
};
document.addEventListener("DOMContentLoaded", initializeGetBrand);
