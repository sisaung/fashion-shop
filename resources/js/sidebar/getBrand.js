import { fetchBrand } from "../services/fetchBrand";
import { renderShopBrandList } from "./renderShopBrandList";

const initializeGetBrand = async () => {
    const filterBrand = document.getElementById("filter-brand");


    if (!filterBrand) return;

    const data = await fetchBrand(`/shop/get-brand`);
    if (data) {

        renderShopBrandList(data, filterBrand);
    }

    // content.querySelector(".brand-name").textContent = brand.brand_name;
};
document.addEventListener("DOMContentLoaded", initializeGetBrand);
