export const showSuccessToast = (message) => {
    const toast = document.getElementById("toast-success");
    const toastMsg = document.getElementById("toast-success-message");
    toastMsg.textContent = message;
    // Show with transition
    toast.classList.remove("hidden");
    setTimeout(() => {
        toast.classList.remove("opacity-0", "-translate-y-10");
        toast.classList.add("opacity-100", "translate-y-0");
    }, 10); // small delay to trigger transition

    // Hide after 3s with smooth transition
    setTimeout(() => {
        toast.classList.remove("opacity-100", "translate-y-0");
        toast.classList.add("opacity-0", "-translate-y-10");
    }, 3000);

    // Fully hide after transition ends
    setTimeout(() => {
        toast.classList.add("hidden");
    }, 3500);
};

export const showErrorToast = (message) => {
    const toast = document.getElementById("toast-error");
    const toastMsg = document.getElementById("toast-error-message");
    toastMsg.textContent = message;
    // Show with transition
    toast.classList.remove("hidden");
    setTimeout(() => {
        toast.classList.remove("opacity-0", "-translate-y-10");
        toast.classList.add("opacity-100", "translate-y-0");
    }, 10); // small delay to trigger transition

    // Hide after 3s with smooth transition
    setTimeout(() => {
        toast.classList.remove("opacity-100", "translate-y-0");
        toast.classList.add("opacity-0", "-translate-y-10");
    }, 3000);

    // Fully hide after transition ends
    setTimeout(() => {
        toast.classList.add("hidden");
    }, 3500);
};
