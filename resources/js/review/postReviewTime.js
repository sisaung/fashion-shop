const initializePostReviewTime = () => {
    const reviews = document.querySelectorAll(".review-description");
    console.log(reviews)

    reviews.forEach((review) => {
        const createdAt = review.getAttribute("data-review-created-at");
        console.log(createdAt)
        const createdDate = new Date(createdAt);
        const now = new Date();

        // Calculate difference in milliseconds
        const diffMs = now - createdDate;
        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));

        if (diffDays >= 1) {
            review.innerText =
                diffDays + (diffDays === 1 ? " day ago" : " days ago");
        } else {
            review.innerText = "Today";
        }
    });
};
document.addEventListener("DOMContentLoaded", initializePostReviewTime);
