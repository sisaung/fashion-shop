const initializeActiveTab = () => {
    const tabs = document.querySelectorAll(".tab");
    const tabContents = document.querySelectorAll(".tab-content");
    tabs.forEach((tab) => {
        tab.addEventListener("click", () => {
            tabs.forEach((tab) => {
                tab.classList.remove("active-tab");
            });

            tab.classList.add("active-tab");

        });
    });
}
document.addEventListener("DOMContentLoaded", initializeActiveTab);
