const initializeCalculateProfit = () => {
    const originalPriceSelector = document.querySelector("#original-price");
    const salePriceSelector = document.querySelector("#sale-price");
    const displayPriceSelector = document.querySelector("#display-price");
    const discountValueSelector = document.querySelector("#discount-value");
    const discounTypeSelector = document.querySelector("#discount-type");

    const profitSelector = document.querySelector(".profit");

    let originalPrice = 0;
    let salePrice = 0;
    let discountType = "";
    let discountValue = 0;

    const calculateProfit = () => {

        if (
            discountValue > 0 &&
            salePrice > 0 &&
            originalPrice > 0 &&
            discountType == "percentage"
        ) {
            const discountPrice = (discountValue / 100) * salePrice;
            const displayPrice = salePrice - discountPrice;


            const profit = displayPrice - originalPrice;
            displayPriceSelector.value = displayPrice;
            profitSelector.textContent = `Profit ( ${profit} ) `;
            return;
        } else if (
            discountValue > 0 &&
            salePrice > 0 &&
            originalPrice > 0 &&
            discountType == "fixed"
        ) {
            const discountPrice = discountValue;
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

    if (
        originalPriceSelector.value ||
        salePriceSelector.value ||
        discountValueSelector.value
    ) {
        originalPrice = Number(originalPriceSelector.value);
        salePrice = Number(salePriceSelector.value);
        discountType = discounTypeSelector.value;
        discountValue = Number(discountValueSelector.value);
        calculateProfit();
    }

    if (discountValueSelector.value) {
        discountValue = Number(discountValueSelector.value);
        calculateProfit();
    }

    const handleDiscountTypeChange = (e) => {
        if (discountType) {
            calculateProfit();
        }
        discountType = e.target.value;
    };

    const handleOriginalPriceChange = (e) => {
        if (e.target.value) {
            originalPrice = e.target.value;

            if (salePriceSelector.value) {
                // salePrice = salePriceSelector.value;
                calculateProfit();
            }
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

    const handleDiscountValueChange = (e) => {
        if (e.target.value && discountType) {
            discountValue = e.target.value;
            calculateProfit();
        } else {
            discountValue = 0;
            calculateProfit();
        }
    };

    originalPriceSelector.addEventListener("change", handleOriginalPriceChange);
    salePriceSelector.addEventListener("change", handleSalePriceChange);
    discounTypeSelector.addEventListener("change", handleDiscountTypeChange);
    discountValueSelector.addEventListener("change", handleDiscountValueChange);
};

document.addEventListener("DOMContentLoaded", initializeCalculateProfit);
