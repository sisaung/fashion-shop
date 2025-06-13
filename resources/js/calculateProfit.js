
const initializeCalculateProfit = () => {
    
    const originalPriceSelector = document.querySelector('#original-price');
    const salePriceSelector = document.querySelector('#sale-price');
    const displayPrice = document.querySelector('#display-price');
    const profitSelector =  document.querySelector('.profit');

    let originalPrice = 0;
    let salePrice = 0;

    const handleOriginalPriceChange = (e) => {
     
        originalPrice = e.target.value;
    }

    const handleSalePriceChange = (e) => {
        salePrice = e.target.value
        
    }


    displayPrice.textContent = salePrice
    const profit = salePrice - displayPrice;
    profitSelector.textContent = `Profie ( ${profit} ) `


    
    originalPriceSelector.addEventListener('change',handleOriginalPriceChange);
    salePriceSelector.addEventListener('change',handleSalePriceChange);



}

document.addEventListener('DOMContentLoaded',initializeCalculateProfit)