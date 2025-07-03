const initializeFit = () => {
    const productTypeSelect = document.querySelector("#product_type");
    const fitGroup = document.querySelector("#fit-group");
    const fitSelect = document.querySelector("#fit");

    productTypeSelect.addEventListener("change", async (e) => {
        const productTypeId = e.target.value;
        fitSelect.innerHTML = `<option selected value=''>Choose fit</option>`;

        // fitSelect.innerHTML = "<option selected value=''>Choose fit</option>";

        try {
            const res = await fetch(`/dashboard/get-fits/${productTypeId}`);
            const data = await res.json();

            if (data.length === 0) {
                fitGroup.classList.add("hidden");
            } else {
                fitGroup.classList.remove("hidden");
                fitGroup.classList.add("block");
            }

            console.log(data)
            data.forEach((fit) => {
                const option = document.createElement("option");
                option.value = fit.id;
                option.textContent = fit.fit_name;
                fitSelect.appendChild(option);
            });
        } catch (e) {
            console.log(e);
        }
    });
};

document.addEventListener("DOMContentLoaded", initializeFit);
