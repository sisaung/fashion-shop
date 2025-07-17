import numberFormat from "./numberFormat";

const showAllTotalPrice = (data) => {
    const totalSalePrice = document.querySelector(".total-sale-price");
    const totalOriginalPrice = document.querySelector(".total-original-price");
    const totalProfit = document.querySelector(".total-profit");

    totalSalePrice.textContent = numberFormat(data.totalSalePrice);
    totalOriginalPrice.textContent = numberFormat(data.totalOriginalPrice);
    totalProfit.textContent = numberFormat(data.totalProfit);
};

export default showAllTotalPrice;
