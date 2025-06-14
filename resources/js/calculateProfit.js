const initializeCalculateProfit = () => {
    const originalPriceSelector = document.querySelector("#original-price");
    const salePriceSelector = document.querySelector("#sale-price");
    const displayPriceSelector = document.querySelector("#display-price");
    const discountPercentageSelector = document.querySelector(
        "#discount-percentage"
    );

    const profitSelector = document.querySelector(".profit");

    let originalPrice = 0;
    let salePrice = 0;
    let discountPercentage = 0;

    const calculateProfit = () => {
        if (discountPercentage > 0 && salePrice > 0 && originalPrice > 0) {
            const discountPrice = (discountPercentage / 100) * salePrice;
            const displayPrice = salePrice - discountPrice;

            const profit = displayPrice - originalPrice;
            displayPriceSelector.value = displayPrice;
            profitSelector.textContent = `Profit ( ${profit} ) `;
            return;
        }

        const profit = salePrice - originalPrice;
        displayPriceSelector.value = salePrice;
        profitSelector.textContent = `Profit ( ${profit} ) `;
    };

    const handleOriginalPriceChange = (e) => {
        if (e.target.value) {
            originalPrice = e.target.value;
        } else {
            originalPrice = 0;
            calculateProfit();
            profitSelector.innerHTML = "";
        }
    };

    const handleSalePriceChange = (e) => {
        if (e.target.value) {
            salePrice = e.target.value;
            calculateProfit();
        } else {
            salePrice = 0;
            calculateProfit();
            profitSelector.innerHTML = "";
        }
    };

    const handleDiscountPriceChange = (e) => {
        if (e.target.value) {
            discountPercentage = e.target.value;
            calculateProfit();
        } else {
            discountPercentage = 0;
            calculateProfit();
            // displayPriceSelector.value = "";
            // profitSelector.innerHTML = "";
        }
    };

    originalPriceSelector.addEventListener("change", handleOriginalPriceChange);
    salePriceSelector.addEventListener("change", handleSalePriceChange);
    discountPercentageSelector.addEventListener(
        "change",
        handleDiscountPriceChange
    );
};

document.addEventListener("DOMContentLoaded", initializeCalculateProfit);
