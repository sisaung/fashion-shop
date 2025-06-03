   
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
                const url = updateSort(sortBy, "asc");
            //    ascBtn.href = url;
                
                window.location.href = url;
            });
        }

        if (descBtn) {
            descBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                const url = updateSort(sortBy,"desc")
                window.location.href = url;
                // descBtn.href = url;
            });
        }
    });

    const updateSort = (sortBy,sortDirection) => {
        
        const params = document.location.search;
        const urlSearchParams = new URLSearchParams(params);
        const currentParams = Object.fromEntries(urlSearchParams);
        const newParams = {
            ...currentParams,
            sort_by:sortBy,
            sort_direction:sortDirection
        }

        const queryString = new URLSearchParams(newParams).toString();
       
        return  location.origin + location.pathname + "?" + queryString
        

    }
};

document.addEventListener("DOMContentLoaded", handleSorting);
