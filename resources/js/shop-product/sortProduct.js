import { fetchProductShop } from "../services/fetchProductShop";
import urlString from "../utils/urlString";
import renderProductList from "./renderProductList";

const initializeSortProduct = () => {
    const sortBy = document.querySelector(".sort-product");
    const container = document.getElementById("product-container");
    const sortProductBtn = document.querySelector(".sort-product-btn");
    const sortItems = document.querySelectorAll(".sort-item");
    const dropDownMenu = document.getElementById("dropdown1");

    sortProductBtn.textContent = "Sort Product";

    if (!container) return;

    sortItems.forEach((item) => {
        item.addEventListener("click", async () => {
            const sort = item.dataset.sortProduct;

            const [sortBy, sortDirection] = sort.split("&");
            const url = urlString(sortBy, sortDirection, true);

            const data = await fetchProductShop(`/shop/get${url}`);

            if (data?.data) {
                renderProductList(data?.data, container);
            }
            history.pushState({}, "", url);

            sortProductBtn.textContent = item.textContent;

            // clear all active check icons
            const allActiveIcons = document.querySelectorAll(
                ".active-sort-product"
            );
            allActiveIcons.forEach((icon) => {
                icon.innerHTML = "";
            });

            // add check icon to the clicked item's active-sort-product
            const currentActiveIcon = item.querySelector(
                ".active-sort-product"
            );
            if (currentActiveIcon) {
                currentActiveIcon.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="size-3.5">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                        clip-rule="evenodd" />
                </svg>
            `;
            }

            dropDownMenu.classList.add("hidden");
        });
    });

    // sort product
    // const handleChange = async (e) => {
    //     const sort = e.target.value;

    //     const [sortBy, sortDirection] = sort.split("&");
    //     const url = urlString(sortBy, sortDirection, true);
    //     const data = await fetchProductShop(`/shop/get${url}`);

    //     if (data?.data) {
    //         renderProductList(data?.data, container);
    //     }
    //     history.pushState({}, "", url);
    // };

    // sortBy.addEventListener("change", handleChange);
};

document.addEventListener("DOMContentLoaded", initializeSortProduct);
