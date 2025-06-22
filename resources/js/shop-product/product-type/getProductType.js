import { fetchProductFit } from "../../services/fetchProductFit";
import { fetchProductShop } from "../../services/fetchProductShop";
import { fetchProductType } from "../../services/fetchProductType";
import renderProductFitList from "../fit/renderProductFitLIst";
import { renderBreadcrumbTotalProduct } from "../renderBreadcrumbTotalProduct";
import { renderPaginationList } from "../renderPaginationList";
import renderProductList from "../renderProductList";
import renderProductSizeList from "../size/renderProductSizeLIst";
import renderProductTypeList from "./renderProductTypeLIst";

const initializeProductType = async () => {
    const container = document.getElementById("product-container");
    // const productTypeContainer = document.getElementById(
    //     "filter-product-type-container"
    // );
    const filterProductFitContainer = document.getElementById(
        "filter-product-fit-container"
    );
    const filterProductSizeContainer = document.getElementById(
        "filter-product-size-container"
    );

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
    const fitHeading = document.querySelector(".fit-heading");
    const sizeHeading = document.querySelector(".size-heading");

    const selectedFilters = {
        productCategory_id: null,
        productType_id: null,
        productFit_id: null,
        productSize_id: null,
    };

    if (!filterProductTypeContainer) return;

    // initialRender
    const productTypeData = await fetchProductType(`/shop/get-product-type`);

    if (productTypeData) {
        renderProductTypeList(productTypeData, filterProductTypeContainer);
    }

    //click product category and filter producttype
    const handleProductCategory = (e) => {
        if (e.target.classList.contains("filter-category-btn")) {
            // Remove active from all
            document.querySelectorAll(".filter-category-btn").forEach((btn) => {
                btn.classList.remove("bg-pearl-bush-400", "text-white");
            });

            // Add active to clicked
            e.target.classList.add("bg-pearl-bush-400", "text-white");
            const productCategory_id = e.target.getAttribute(
                "data-product-category"
            );

            const filterProductType = productTypeData.filter(
                (productType) =>
                    productType.product_category_id ===
                    Number(productCategory_id)
            );

            renderProductTypeList(
                filterProductType,
                filterProductTypeContainer
            );
            selectedFilters.productCategory_id = productCategory_id;
        }
    };

    const handleProductType = async (e) => {
        if (e.target.classList.contains("filter-productType-btn")) {
            document
                .querySelectorAll(".filter-productType-btn")
                .forEach((btn) => {
                    btn.classList.remove("bg-pearl-bush-400", "text-white");
                });

            e.target.classList.add("bg-pearl-bush-400", "text-white");

            const productType_id = e.target.getAttribute("data-product-type");

            const currentProductType = productTypeData.find(
                (productType) => productType.id === Number(productType_id)
            );

            // filter fit
            const fitData = currentProductType.fits;

            renderProductFitList(fitData, filterProductFitContainer);
            fitData.length > 0
                ? fitHeading.classList.remove("hidden")
                : fitHeading.classList.add("hidden");

            // filter size

            const sizeData = currentProductType.sizes;

            renderProductSizeList(sizeData, filterProductSizeContainer);
            sizeData.length > 0
                ? sizeHeading.classList.remove("hidden")
                : sizeHeading.classList.add("hidden");

            if (fitData.length === 0) {
                console.log(fitData);
                selectedFilters.productFit_id = null;
                selectedFilters.productSize_id = null;
            }

            // console.log(fitData);
            // ✅ Get selected type ID
            selectedFilters.productType_id = productType_id;
            console.log(selectedFilters);
            console.log(fitData);
        }
    };

    const handleProductFit = async (e) => {
        if (e.target.classList.contains("filter-product-fit-btn")) {
            document
                .querySelectorAll(".filter-product-fit-btn")
                .forEach((btn) => {
                    btn.classList.remove("bg-pearl-bush-400", "text-white");
                });

            e.target.classList.add("bg-pearl-bush-400", "text-white");

            const productFit_id = e.target.getAttribute("data-product-fit");

            // Get selected fit ID
            selectedFilters.productFit_id = productFit_id;
        }
    };

    const handleProductSize = async (e) => {
        if (e.target.classList.contains("filter-product-size-btn")) {
            document
                .querySelectorAll(".filter-product-size-btn")
                .forEach((btn) => {
                    btn.classList.remove("bg-pearl-bush-400", "text-white");
                });

            e.target.classList.add("bg-pearl-bush-400", "text-white");

            const productSize_id = e.target.getAttribute("data-product-size");

            // Get selected fit ID
            selectedFilters.productSize_id = productSize_id;
        }
    };

    filterCategoryContainer.addEventListener("click", handleProductCategory);
    filterProductTypeContainer.addEventListener("click", handleProductType);
    filterProductFitContainer.addEventListener("click", handleProductFit);
    filterProductSizeContainer.addEventListener("click", handleProductSize);

    // apply filter
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

            if (selectedFilters.productFit_id) {
                params.append(
                    "filters[productFit_id]",
                    selectedFilters.productFit_id
                );
            }
            if (selectedFilters.productSize_id) {
                params.append(
                    "filters[productSize_id]",
                    selectedFilters.productSize_id
                );
            }

            const url = `shop?${params.toString()}`;

            if (
                selectedFilters.productCategory_id ||
                selectedFilters.productType_id
            ) {
                const productShop = await fetchProductShop(
                    `/shop/get?${params.toString()}`
                );

                if (productShop?.data) {
                    console.log(productShop?.data);
                    renderProductList(productShop?.data, container);
                    renderBreadcrumbTotalProduct(
                        productShop?.total,
                        totalProductContainer
                    );
                    renderPaginationList(
                        productShop?.links,
                        paginationContainer
                    );
                }

                // renderProductTypeList(productTypeData, filterProductTypeContainer);

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
            selectedFilters.productFit_id = null;

            document.querySelectorAll(".filter-category-btn").forEach((btn) => {
                btn.classList.remove("bg-pearl-bush-400", "text-white");
            });

            document
                .querySelectorAll(".filter-productType-btn")
                .forEach((btn) => {
                    btn.classList.remove("bg-pearl-bush-400", "text-white");
                });

            // Reset fetch

            const productShop = await fetchProductShop(`/shop/get`);

            if (productShop?.data) {
                renderProductList(productShop?.data, container);
                renderBreadcrumbTotalProduct(
                    productShop?.total,
                    totalProductContainer
                );
                renderPaginationList(productShop?.links, paginationContainer);
            }
            renderProductTypeList(productTypeData, filterProductTypeContainer);
            renderProductFitList([], filterProductFitContainer);
            renderProductSizeList([], filterProductSizeContainer);
            fitHeading.classList.add("hidden");
            sizeHeading.classList.add("hidden");

            window.history.pushState({}, "", "/shop");
        });
};

document.addEventListener("DOMContentLoaded", initializeProductType);
export default initializeProductType;
