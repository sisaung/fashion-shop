import ajax from "./utils/ajax";
import urlString from "./utils/urlString";



const initializeSorting = () => {
    const container = document.getElementById("brand-list-container");

    if (!container) return;
    container.addEventListener("click", (e) => {
        e.preventDefault();
        // e.stopPropagation();
        const sortBy = e.target.closest("th[data-sortby]");
        const sortDirection = e.target.closest("[data-sort-direction]");

        if (sortBy && sortDirection) {
            const url = urlString(
                sortBy.dataset.sortby,
                sortDirection.dataset.sortDirection
            );
            ajax(url, "#brand-list-container", container);
        }
    });
};

document.addEventListener("DOMContentLoaded", initializeSorting);
export default initializeSorting;
