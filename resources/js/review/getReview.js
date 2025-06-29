import fetchReview from "../services/fetchReview";
import renderReviewList from "./renderReviewList";

const initializeGetReview = async () => {
    const productId = document.querySelector(".product-id");
    const id = productId.dataset.productId;
    const container = document.querySelector(".review-container");
    const reviewCountContainer = document.querySelector(
        ".review-count-container"
    );
    const filterBtn = document.querySelectorAll(".filter-btn");

    filterBtn[0].classList.add('active-filter');

    filterBtn.forEach(btn => {
        btn.addEventListener('click', async () => {

            filterBtn.forEach(btn => btn.classList.remove('active-filter'));
            btn.classList.add('active-filter');
            const ratingCount = btn.dataset.count

            const data = await fetchReview(`/get-review/${id}?filter-rating=${ratingCount}`);
            
            renderReviewList(data?.data, container, reviewCountContainer);

        })
    })

    const data = await fetchReview(`/get-review/${id}`);
    renderReviewList(data?.data, container, reviewCountContainer);
};

document.addEventListener("DOMContentLoaded", initializeGetReview);
