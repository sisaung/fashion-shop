const fetchStockSizeChart = async (stockBy) => {
    try {
        const res = await fetch(
            `/dashboard/stock-analysis/stockBySize${
                stockBy ? `?${stockBy}` : ""
            }`,
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
        console.error("Error fetching stock size chart:", e);
    }
};
export default fetchStockSizeChart;
