import { fetchBrand } from "../services/fetchBrand";
import { fetchProductShop } from "../services/fetchProductShop";
import { renderShopBrandList } from "./renderShopBrandList";

const initializeGetBrand = async () => {
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
        window.history.pushState({}, "", "/shop");

        const url = new URL(window.location);
        const params = new URLSearchParams(url.search);

        const checkbox = document.querySelectorAll('input[type="checkbox"]');

        checkbox.forEach((el) => {
            if (selectedBrands.includes(el.value)) {
                params.append("brands[]", el.value);
                url.search = params;

                window.history.pushState({}, "", url);
                el.checked = true;
            }
        });

    }
};
document.addEventListener("DOMContentLoaded", initializeGetBrand);
