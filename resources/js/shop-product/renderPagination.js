import { fetchProductShop } from "../services/fetchProductShop";
import { renderBreadcrumbTotalProduct } from "./renderBreadcrumbTotalProduct";
import { renderPaginationList } from "./renderPaginationList";
import renderProductList from "./renderProductList";

// Helper for icons
const getPaginationIcon = (label) => {
    if (label === "&laquo; Previous") {
        return `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" class="size-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>`;
    } else if (label === "Next &raquo;") {
        return `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-4 text-gray-500 ">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>`;
    }
    return null;
};

export const renderPagination = async (link, wishlistProducts) => {
    const paginationTemplate = document.querySelector("#pagination-template");
    const container = document.getElementById("product-container");
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );
    const paginationContainer = document.getElementById("pagination-container");
    const pagelayoutContainer = document.querySelector('.pagelayout-container')

    if (!paginationTemplate) return;

    const isDisabled = !link.url || link.url === "null";
    const content = paginationTemplate.content.cloneNode(true);
    const paginationBtn = content.querySelector(".pagination-btn");

    const icon = getPaginationIcon(link.label);

    if (icon) {
        paginationBtn.innerHTML = icon;

        // Button hover class adjustments
        if (link.label === "&laquo; Previous") {
            paginationBtn.classList.remove(
                "hover:bg-pearl-bush-300",
                "hover:text-white"
            );
        } else {
            paginationBtn.classList.add("hover:text-gray-700");
            paginationBtn.classList.remove(
                "hover:bg-pearl-bush-300",
                "hover:text-white"
            );
        }
    } else {
        paginationBtn.textContent = link.label;
    }

    if (isDisabled) {
        paginationBtn.disabled = true;
        paginationBtn.classList.remove("bg-gray-100");
        paginationBtn.classList.add("pagination-disable");
        return content;
    }

    if (link.active) {
        paginationBtn.classList.remove("bg-gray-100");
        paginationBtn.classList.add("pagination-active");
    }

    const urlToParam = (url = "") => {
        const { search } = new URL(url);
        const params = new URLSearchParams(search);
        const currentParams = new URLSearchParams(location.search);

        // Append or update query params
        for (const [key, value] of params) {
            currentParams.set(key, value);
        }

        const queryString = currentParams.toString();
        history.pushState({}, "", location.pathname + "?" + queryString);
        return queryString;
    };

    paginationBtn.onclick = async () => {
        const queryString = urlToParam(link.url);
        const data = await fetchProductShop(`/shop/get?${queryString}`);

        if (data?.data) {
            await renderProductList(data.data, container, wishlistProducts);
            pagelayoutContainer.scrollTo(0, 0, { behavior: "smooth" });
            renderBreadcrumbTotalProduct(data.total, totalProductContainer);
            await renderPaginationList(
                data.links,
                paginationContainer,
                wishlistProducts
            );
        }
    };

    return content;
};
