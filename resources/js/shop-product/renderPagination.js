import { fetchProductShop } from "../services/fetchProductShop";
import { renderBreadcrumbTotalProduct } from "./renderBreadcrumbTotalProduct";
import { renderPaginationList } from "./renderPaginationList";
import renderProductList from "./renderProductList";

export const renderPagination = async (link, wishlistProducts) => {
    const paginationTemplate = document.querySelector("#pagination-template");
    const container = document.getElementById("product-container");
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );

    const paginationContainer = document.getElementById("pagination-container");

    const currentSearchParam = location.search;

    if (!paginationTemplate) return;

    const isDisabled = !link.url || link.url === "null";

    // Render button
    const content = paginationTemplate.content.cloneNode(true);
    const paginationBtn = content.querySelector(".pagination-btn");

    if (link.label === "&laquo; Previous") {
        paginationBtn.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>`;
        paginationBtn.classList.remove(
            "hover:bg-pearl-bush-300",
            "hover:text-white"
        );
    } else if (link.label === "Next &raquo;") {
        paginationBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4 text-gray-500 ">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>`;
        paginationBtn.classList.add("hover:text-gray-700");
        paginationBtn.classList.remove(
            "hover:bg-pearl-bush-300",
            "hover:text-white"
        );
    } else {
        paginationBtn.textContent = link.label;
    }

    // If no URL, it's a disabled button (like "Previous" on first page)
    if (isDisabled) {
        const content = paginationTemplate.content.cloneNode(true);
        const paginationBtn = content.querySelector(".pagination-btn");
        paginationBtn.innerHTML =
            link.label === "&laquo; Previous"
                ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                        </svg>`
                : link.label === "Next &raquo;"
                ? `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                        </svg>`
                : link.label;
        paginationBtn.disabled = true;
        paginationBtn.classList.remove("bg-gray-100");
        paginationBtn.classList.add("pagination-disable");
        return content;
    }

    // Parse query params to update browser URL
    // const urlToParam = (url = "") => {
    //     const { search } = new URL(url);
    //     const params = new URLSearchParams(search);
    //     const currentParams = new URLSearchParams(currentSearchParam);

    //     const paramObj = Object.fromEntries(params);
    //     const currentParamObj = Object.fromEntries(currentParams);

    //     const newParamObj = { ...currentParamObj, ...paramObj };

    //     const newParam = new URLSearchParams(newParamObj).toString();

    //     const queryString = newParam.toString();

    //     history.pushState({}, "", location.pathname + "?" + queryString);
    //     return queryString;
    // };
    const urlToParam = (url = "") => {
        const { search } = new URL(url);
        const params = new URLSearchParams(search);
        const currentParams = new URLSearchParams(currentSearchParam);

        const paramObj = Object.fromEntries(params);
        const currentParamObj = Object.fromEntries(currentParams);

        const newParamObj = { ...currentParamObj, ...paramObj };

        const newParam = new URLSearchParams(newParamObj).toString();

        const queryString = newParam.toString();


        history.pushState({}, "", location.pathname + "?" + queryString);
        
        return queryString;
    };

    if (link.active) {
        paginationBtn.classList.remove("bg-gray-100");
        paginationBtn.classList.add("pagination-active");
    }

    // Handle click
    paginationBtn.onclick = async () => {
        console.log(link.url)
        const queryString = urlToParam(link.url);
        // window.history.pushState(
        //     {},
        //     "",
        //     location.origin + location.pathname + "?" + queryString
        // );

        console.log(queryString)
        const data = await fetchProductShop(`/shop/get?${queryString}`);

        if (data?.data) {
            await renderProductList(data?.data, container, wishlistProducts);
            renderBreadcrumbTotalProduct(data?.total, totalProductContainer);

            await renderPaginationList(
                data?.links,
                paginationContainer,
                wishlistProducts
            );
        }
    };

    return content;
};
// size-8 inline-flex justify-center items-center rounded-full text-sm font-bold text-white bg-pearl-bush-300
