// import { fetchProductShop } from "../services/fetchProductShop";
// import { renderBreadcrumbTotalProduct } from "../shop-product/renderBreadcrumbTotalProduct";
// import { renderPaginationList } from "../shop-product/renderPaginationList";
// import renderProductList from "../shop-product/renderProductList";

// document.addEventListener("DOMContentLoaded", function () {
//     const container = document.getElementById("product-container");
//     const totalProductContainer = document.getElementById(
//         "total-product-container"
//     );

//     const paginationContainer = document.getElementById("pagination-container");
//     const searchParams = location.search;

//     const currentSearchParams = new URLSearchParams(searchParams);
//     const currentSearchParamsObj = Object.fromEntries(currentSearchParams);

//     // const currentStockParam = currentSearchParamsObj.in_stock;

//     // console.log(currentStockParam)

//     const sidebar = document.getElementById("sidebar");
//     const closeBtn = document.getElementById("closeSidebar");
//     closeBtn?.addEventListener("click", () => {
//         sidebar.classList.add("-translate-x-full");
//     });

//     // Dropdown toggles
//     document.querySelectorAll(".filter-toggle").forEach((button) => {
//         const target = button.getAttribute("data-target");
//         const section = document.getElementById(`filter-${target}`);
//         const chevron = document.getElementById(`chevron-${target}`);

//         button.addEventListener("click", () => {
//             const isOpen =
//                 section.style.maxHeight && section.style.maxHeight !== "0px";

//             if (isOpen) {
//                 section.style.maxHeight = "0px";
//                 chevron.innerHTML = `
//             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
//                 stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-600">
//               <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
//             </svg>
//           `;
//             } else {
//                 section.style.maxHeight = section.scrollHeight + "px";
//                 chevron.innerHTML = `
//             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
//                 stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-600">
//               <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
//             </svg>
//           `;
//             }
//         });
//     });

//     // Stock toggle animation
//     const stockCheckbox = document.getElementById("inStockOnly");
//     const toggleBg = document.getElementById("stockToggleBg");
//     const toggleDot = document.getElementById("stockToggleDot");

//     async function updateToggleUI() {
//         if (stockCheckbox.checked) {
//             const newParamsObj = { ...currentSearchParamsObj, in_stock: 1 };

//             const newSearchParam = new URLSearchParams(newParamsObj).toString();

//             const newUrl =
//                 location.origin + location.pathname + "?" + newSearchParam;
//             history.pushState({}, "", newUrl);

//             const data = await fetchProductShop(`/shop/get?${newSearchParam}`);

//             if (data?.data) {
//                 renderProductList(data?.data, container);
//                 renderBreadcrumbTotalProduct(
//                     data?.total,
//                     totalProductContainer
//                 );
//                 renderPaginationList(data?.links, paginationContainer);
//             }

//             toggleBg.classList.remove("bg-gray-300");
//             toggleBg.classList.add("bg-pearl-bush-500");
//             toggleDot.style.transform = "translateX(16px)";
//         } else {
//             const clearSearchParam = new URLSearchParams(
//                 currentSearchParamsObj
//             ).toString();

//             if (clearSearchParam != "") {
//                 const clearUrl =
//                     location.origin +
//                     location.pathname +
//                     "?" +
//                     clearSearchParam;
//                 history.pushState({}, "", clearUrl);
//                 const data = await fetchProductShop(`/shop/get?${clearSearchParam}`);

//                 if (data?.data) {
//                     renderProductList(data?.data, container);
//                     renderBreadcrumbTotalProduct(
//                         data?.total,
//                         totalProductContainer
//                     );
//                     renderPaginationList(data?.links, paginationContainer);
//                 }
//             } else {
//                 const clearUrl = location.origin + location.pathname;
//                 console.log(clearUrl)
//                 const data = await fetchProductShop(`/shop/get`);
//                 console.log(data)

//                     renderProductList(data?.data, container);
//                     renderBreadcrumbTotalProduct(
//                         data?.total,
//                         totalProductContainer
//                     );
//                     renderPaginationList(data?.links, paginationContainer);

//                 history.pushState({}, "", clearUrl);
//             }

//             toggleBg.classList.remove("bg-pearl-bush-500");
//             toggleBg.classList.add("bg-gray-300");
//             toggleDot.style.transform = "translateX(0)";
//         }
//     }

//     if (stockCheckbox) {
//         updateToggleUI();
//         stockCheckbox.addEventListener("change", updateToggleUI);
//     }
// });
import { fetchBrand } from "../services/fetchBrand";
import { fetchProductShop } from "../services/fetchProductShop";
import { renderBreadcrumbTotalProduct } from "../shop-product/renderBreadcrumbTotalProduct";
import { renderPaginationList } from "../shop-product/renderPaginationList";
import renderProductList from "../shop-product/renderProductList";
import getWishlist from "../shop-product/wishlist/getWishlist";
import { renderShopBrandList } from "./renderShopBrandList";
import updateToggleUI from "./updateToggleUI";

document.addEventListener("DOMContentLoaded", async () => {
    const container = document.getElementById("product-container");
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );
    const paginationContainer = document.getElementById("pagination-container");
    const sidebar = document.getElementById("sidebar");
    const closeBtn = document.getElementById("closeSidebar");
    const stockCheckbox = document.getElementById("inStockOnly");
   
    const filterBrand = document.getElementById("filter-brand");

    const currentSearchParams = new URLSearchParams(location.search);
    const currentParamsObj = Object.fromEntries(currentSearchParams);

    // Update toggle UI styling


    if (currentSearchParams.get("in_stock") === "1") {
        stockCheckbox.checked = true;
        updateToggleUI(true);
    }else{
        stockCheckbox.checked = false;
        updateToggleUI(false);
    }

    const wishlistProducts = await getWishlist();

    // Sidebar close button
    closeBtn?.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
    });

    // Dropdown toggle functionality
    document.querySelectorAll(".filter-toggle").forEach((button) => {
        const target = button.getAttribute("data-target");
        const section = document.getElementById(`filter-${target}`);
        const chevron = document.getElementById(`chevron-${target}`);

        button.addEventListener("click", () => {
            const isOpen =
                section.style.maxHeight && section.style.maxHeight !== "0px";
            section.style.maxHeight = isOpen
                ? "0px"
                : `${section.scrollHeight}px`;

            chevron.innerHTML = isOpen
                ? getChevronDownIcon()
                : getChevronUpIcon();
        });
    });

    // Stock toggle handler
    const handleStockToggle = async () => {
        let newParamsObj = { ...currentParamsObj };

        if (stockCheckbox.checked) {
            newParamsObj.in_stock = 1;
        } else {
            delete newParamsObj.in_stock;
        }

        const newSearchParams = new URLSearchParams(newParamsObj).toString();
        const newUrl = `${location.origin}${location.pathname}${
            newSearchParams ? "?" + newSearchParams : ""
        }`;
        history.pushState({}, "", newUrl);

        const data = await fetchProductShop(
            `/shop/get${newSearchParams ? "?" + newSearchParams : ""}`
        );

        const brand = await fetchBrand(
            `/shop/get-brand${newSearchParams ? "?" + newSearchParams : ""}`
        );

        if (brand) {
            await renderShopBrandList(brand, filterBrand);
        }

        if (data?.data) {
            await renderProductList(data.data, container, wishlistProducts);
            renderBreadcrumbTotalProduct(data.total, totalProductContainer);
            renderPaginationList(data.links, paginationContainer);
        }

        updateToggleUI(stockCheckbox.checked);
    };

    // Chevron icon helpers
    const getChevronDownIcon = () => `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-600">
          <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
        </svg>`;

    const getChevronUpIcon = () => `
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor" class="size-5 text-gray-600">
          <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
        </svg>`;

    // Initialize stock toggle functionality
    if (stockCheckbox) {
        // handleStockToggle(); // initial load
        stockCheckbox.addEventListener("change", handleStockToggle);
    }
});
