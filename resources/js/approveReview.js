const initializeApproveReview = () => {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    document.querySelectorAll(".toggle-is-show").forEach((toggle) => {
        toggle.addEventListener("change", async function () {
            const reviewId = this.dataset.id;
            const isShow = this.checked ? 1 : 0;

            try {
                await fetch(`/dashboard/review/${reviewId}/show`, {
                    method: "PATCH",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({ is_show: isShow }),
                });
            } catch (error) {
                console.log(error);
            }
        });
    });
};

document.addEventListener("DOMContentLoaded", initializeApproveReview);
