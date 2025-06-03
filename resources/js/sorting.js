const handleSorting = () => {
    const sortedElement = document.querySelectorAll("[data-sortby]");


    // console.dir(sortedElement);

    document.addEventListener("click", (e) => {

        const sortDirectionBtn = e.target.closest("[data-sort-direction]");
        if (!sortDirectionBtn) return;
        e.preventDefault();
        const sortDir = sortDirectionBtn.closest(".sort-dir");
        const sortContainer = sortDir.closest("[data-sortby]");
        console.dir(sortContainer);

        // const sortDirection = sortDirectionBtn.dataset.sortDirection;
        // console.log(sortDirection);

        const params = document.location.search;
        const urlSearchParams = new URLSearchParams(params);
        const currentParams = Object.fromEntries(urlSearchParams);

        // const newParamsAsc = {
        //     ...currentParams,
        //     sort_by: el.dataset.sortby,
        //     sort_direction: "asc",
        // };

        // const newParamsDesc = {
        //     ...currentParams,
        //     sort_by: el.dataset.sortby,
        //     sort_direction: "desc",
        // };
        // const newQueryStringAsc = new URLSearchParams(newParamsAsc).toString();
        // const newQueryStringDesc = new URLSearchParams(
        //     newParamsDesc
        // ).toString();
    });



    // sortedElement.forEach((el) => {
    //     console.dir(el.dataset.sortby);

    //     const asc = document.querySelector('[data-sort-direction="asc"]');
    //     const desc = document.querySelector('[data-sort-direction="desc"]');

    //     const params = document.location.search;
    //     const urlSearchParams = new URLSearchParams(params);
    //     const currentParams = Object.fromEntries(urlSearchParams);

    //     const newParamsAsc = {
    //         ...currentParams,
    //         sort_by: el.dataset.sortby,
    //         sort_direction: "asc",
    //     };

    //     const newParamsDesc = {
    //         ...currentParams,
    //         sort_by: el.dataset.sortby,
    //         sort_direction: "desc",
    //     };
    //     const newQueryStringAsc = new URLSearchParams(newParamsAsc).toString();
    //     const newQueryStringDesc = new URLSearchParams(
    //         newParamsDesc
    //     ).toString();

    //     asc.addEventListener("click", () => {
    //         asc.href =
    //             location.origin + location.pathname + "?" + newQueryStringAsc;
    //     });

    //     desc.addEventListener("click", () => {
    //         desc.href =
    //             location.origin + location.pathname + "?" + newQueryStringDesc;
    //     });
    // });
};

export default handleSorting;
document.addEventListener("DOMContentLoaded", handleSorting);
