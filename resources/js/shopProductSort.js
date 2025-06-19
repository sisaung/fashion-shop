import urlString from "./utils/urlString";

const initializeSort = () => {
    const sortBy = document.querySelector('.sort-product');

    const handleChange = (e) => {

        const sort = e.target.value;


        const [sortBy, sortDirection] = sort.split("&");
        const url = urlString(sortBy,sortDirection)

        location.href = url;




    }

    sortBy.addEventListener("change", handleChange)
};

document.addEventListener("DOMContentLoaded", initializeSort);
export default initializeSort;
