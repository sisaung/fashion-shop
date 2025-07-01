const fetchWishlist = async (url) => {
    try {
        const response = await fetch(url);

        if (response.status === 401) {
            return { message: "Unauthenticated.", wishlist: null };
        }

        const contentType = response.headers.get("content-type");
        if (
            response.ok &&
            contentType &&
            contentType.includes("application/json")
        ) {
            const data = await response.json();
            return data;
        } else {
            // If not JSON, return error message
            // console.warn("Response is not JSON. Status:", response.status);
            return { message: "Invalid response.", wishlist: null };
        }
    } catch (error) {
        console.error("Error fetching wishlist:", error);
        return { message: "Error", wishlist: null };
    }
};
export default fetchWishlist;
