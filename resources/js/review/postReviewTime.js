const postReviewTime = () => {
    const reviews = document.querySelectorAll(".review-description");
    // const reviewTime = document.querySelectorAll(".review-time");

    reviews.forEach((review) => {
        const createdAt = review.getAttribute("data-review-created-at");
        const createdDate = new Date(createdAt);
        const now = new Date();

        const diffMs = now - createdDate;
        console.log(diffMs);
        const diffSecs = Math.floor(diffMs / 1000);
        console.log(diffSecs);
        const diffMins = Math.floor(diffMs / (1000 * 60));
        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));

        let display = "";

        if (diffSecs < 60) {
            display = "Just now";
        } else if (diffMins < 60) {
            display = diffMins + (diffMins === 1 ? " min ago" : " mins ago");
        } else if (diffHours < 24) {
            display = diffHours + (diffHours === 1 ? " hr ago" : " hrs ago");
        } else {
            // Show formatted date e.g. July 17, 2024
            const options = { year: "numeric", month: "short", day: "numeric" };
            display = createdDate.toLocaleDateString("en-US", options);
        }

        // if (reviewTime) {
        //     reviewTime.forEach((time) => {
        //         time.textContent = display;
        //     });
        // }

        const reviewCard = review.closest(".border"); // your main card div
        if (reviewCard) {
            const timeEl = reviewCard.querySelector(".review-time");
            if (timeEl) {
                timeEl.textContent = display;
            }
        }
    });
};
export default postReviewTime;
