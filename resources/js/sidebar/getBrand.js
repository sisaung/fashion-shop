import { fetchBrand } from "../services/fetchBrand";
import { renderShopBrandList } from "./renderShopBrandList";

export const initializeGetBrand = async () => {
    const filterBrand = document.getElementById("filter-brand");
    const searchParam = window.location.search;
    const selectedBrands = new URLSearchParams(window.location.search).getAll(
        "brands[]"
    );

    console.log(selectedBrands);

    if (!filterBrand) return;

    const brand = await fetchBrand(`/shop/get-brand${searchParam}`);
    if (brand) {
        await renderShopBrandList(brand, filterBrand);
        const checkbox = document.querySelectorAll('input[type="checkbox"]');

        checkbox.forEach((el) => {
            if (selectedBrands.includes(el.value)) {
                el.checked = true;
            }
        });
    }
};
document.addEventListener("DOMContentLoaded", initializeGetBrand);
