import fetchReview from "../services/fetchReview";
import renderReviewList from "./renderReviewList";

const initializeGetReview = async () => {
    const productId = document.querySelector(".product-id");
    const id = productId.dataset.productId;
    const container = document.querySelector(".review-container");
    const reviewCountContainer = document.querySelector(
        ".review-count-container"
    );
    const data = await fetchReview(`/get-review/${id}`);
    renderReviewList(data?.data, container,reviewCountContainer);
};

document.addEventListener("DOMContentLoaded", initializeGetReview);
