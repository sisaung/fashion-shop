const initializeCancelOrder = () => {
    const toggleCancellationOrderForm = document.querySelector(
        ".toggle-cancellation-order-form"
    );
    const cancelOrderForm = document.querySelector(".cancel-order-form");
    const reasonTags = document.querySelectorAll(".cancel-reason-tag");
    const reasonInput = document.querySelector(".reason-input");

    if (!cancelOrderForm) return;
    
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

    // const handleReasonInputChange = (e) => {

    //     if(e.target.value) {
    //         reasonInput.value = e.target.value
    //     }
    // }

    toggleCancellationOrderForm.addEventListener("change", handleChange);
    // reasonInput.addEventListener('change',handleReasonInputChange)
};

document.addEventListener("DOMContentLoaded", initializeCancelOrder);
