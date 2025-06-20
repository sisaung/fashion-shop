export const fetchBrand = async (url) => {
    try {
        const res = await fetch(url);
        if (!res.ok) throw new Error("Fetch error");
        const data = await res.json();
        return data;
    } catch (e) {
        console.error("Error fetching products:", e);
    }
};
