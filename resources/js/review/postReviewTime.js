const postReviewTime = () => {
    const reviews = document.querySelectorAll(".review-description");
    const reviewTime = document.querySelectorAll(".review-time");

    reviews.forEach((review) => {
        const createdAt = review.getAttribute("data-review-created-at");
        const createdDate = new Date(createdAt);
        const now = new Date();

        const diffMs = now - createdDate;
        const diffMins = Math.floor(diffMs / (1000 * 60));
        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));

        let display = "";

        if (diffMins < 60) {
            // less than 1 hour → show minutes
            display = diffMins + (diffMins === 1 ? " min ago" : " mins ago");
        } else if (diffHours < 24) {
            // less than 24 hours → show hours
            display = diffHours + (diffHours === 1 ? " hr ago" : " hrs ago");
        } else {
            // 1 day or more → show days
            display = diffDays + (diffDays === 1 ? " day ago" : " days ago");
        }

        if (diffDays >= 1) {
            reviewTime.forEach((time) => {
                time.textContent = display;
            });
        } else {
            reviewTime.forEach((time) => {
                time.textContent = display;
            });
        }

        // if (diffDays >= 1) {
        //     reviewTime.textContent =
        //         diffDays + (diffDays === 1 ? " day ago" : " days ago");
        // } else {
        //     reviewTime.textContent = "Today";
        // }
    });
};
export default postReviewTime;
