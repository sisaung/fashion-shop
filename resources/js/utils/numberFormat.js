const numberFormat = (number) => {
    return number % 1 === 0
        ? number.toLocaleString("en-US")
        : number.toLocaleString("en-US", {
              minimumFractionDigits: 2,
              maximumFractionDigits: 2,
          });
};

export default numberFormat
