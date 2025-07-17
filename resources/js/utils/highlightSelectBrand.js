import fetchAllTotalPrice from "../services/fetchAllTotalPrice";
import showAllTotalPrice from "./showAllTotalPrice";

const highlightSelectedBrand = async() => {
    const brandBtns = document.querySelectorAll(".stock-by-brand-btn");
    const params = new URLSearchParams(location.search);
    const selectedBrandId = params.get("stock_by_brand");
    const clearBrand = document.querySelector(".clear-stock-by-brand");

    if (selectedBrandId) {
        clearBrand.classList.remove("hidden");

        brandBtns.forEach((btn) => {
            if (btn.dataset.brandId == selectedBrandId) {
                btn.classList.add("active-selected-stock");
            }
        });
       const data = await fetchAllTotalPrice(params.toString());
       showAllTotalPrice(data)
    } else {
        clearBrand.classList.add("hidden");
    }
};
export default highlightSelectedBrand;
