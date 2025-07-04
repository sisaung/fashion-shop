import { fetchProductFit } from "../../services/fetchProductFit";
import { fetchProductShop } from "../../services/fetchProductShop";
import { fetchProductSize } from "../../services/fetchProductSize";
import { fetchProductType } from "../../services/fetchProductType";
import renderProductFitList from "../fit/renderProductFitLIst";
import { renderBreadcrumbTotalProduct } from "../renderBreadcrumbTotalProduct";
import { renderPaginationList } from "../renderPaginationList";
import renderProductList from "../renderProductList";
import renderProductSizeList from "../size/renderProductSizeLIst";
import getWishlist from "../wishlist/getWishlist";
import renderProductTypeList from "./renderProductTypeLIst";

const initializeProductType = async () => {
    const container = document.getElementById("product-container");
    const filterCategoryContainer = document.getElementById(
        "filter-product-category-container"
    );

    const filterProductTypeContainer = document.getElementById(
        "filter-product-type-container"
    );
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

    const filterProductText = document.querySelector(".filter-product-text");
    const totalFilterProduct = document.querySelector(".total-filter-product");

    const fitHeading = document.querySelector(".fit-heading");
    const sizeHeading = document.querySelector(".size-heading");

    const urlParams = new URLSearchParams(window.location.search);
    const selectedProductTypeId = urlParams.get("filters[productType_id]");
    const selectedProductFitId = urlParams.get("filters[productFit_id]");
    const selectedProductSizeId = urlParams.get("filters[productSize_id]");

    const selectedFilters = {
        productCategory_id: null,
        productType_id: null,
        productFit_id: null,
        productSize_id: null,
    };

    const params = new URLSearchParams(location.search);
    const paramsObject = Object.fromEntries(params);

    const numberOfFilters = Object.values(paramsObject).length;

    console.log(numberOfFilters)

    // if (!filterProductTypeContainer) return;

    // initialRender
    const productTypeData = await fetchProductType(`/shop/get-product-type`);
    const wishlistProducts = await getWishlist();

    if (productTypeData) {
        renderProductTypeList(productTypeData, filterProductTypeContainer);
    }

    const calculateTotalFilter = (numberOfFilters) => {

        if (numberOfFilters > 0) {
            filterProductText.textContent = `Filtered`;
            filterProductText.classList.add("text-pearl-bush-500",'font-heading');
            totalFilterProduct.classList.remove("hidden");
            totalFilterProduct.textContent = numberOfFilters;
        }

        // return numberOfFilters;
    };

    calculateTotalFilter(numberOfFilters);

    //click product category and filter producttype
    const handleProductCategory = (e) => {
        if (e.target.classList.contains("filter-product-category-radio")) {
            // Remove active from all
            document
                .querySelectorAll(".filter-product-category-label")
                .forEach((label) => {
                    label.classList.remove("bg-pearl-bush-400", "text-white");
                });

            // Add active to clicked
            const selectedLabel = e.target
                .closest("label")
                .querySelector("span");
            selectedLabel.classList.add("bg-pearl-bush-400", "text-white");

            const productCategory_id = e.target.getAttribute(
                "data-product-categpry"
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
        if (e.target.classList.contains("filter-product-type-radio")) {
            document
                .querySelectorAll(".filter-product-type-label")
                .forEach((label) => {
                    label.classList.remove("bg-pearl-bush-400", "text-white");
                });

            // Add active to clicked
            const selectedLabel = e.target
                .closest("label")
                .querySelector("span");
            selectedLabel.classList.add("bg-pearl-bush-400", "text-white");

            const productType_id = e.target.getAttribute("data-product-type");

            const currentProductType = productTypeData.find(
                (productType) => productType.id === Number(productType_id)
            );

            // filter fit
            // const fitData = await fetchProductFit(
            //     `/shop/get-product-fit/${productType_id}`
            // );
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
            //  Get selected type ID
            selectedFilters.productType_id = productType_id;
        }
    };

    const handleProductFit = async (e) => {
        if (e.target.classList.contains("filter-product-fit-radio")) {
            document
                .querySelectorAll(".filter-product-fit-label")
                .forEach((label) => {
                    label.classList.remove("bg-pearl-bush-400", "text-white");
                });

            // Add active to clicked
            const selectedLabel = e.target
                .closest("label")
                .querySelector("span");
            selectedLabel.classList.add("bg-pearl-bush-400", "text-white");

            const productFit_id = e.target.getAttribute("data-product-fit");

            // Get selected fit ID
            selectedFilters.productFit_id = productFit_id;
        }
    };

    const handleProductSize = async (e) => {
        if (e.target.classList.contains("filter-product-size-radio")) {
            document
                .querySelectorAll(".filter-product-size-label")
                .forEach((label) => {
                    label.classList.remove("bg-pearl-bush-400", "text-white");
                });

            // Add active to clicked
            const selectedLabel = e.target
                .closest("label")
                .querySelector("span");
            selectedLabel.classList.add("bg-pearl-bush-400", "text-white");

            const productSize_id = e.target.getAttribute("data-product-size");

            // Get selected size ID
            selectedFilters.productSize_id = productSize_id;
        }
    };

    // populate when refresh

    if (selectedProductFitId) {
        const productFitData = await fetchProductFit(
            `/shop/get-product-fit/${selectedProductTypeId}`
        );
        renderProductFitList(productFitData, filterProductFitContainer);
        fitHeading.classList.toggle("hidden");
    }

    if (selectedProductSizeId) {
        const productSizeData = await fetchProductSize(
            `/shop/get-product-size/${selectedProductTypeId}`
        );
        renderProductSizeList(productSizeData, filterProductSizeContainer);
        sizeHeading.classList.toggle("hidden");
    }
    filterCategoryContainer.addEventListener("change", handleProductCategory);
    filterProductTypeContainer.addEventListener("change", handleProductType);
    filterProductFitContainer.addEventListener("change", handleProductFit);
    filterProductSizeContainer.addEventListener("change", handleProductSize);

    // apply filter
    document
        .getElementById("apply-filters-btn")
        .addEventListener("click", async () => {
            // history.pushState({}, "", "/shop");

            const { search } = window.location;

            const params = new URLSearchParams(search);
            history.pushState({}, "", "shop");

            const selectedProductCategory = document.querySelector(
                "input[name='product-category']:checked"
            );

            const selectedProductType = document.querySelector(
                "input[name='product-type']:checked"
            );

            const selectedProductFit = document.querySelector(
                "input[name='product-fit']:checked"
            );

            const selectedProductSize = document.querySelector(
                "input[name='product-size']:checked"
            );

            if (selectedProductCategory) {
                params.append(
                    "filters[productCategory_id]",
                    selectedProductCategory.value
                );
            }

            if (selectedProductType) {
                params.append(
                    "filters[productType_id]",
                    selectedProductType.value
                );
            }

            if (selectedProductFit) {
                params.append(
                    "filters[productFit_id]",
                    selectedProductFit.value
                );
            }
            if (selectedProductSize) {
                params.append(
                    "filters[productSize_id]",
                    selectedProductSize.value
                );
            }

            const url = `shop?${params.toString()}`;

            history.pushState({}, "", url);

            if (
                selectedFilters.productCategory_id ||
                selectedFilters.productType_id
            ) {
                const productShop = await fetchProductShop(
                    `/shop/get?${params.toString()}`
                );

                console.log(productShop);

                if (productShop?.data) {
                    await renderProductList(
                        productShop?.data,
                        container,
                        wishlistProducts
                    );
                    renderBreadcrumbTotalProduct(
                        productShop?.total,
                        totalProductContainer
                    );
                    await renderPaginationList(
                        productShop?.links,
                        paginationContainer,
                        wishlistProducts
                    );



                    calculateTotalFilter(numberOfFilters)
                }

                // renderProductTypeList(productTypeData, filterProductTypeContainer);

                // history.pushState({}, "", url);
            }
        });

    //apply resest btn
    document
        .getElementById("apply-clears-btn")
        .addEventListener("click", async () => {
            history.pushState({}, "", "/shop");

            selectedFilters.productCategory_id = null;
            selectedFilters.productType_id = null;
            selectedFilters.productFit_id = null;
            selectedFilters.productSize_id = null;

            //  Uncheck all radios
            document
                .querySelectorAll("input[type='radio']")
                .forEach((radio) => (radio.checked = false));

            // Remove active styles from all labels/spans
            document
                .querySelectorAll(
                    ".filter-product-category-label, .filter-product-type-label, .filter-product-fit-label,.filter-product-size-label"
                )
                .forEach((label) => {
                    label.classList.remove("bg-pearl-bush-400", "text-white");
                });

            document
                .querySelectorAll('input[type="checkbox"]')
                .forEach((checkbox) => {
                    checkbox.checked = false;
                });

            //  Hide fit/size sections
            fitHeading.classList.add("hidden");
            sizeHeading.classList.add("hidden");

            //  Clear fit/size containers
            renderProductFitList([], filterProductFitContainer);
            renderProductSizeList([], filterProductSizeContainer);

            //  Reset product type list (for full list again)
            renderProductTypeList(productTypeData, filterProductTypeContainer);

            //  Fetch all products (unfiltered)
            const productShop = await fetchProductShop(`/shop/get`);

            if (productShop?.data) {
                await renderProductList(
                    productShop.data,
                    container,
                    wishlistProducts
                );
                renderBreadcrumbTotalProduct(
                    productShop.total,
                    totalProductContainer
                );
                await renderPaginationList(
                    productShop.links,
                    paginationContainer,
                    wishlistProducts
                );

                filterProductText.textContent = `Filter Product`;
                filterProductText.classList.remove("text-pearl-bush-500");
                totalFilterProduct.classList.add("hidden");
                totalFilterProduct.textContent = "";
            }

            //  Remove filters from URL
            history.pushState({}, "", "/shop");

            // document.querySelectorAll(".filter-category-btn").forEach((btn) => {
            //     btn.classList.remove("bg-pearl-bush-400", "text-white");
            // });

            // document
            //     .querySelectorAll(".filter-productType-btn")
            //     .forEach((btn) => {
            //         btn.classList.remove("bg-pearl-bush-400", "text-white");
            //     });

            // // Reset fetch

            // const productShop = await fetchProductShop(`/shop/get`);

            // if (productShop?.data) {
            //     renderProductList(productShop?.data, container);
            //     renderBreadcrumbTotalProduct(
            //         productShop?.total,
            //         totalProductContainer
            //     );
            //     renderPaginationList(productShop?.links, paginationContainer);
            // }
            // renderProductTypeList(productTypeData, filterProductTypeContainer);
            // renderProductFitList([], filterProductFitContainer);
            // renderProductSizeList([], filterProductSizeContainer);
            // fitHeading.classList.add("hidden");
            // sizeHeading.classList.add("hidden");

            // window.history.pushState({}, "", "/shop");
        });
};

document.addEventListener("DOMContentLoaded", initializeProductType);
export default initializeProductType;
