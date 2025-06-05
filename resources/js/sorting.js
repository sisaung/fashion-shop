import ajax from "./utils/ajax";
import urlString from "./utils/urlString";

export const initializeSorting = () => {
    // Delegate to the container to handle all sort clicks
    const wrapper = document.querySelector(".sorting-wrapper");

    const handleSorting = (e) => {
        e.preventDefault();
        e.stopPropagation();

        const sortBy = e.target.closest("th[data-sortby]");
        const sortDirection = e.target.closest("[data-sort-direction]");

        const url = urlString(
            sortBy.dataset.sortby,
            sortDirection.dataset.sortDirection
        );

        ajax(url, ".sorting-wrapper", wrapper);
    };

    wrapper.addEventListener("click", handleSorting);

    // headerSortBy.forEach((header) => {
    //     const sortBy = header.dataset.sortby;
    //     const ascBtn = header.querySelector('[data-sort-direction="asc"]');
    //     const descBtn = header.querySelector('[data-sort-direction="desc"]');

    //     if (ascBtn) {
    //         ascBtn.addEventListener("click", (e) => {
    //             e.preventDefault();
    //             e.stopPropagation();
    //             const url = urlString(sortBy, "asc");
    //         //    ascBtn.href = url;

    //             ajax(url, ".sorting-wrapper", wrapper);

    //             // window.location.href = url;

    //         });
    //     }

    //     if (descBtn) {
    //         descBtn.addEventListener("click", (e) => {
    //             console.log(descBtn)
    //             e.preventDefault();
    //             e.stopPropagation();
    //             const url = urlString(sortBy,"desc")
    //             ajax(url, ".sorting-wrapper", wrapper);
    //             // window.location.href = url;
    //             // descBtn.href = url;
    //         });
    //     }
    // });
};

document.addEventListener("DOMContentLoaded", initializeSorting);
