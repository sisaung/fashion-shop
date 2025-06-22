import { fetchProductShop } from "../services/fetchProductShop";
import renderProductList from "./renderProductList";
import { renderBreadcrumbTotalProduct } from "./renderBreadcrumbTotalProduct";
import { renderPaginationList } from "./renderPaginationList";

const initializeSetUpFilterEvent = () => {
    const container = document.getElementById("product-container");
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );

    const paginationContainer = document.getElementById("pagination-container");
    const filterCategoryContainer = document.getElementById(
        "filter-product-category-container"
    );

    const filterProductTypeContainer = document.getElementById(
        "filter-product-type-container"
    );

    const selectedFilters = {
        productCategory_id: null,
        productType_id: null,
    };

    const handleProductCategory = (e) => {
        if (e.target.classList.contains("filter-category-btn")) {
            // Remove active from all
            document.querySelectorAll(".filter-category-btn").forEach((btn) => {
                btn.classList.remove("bg-pearl-bush-400", "text-white");
            });

            // Add active to clicked
            e.target.classList.add("bg-pearl-bush-400", "text-white");

            // ✅ Get selected category ID
            selectedFilters.productCategory_id = e.target.getAttribute(
                "data-product-category"
            );
        }
    };

    const handleProductType = (e) => {
        if (e.target.classList.contains("filter-productType-btn")) {
            document
                .querySelectorAll(".filter-productType-btn")
                .forEach((btn) => {
                    btn.classList.remove("bg-pearl-bush-400", "text-white");
                });

            e.target.classList.add("bg-pearl-bush-400", "text-white");

            // ✅ Get selected type ID
            selectedFilters.productType_id =
                e.target.getAttribute("data-product-type");
        }
    };

    // For product category
    filterCategoryContainer.addEventListener("click", handleProductCategory);

    // For product type
    filterProductTypeContainer.addEventListener("click", handleProductType);

    //apply filter btn

    document
        .getElementById("apply-filters-btn")
        .addEventListener("click", async () => {
            const params = new URLSearchParams();

            if (selectedFilters.productCategory_id) {
                params.append(
                    "filters[productCategory_id]",
                    selectedFilters.productCategory_id
                );
            }

            if (selectedFilters.productType_id) {
                params.append(
                    "filters[productType_id]",
                    selectedFilters.productType_id
                );
            }

            const url = `shop?${params.toString()}`;

            if (
                selectedFilters.productCategory_id ||
                selectedFilters.productType_id
            ) {
                const data = await fetchProductShop(
                    `/shop/get?${params.toString()}`
                );

                if (data?.data) {
                    renderProductList(data?.data, container);
                    renderBreadcrumbTotalProduct(
                        data?.total,
                        totalProductContainer
                    );
                    renderPaginationList(data?.links, paginationContainer);
                }

                history.pushState({}, "", url);
            }

            console.log("Fetching from:", url);
            // fetch(url)...
        });

    //apply resest btn
    document
        .getElementById("apply-clears-btn")
        .addEventListener("click", async () => {
            selectedFilters.productCategory_id = null;
            selectedFilters.productType_id = null;

            document.querySelectorAll(".filter-category-btn").forEach((btn) => {
                btn.classList.remove("bg-pearl-bush-400", "text-white");
            });

            document
                .querySelectorAll(".filter-productType-btn")
                .forEach((btn) => {
                    btn.classList.remove("bg-pearl-bush-400", "text-white");
                });

            const data = await fetchProductShop(`/shop/get`);

            if (data?.data) {
                renderProductList(data?.data, container);
                renderBreadcrumbTotalProduct(
                    data?.total,
                    totalProductContainer
                );
                renderPaginationList(data?.links, paginationContainer);
            }
            window.history.pushState({}, "", "/shop");
            // Reset fetch
            // console.log("Fetching all: /shop");
        });
};

document.addEventListener("DOMContentLoaded", initializeSetUpFilterEvent);
