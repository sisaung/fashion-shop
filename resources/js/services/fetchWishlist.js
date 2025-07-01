const fetchWishlist = async (url) => {
    try {
        const res = await fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        if (res.status == 401) {
            const data = await res.json();
            return data;
        }
        const data = await res.json();
        return data;
    } catch (e) {
        console.error("Error fetching wishlist:", e);
    }
};
export default fetchWishlist;
