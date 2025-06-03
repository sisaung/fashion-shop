import urlString from "./utils/urlString";

   
const handleSorting = () => {
    // Delegate to the container to handle all sort clicks
    const headerSortBy = document.querySelectorAll("th[data-sortby]");

    headerSortBy.forEach((header) => {
        const sortBy = header.dataset.sortby;
        const ascBtn = header.querySelector('[data-sort-direction="asc"]');
        const descBtn = header.querySelector('[data-sort-direction="desc"]');

        if (ascBtn) {
            ascBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                const url = urlString(sortBy, "asc");
            //    ascBtn.href = url;
                
                window.location.href = url;
            });
        }

        if (descBtn) {
            descBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                const url = urlString(sortBy,"desc")
                window.location.href = url;
                // descBtn.href = url;
            });
        }
    });

  
};

document.addEventListener("DOMContentLoaded", handleSorting);
