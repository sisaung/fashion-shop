const initalizeDeliveryInformation = () => {
    const selectAddress = document.querySelectorAll('.select-address');

    selectAddress.forEach((address) => {
        const selectCheckIcon = address.querySelector('.select-check-icon');

        address.addEventListener("click", () => {

            // Remove 'active-address' and hide check icon from all addresses
            selectAddress.forEach(addr => {
                addr.classList.remove("active-address");
                const icon = addr.querySelector('.select-check-icon');
                if (icon) {
                    icon.classList.add('hidden');
                }
            });

            // Add 'active-address' to clicked address
            address.classList.add("active-address");

            // Show check icon of clicked address
            if (selectCheckIcon) {
                selectCheckIcon.classList.remove('hidden');
            }
        });
    });

};

document.addEventListener("DOMContentLoaded", initalizeDeliveryInformation);
