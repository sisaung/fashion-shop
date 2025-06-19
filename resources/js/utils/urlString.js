const urlString = (sortBy, sortDirection, ajax = false, q) => {
    const params = document.location.search;
    const urlSearchParams = new URLSearchParams(params);
    const currentParams = Object.fromEntries(urlSearchParams);

    const newParams = {
        ...currentParams,
        sort_by: sortBy,
        sort_direction: sortDirection,
    };

    const queryString = new URLSearchParams(newParams).toString();

    if (ajax) {
        return `?${queryString}`;
    }
    // console.log( location.origin + location.pathname + "?" + queryString);

    return location.origin + location.pathname + "?" + queryString;
};

export default urlString;
