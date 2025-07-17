const fetchStockByProductType = async () => {
    try {
        const res = await fetch(
            `/dashboard/stock-analysis/stockByProductType`,
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
export default fetchStockByProductType;
