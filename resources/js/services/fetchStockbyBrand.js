const fetchStockByBrand = async (stockByBrand) => {

    const productType = stockByBrand ? `?${stockByBrand}` : "";

    try {
        const res = await fetch(
            `/dashboard/stock-analysis/stockByBrand${productType}`,
            {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                },
            }
        );
        if (!res.ok) throw new Error("Fetch error");
        const data = await res.json();
        return data;
    } catch (e) {
        console.error("Error fetching stock:", e);
    }
};
export default fetchStockByBrand;
