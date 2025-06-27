const initalizeDeliveryInformation = () => {
    const selectAddress = document.querySelectorAll(".select-address");


    selectAddress.forEach((address) => {

        address.addEventListener("click", () => {

            selectAddress.forEach(address => address.classList.remove("active-address"));
            address.classList.add("active-address");

        });
    });
};

document.addEventListener("DOMContentLoaded", initalizeDeliveryInformation);
