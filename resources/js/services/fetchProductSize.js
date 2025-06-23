export const fetchProductSize = async (url) => {
    try {
        const res = await fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        if (!res.ok) throw new Error("Fetch error");
        const data = await res.json();
        return data;
    } catch (e) {
        console.error("Error fetching product size:", e);
    }
};
