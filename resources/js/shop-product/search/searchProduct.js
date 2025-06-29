import { fetchProductShop } from "../../services/fetchProductShop";
import debounce from "../../utils/debounce";
import renderSearchProductList from "./renderSearchProductList";

const initializeSearchProduct = () => {
    const searchProduct = document.getElementById("search-product");

    const searchProductContainer = document.querySelector(
        ".search-product-result-container"
    );

    const searchHeaderResult = document.querySelector(".header-search-result");
    const searchResultBtn = document.querySelector(".search-result-btn");

    if (!searchProduct) return;
    searchHeaderResult.classList.add("hidden");

    const handleKeyUp = async (e) => {
        const searchValue = e.target.value;
        const data = await fetchProductShop(`/shop/get?q=${searchValue}`);
        if (searchValue) {
            if (data?.data) {
                debounce(
                    renderSearchProductList(data?.data, searchProductContainer),
                    500
                );

                searchHeaderResult.classList.remove("hidden");
                searchResultBtn.classList.remove("hidden");

                searchResultBtn.textContent = `Search all results for "${searchValue}" `;

                // go to product detail
                const searchProductItem = document.querySelectorAll(
                    ".search-product-item"
                );

                searchProductItem.forEach((item) => {
                    item.addEventListener("click", () => {
                        console.log(item.dataset.productSlug);
                        location.href = `/shop-product/${item.dataset.productSlug}`;
                    });
                });

                // click all search result
                const handleSearchResultBtn = () => {
                    location.href = `/shop?q=${searchValue}`;
                };

                searchResultBtn.addEventListener(
                    "click",
                    handleSearchResultBtn
                );
            }
        } else {
            searchHeaderResult.classList.add("hidden");
            searchProductContainer.innerHTML = "";
            searchResultBtn.classList.add("hidden");
        }
    };

    searchProduct.addEventListener("keyup", handleKeyUp);
};
document.addEventListener("DOMContentLoaded", initializeSearchProduct);
