import urlString from "./utils/urlString";



const initializeSorting = () => {
    const wrapper = document.querySelector(".sorting-wrapper");

    if (!wrapper) return;
    wrapper.addEventListener("click", (e) => {
        e.stopPropagation();
        const sortBy = e.target.closest("th[data-sortby]");
        const sortDirection = e.target.closest("[data-sort-direction]");

       

        if (sortBy && sortDirection) {
            const url = urlString(
                sortBy.dataset.sortby,
                sortDirection.dataset.sortDirection
            );
            // ajax(url, "#brand-list-container", container);
           
           window.location.href = url
            

        }
    });
};

document.addEventListener("DOMContentLoaded", initializeSorting);
export default initializeSorting;
