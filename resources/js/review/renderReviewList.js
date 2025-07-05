import renderReview from "./renderReview";
const renderReviewList = async (reviews, container, reviewCountContainer) => {
    container.innerHTML = "";
    reviewCountContainer.innerHTML = "";

    const templateReviewCount = document.getElementById(
        "review-count-template"
    );
    const content = templateReviewCount.content.cloneNode(true);
    content.querySelector(
        ".review-count"
    ).textContent = `All Reviews ( ${reviews.length} ) `;
    reviewCountContainer.appendChild(content);

    if (!container) return;
    reviews.forEach(async (review) => {
        const content = await renderReview(review);
        container.appendChild(content);
    });
};

export default renderReviewList;
