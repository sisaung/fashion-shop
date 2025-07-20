import flatpickr from "flatpickr";
const initializeSelectDate = () => {
    flatpickr("#start_date", {
        minDate: "today",
    });
    flatpickr("#end_date", {
        minDate: "today",
    });

    flatpickr("#coupon_start_date", {

        dateFormat: "Y-m-d",
    });

    flatpickr("#coupon_expire_date", {

        dateFormat: "Y-m-d",
    });
};

document.addEventListener("DOMContentLoaded", initializeSelectDate);
