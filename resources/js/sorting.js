import urlString from "./utils/urlString";

const initializeSorting = () => {
    const wrapper = document.querySelector(".sorting-wrapper");
    const limit = document.querySelector(".limit");

    const params = new URLSearchParams(window.location.search);

    const rowLimit = params.get("limit");

    if (rowLimit) {
        limit.value = rowLimit;
    }

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
            // ajax(url, "#brand-list-container", container);

            window.location.href = url;
        }
    });

    const handleChangeLimit = (e) => {
        const currentParam = new URLSearchParams(window.location.search);

        const currentObj = Object.fromEntries(currentParam);
        const limit = {
            ...currentObj,
            limit: e.target.value,
            page: 1,
        };

        const params = new URLSearchParams(limit).toString();
        console.log(params);

        // urlSearchParam.set('limit', e.target.value);
        // urlSearchParam.set('page', 1);
        // window.location.search = urlSearchParam.toString();

        // const url = urlString(e.target.value);

        // window.location.href = url;
        window.location.href = `${window.location.origin}${window.location.pathname}?${params}`;
    };

    limit.addEventListener("change", handleChangeLimit);
};

document.addEventListener("DOMContentLoaded", initializeSorting);
export default initializeSorting;
