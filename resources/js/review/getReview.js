import fetchReview from "../services/fetchReview";
import postReviewTime from "./postReviewTime";
import renderReviewList from "./renderReviewList";
import { renderReviewPaginationList } from "./renderReviewPaginationList";

const initializeGetReview = async () => {
    const productId = document.querySelector(".product-id");
    const id = productId.dataset.productId;
    const container = document.querySelector(".review-container");
    const paginationContainer = document.getElementById(
        "review-pagination-container"
    );
    const reviewCountContainer = document.querySelector(
        ".review-count-container"
    );
    const filterBtn = document.querySelectorAll(".filter-btn");

    filterBtn[0].classList.add("active-filter");

    filterBtn.forEach(async (btn) => {
        btn.addEventListener("click", async () => {
            filterBtn.forEach((btn) => btn.classList.remove("active-filter"));
            btn.classList.add("active-filter");
            const ratingCount = btn.dataset.count;

            const data = await fetchReview(
                `/get-review/${id}?filter-rating=${ratingCount}`
            );

            await renderReviewList(data?.data, container, reviewCountContainer);
            await renderReviewPaginationList(data?.links, paginationContainer);
        });
    });

    const data = await fetchReview(`/get-review/${id}`);
    await renderReviewList(data?.data, container, reviewCountContainer);
    await renderReviewPaginationList(data?.links, paginationContainer);

    postReviewTime();
};

document.addEventListener("DOMContentLoaded", initializeGetReview);
