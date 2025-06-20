import { fetchProductShop } from "../services/fetchProductShop";
import { renderBreadcrumbTotalProduct } from "./renderBreadcrumbTotalProduct";
import renderProductList from "./renderProductList";

export const renderPagination = (link) => {
    const paginationTemplate = document.querySelector("#pagination-template");
    const container = document.getElementById("product-container");
    const totalProductContainer = document.getElementById(
        "total-product-container"
    );

    if (!paginationTemplate) return;

    const isDisabled = !link.url || link.url === "null";

    // Render button
    const content = paginationTemplate.content.cloneNode(true);
    const paginationBtn = content.querySelector(".pagination-btn");

    if (link.label === "&laquo; Previous") {
        paginationBtn.textContent = "Prev";
    } else if (link.label === "Next &raquo;") {
        paginationBtn.textContent = "Next";
    } else {
        paginationBtn.textContent = link.label;
    }

    // If no URL, it's a disabled button (like "Previous" on first page)
    if (isDisabled) {
        console.log("first");
        const content = paginationTemplate.content.cloneNode(true);
        const paginationBtn = content.querySelector(".pagination-btn");
        paginationBtn.textContent =
            link.label === "&laquo; Previous"
                ? "Prev"
                : link.label === "Next &raquo;"
                ? "Next"
                : link.label;
        paginationBtn.disabled = true;
        paginationBtn.classList.add("opacity-50", "cursor-not-allowed");
        return content;
    }

    // Parse query params to update browser URL
    const urlToParam = (url = "") => {
        const { search } = new URL(url);
        const params = new URLSearchParams(search);
        const queryString = params.toString();

        history.pushState({}, "", location.pathname + "?" + queryString);
    };

    // Handle click
    paginationBtn.onclick = async () => {
        urlToParam(link.url);
        const data = await fetchProductShop(link.url);

        if (data?.data) {
            renderProductList(data?.data, container);
            renderBreadcrumbTotalProduct(data?.total, totalProductContainer);
        }
        console.log(link.url);
        console.log(data);
    };

    return content;
};
