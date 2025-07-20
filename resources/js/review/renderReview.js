const renderReview = async (review) => {
    const template = document.getElementById("review-template");

    if (!template) return;
    const content = template.content.cloneNode(true);
    const img = content.querySelector(".profile-image");
    const name = content.querySelector(".user-name");
    const reviewDescription = content.querySelector(".review-description");
    const rating = content.querySelectorAll(".rating");
    const isVerified = content.querySelector(".verified-badge");
    const verifiedBadge = content.querySelector(".verified-badge-check");

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

    if (review.is_verified == 1) {
        isVerified.textContent = "Verified Purchase";
        verifiedBadge.innerHTML = ` <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
    viewBox="0 0 24 24" fill="none" stroke="currentColor"
    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
    class="lucide size-5 lucide-badge-check-icon lucide-badge-check fill-green-500 stroke-white">
    <path
        d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z" />
    <path d="m9 12 2 2 4-4" />
</svg>`;
    }

    return content;
};

export default renderReview;
