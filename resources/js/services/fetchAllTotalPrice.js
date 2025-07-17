const fetchAllTotalPrice = async (filterStockBy) => {
    console.log(filterStockBy)
    try {
        const res = await fetch(`/dashboard/stock-analysis/calculatePrice${filterStockBy? `?${filterStockBy}` : ''}`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        if (!res.ok) throw new Error("Fetch error");
        const data = await res.json();
        return data;
    } catch (e) {
        console.error("Error fetching products:", e);
    }
}
export default fetchAllTotalPrice
