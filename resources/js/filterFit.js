const initializeFit = () => {
    const productTypeSelect = document.querySelector("#product_type");

    productTypeSelect.addEventListener("change", async (e) => {
        const productTypeId = e.target.value;

        productTypeId.innerHTML =
            "<option selected>Choose product type</option>";

        try {
            const res = await fetch(`/dashboard/get-fits/${productTypeId}`);
            const data = await res.json();

            data.forEach((fit) => {
                const option = document.createElement("option");
                option.value = fit.id;
                option.textContent = fit.name;
                productTypeId.appendChild(option);
            });
        } catch (e) {
            console.log(e);
        }
    });
};

document.addEventListener("DOMContentLoaded", initializeFit);
