const initializeOrderCurrentParam = () => {
    const orderDetails = document.querySelectorAll(".order-detail");
    const sortBy = document.querySelector(".sort-by");
    const sortDirection = document.querySelector(".sort-direction");
    const limit = document.querySelector(".limit");
    const page = document.querySelector(".page");

    const currentUrl = location.search;


    const searchParam = new URLSearchParams(currentUrl);

    const paramObj = Object.fromEntries(searchParam);

    sortBy.value = paramObj.sort_by;
    sortDirection.value = paramObj.sort_direction;
    limit.value = paramObj.limit;
    page.value = paramObj.page;

    console.log(page.value)

    orderDetails.forEach((order) => {
        const handleOrderDetail = () => {
            location.href = order.dataset.orderDetailUrl;
        };

        order.addEventListener("click", handleOrderDetail);
    });

    const handleClick = (e) => {
        e.preventDefault();
        // e.stopPropagation();

        const editUrl = e.target.closest("[data-order-detail-url]");

        if (editUrl) {
            const action = editUrl.dataset.editUrl;

            location.href = `${action}${currentUrl}`;
        }
    };
};

document.addEventListener("DOMContentLoaded", initializeOrderCurrentParam);
