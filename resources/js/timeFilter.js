const initializeTimeFilter = () => {
    const timeFilter = document.getElementById("time-filter");

    const { search } = location;

    const param = new URLSearchParams(search);
    const filter = param.get("time_filter") ?? "this_year";

    if (filter) {
        timeFilter.value = filter;
    }

    if (timeFilter) {
        timeFilter.addEventListener("change", (e) => {
            window.location.href = `?time_filter=${e.target.value}`;
            timeFilter.value = e.target.value;
            console.log(window.location);
        });
    }
};

document.addEventListener("DOMContentLoaded", initializeTimeFilter);
