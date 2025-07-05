import fetchReview from "../services/fetchReview";
import postReviewTime from "./postReviewTime";

import renderReviewList from "./renderReviewList";
import { renderReviewPaginationList } from "./renderReviewPaginationList";

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

export const renderReviewPagination = async (link) => {
    const reviewPaginationTemplate = document.querySelector(
        "#review-pagination-template"
    );
    const container = document.querySelector(".review-container");
    const paginationContainer = document.getElementById(
        "review-pagination-container"
    );
    const reviewCountContainer = document.querySelector(
        ".review-count-container"
    );

    if (!reviewPaginationTemplate) return;

    const isDisabled = !link.url || link.url === "null";
    const content = reviewPaginationTemplate.content.cloneNode(true);
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

    paginationBtn.onclick = async () => {
        // const data = await fetchProductShop(`/shop/get?${queryString}`);
        const data = await fetchReview(`${link.url}`);
        if (data?.data) {
            await renderReviewList(data?.data, container, reviewCountContainer);
            await renderReviewPaginationList(data?.links, paginationContainer);
            postReviewTime();
        }
    };

    return content;
};
