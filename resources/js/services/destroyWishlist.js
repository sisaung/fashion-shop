const destroyWishlist = async (url) => {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    try {
        const res = await fetch(url, {
            method: "DELETE",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": csrfToken,
            },
        });
        if (res.status == 401) {
            const data = await res.json();
            return data;
        }
        const data = await res.json();
        return data;
    } catch (e) {
        console.log(e);
    }
};
export default destroyWishlist;
