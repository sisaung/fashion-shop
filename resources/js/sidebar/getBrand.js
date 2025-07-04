import { fetchBrand } from "../services/fetchBrand";
import { fetchProductShop } from "../services/fetchProductShop";
import { renderShopBrandList } from "./renderShopBrandList";

const initializeGetBrand = async () => {
    const filterBrand = document.getElementById("filter-brand");
    const searchParam = window.location.search;

    if (!filterBrand) return;

    const brand = await fetchBrand(`/shop/get-brand${searchParam}`);
    if (brand) {
        await renderShopBrandList(brand, filterBrand);
        const checkedBrandInputs = document.querySelectorAll(
            'input[name="brands[]"]'
        );

        

    }
};
document.addEventListener("DOMContentLoaded", initializeGetBrand);
