const initializeCancelOrder = () => {
    const toggleCancellationOrderForm = document.querySelector(
        ".toggle-cancellation-order-form"
    );
    const cancelOrderForm = document.querySelector(".cancel-order-form");




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


    toggleCancellationOrderForm.addEventListener("change", handleChange);
};

document.addEventListener("DOMContentLoaded", initializeCancelOrder);
