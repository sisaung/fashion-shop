const fetchLatestStyle = async () => {
    try {
        const res = await fetch('/get-latest-style', {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        if (!res.ok) throw new Error("Fetch error");
        const data = await res.json();
        return data;
    } catch (e) {
        console.error("Error fetching latest style:", e);
    }
};
export default fetchLatestStyle;
