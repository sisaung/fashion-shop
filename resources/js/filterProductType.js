const initializeFilterProductType = () => {
    const productCategory = document.querySelector("#product_category");
    const productTypeSelect = document.querySelector("#product_type");

    productCategory.addEventListener("change", async (e) => {
        const productCategoryId = e.target.value;

        productTypeSelect.innerHTML =
            "<option selected>Choose product type</option>";

        try {
            const res = await fetch(`/dashboard/get-product-types/${productCategoryId}`);
            const data = await res.json();

            

            data.forEach((productType) => {
                const option = document.createElement("option");
                option.value = productType.id;
                option.textContent = productType.name;
                productTypeSelect.appendChild(option);
            });
        } catch (e) {
            console.log(e);
        }
    });
};

document.addEventListener("DOMContentLoaded", initializeFilterProductType);
