const fetchTotalStock = async () => {
    try {
        const res = await fetch("/dashboard/stock-analysis/totalStock", {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        if (!res.ok) throw new Error("Fetch error");
        const data = await res.json();
        return data;
    } catch (e) {
        console.error("Error fetching total stock:", e);
    }
};
export default fetchTotalStock;
