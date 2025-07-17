const initializeFilterProductList = () => {
    const filterCategoryBtn = document.querySelectorAll(".filter-category-btn");
    const categoryBtn = document.querySelector(".filter");


    categoryBtn.textContent = 'Category'

    const search = location.search;

    const params = new URLSearchParams(search);

    const category = params.get("category");

    if (category) {
        categoryBtn.textContent = category
    }

    // if()

    filterCategoryBtn.forEach((category) => {
        const handleFilterCategory = async() => {
            const categoryName = category.dataset.categoryName;


            const search = location.search;
            const urlSearchParams = new URLSearchParams(search);
            const currentParams = Object.fromEntries(urlSearchParams);

            const newParams = {
                ...currentParams,
                category: categoryName,
            };

            const queryString = new URLSearchParams(newParams).toString();
            location.href = "?" + queryString;



        };

        category.addEventListener("click", handleFilterCategory);
    });
};

document.addEventListener("DOMContentLoaded", initializeFilterProductList);
