const initializeCancelOrder = () => {
    const toggleCancellationOrderForm = document.querySelector(
        ".toggle-cancellation-order-form"
    );
    const cancelOrderForm = document.querySelector(".cancel-order-form");
    const reasonTags = document.querySelectorAll(".cancel-reason-tag");
    const reasonInput = document.querySelector(".reason-input");

    cancelOrderForm.classList.add("hidden");
    if (!toggleCancellationOrderForm) return;

    const handleChange = (e) => {
        if (e.target.checked) {
            cancelOrderForm.classList.remove("hidden");
            cancelOrderForm.classList.add("add");
        } else {
            cancelOrderForm.classList.remove("grid");
            cancelOrderForm.classList.add("hidden");
        }
    };

    if (!reasonTags) return;

    reasonTags.forEach((tag) => {
        tag.addEventListener("click", (e) => {
            reasonTags.forEach((t) => t.classList.remove("selected-cancel"));

            e.target.classList.add("selected-cancel");
            reasonInput.value = e.target.dataset.reason;
        });
    });

    toggleCancellationOrderForm.addEventListener("change", handleChange);
};

document.addEventListener("DOMContentLoaded", initializeCancelOrder);
