const renderReview = async (review) => {
    const template = document.getElementById("review-template");

    if (!template) return;
    const content = template.content.cloneNode(true);
    const img = content.querySelector(".profile-image");
    const name = content.querySelector(".user-name");
    const reviewDescription = content.querySelector(".review-description");
    const rating = content.querySelectorAll(".rating");
    const isVerified = content.querySelector(".verified-badge");

    rating.forEach((count) => {
        const countStar = count.dataset.countStar;
        count.classList.add(
            countStar <= review.rating ? "fill-yellow-400" : "fill-gray-300"
        );
    });

    img.src = review.user.profile_image
        ? review.user.profile_image
        : "https://i0.wp.com/digitalhealthskills.com/wp-content/uploads/2022/11/3da39-no-user-image-icon-27.png?fit=500%2C500&ssl=1≈";
    name.textContent = review.user.name;
    reviewDescription.textContent = review.review;

    reviewDescription.setAttribute("data-review-created-at", review.created_at);

    console.log(review);
    if (review.is_verified == 1) {
        isVerified.textContent = "Verified Purchase";
    }

    return content;
};

export default renderReview;
