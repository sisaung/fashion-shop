import ajax from "./utils/ajax";
import urlString from "./utils/urlString";

// export const initializeSorting = () => {
//     const wrapper = $(".sorting-wrapper");

//     if (!wrapper.length) return;

//     wrapper.on("click", "th[data-sortby], [data-sort-direction]", function (e) {
//         e.stopPropagation();
//         e.preventDefault();

//         // We get the closest th[data-sortby] and [data-sort-direction] relative to clicked element
//         const sortBy = $(e.target).closest("th[data-sortby]");
//         const sortDirection = $(e.target).closest("[data-sort-direction]");

//         if (sortBy.length && sortDirection.length) {
//             const url = urlString(
//                 sortBy.data("sortby"),
//                 sortDirection.data("sortDirection")
//             );

//             console.log("Sorting URL:", url);

//             ajax(url, ".sorting-wrapper", wrapper);
//         }
//     });
// };

// $(document).ready(initializeSorting);

const initializeSorting = () => {
    const wrapper = document.querySelector(".sorting-wrapper");

    if (!wrapper) return;
    wrapper.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        const sortBy = e.target.closest("th[data-sortby]");
        const sortDirection = e.target.closest("[data-sort-direction]");

        if (sortBy && sortDirection) {
            const url = urlString(
                sortBy.dataset.sortby,
                sortDirection.dataset.sortDirection
            );
            ajax(url, ".sorting-wrapper", wrapper);
        }
    });
};

document.addEventListener("DOMContentLoaded", initializeSorting);
export default initializeSorting;
