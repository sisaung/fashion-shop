const initializeOrderCurrentParam = () => {
    const orderDetails = document.querySelectorAll(".order-detail");
    const sortBy = document.querySelector(".sort-by");
    const sortDirection = document.querySelector(".sort-direction");
    const limit = document.querySelector(".limit");
    const page = document.querySelector(".page");

    const currentUrl = location.search;

    const searchParam = new URLSearchParams(currentUrl);

    const paramObj = Object.fromEntries(searchParam);

   

    const forms = document.querySelectorAll("form[id^='mark-as-paid-']");
    forms.forEach((form) => {
        const sortBy = form.querySelector(".sort-by");
        const sortDirection = form.querySelector(".sort-direction");
        const limit = form.querySelector(".limit");
        const page = form.querySelector(".page");

        if (sortBy) sortBy.value = paramObj.sort_by || "";
        if (sortDirection) sortDirection.value = paramObj.sort_direction || "";
        if (limit) limit.value = paramObj.limit || "";
        if (page) page.value = paramObj.page || "";
    });

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
