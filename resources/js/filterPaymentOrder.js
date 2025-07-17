const initializeFilterPaymentOrder = () => {
    const filterPaymentBtn = document.querySelectorAll(".filter-payment-btn");
    const filterText = document.querySelector(".filter-payment");

    filterText.textContent = 'Filter Payment'

    const { search } = location;
    const param = new URLSearchParams(search);

    const filterPayment = param.get("filter");

    if (filterPayment) {
        filterText.textContent = filterPayment;
    }

    filterPaymentBtn.forEach((payment) => {
        const handlePayment = () => {
            const filterPayment = payment.dataset.payment;

            const search = location.search;
            const urlSearchParams = new URLSearchParams(search);
            const currentParams = Object.fromEntries(urlSearchParams);

            const newParams = {
                ...currentParams,
                filter: filterPayment,
            };

            const queryString = new URLSearchParams(newParams).toString();
            console.log(queryString)
            location.href = "?" + queryString;
            // location.href = `${location.origin}${location.pathname}?filter-payment=${filterPayment}`;
            // console.log(location);
        };

        payment.addEventListener("click", handlePayment);
    });
};

document.addEventListener("DOMContentLoaded", initializeFilterPaymentOrder);
