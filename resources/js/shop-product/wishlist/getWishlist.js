import fetchWishlist from "../../services/fetchWishlist";

const getWishlist = async () => {
    const data = await fetchWishlist("/get-wishlist");

    if (data.message === "Unauthenticated.") {
        return null; // user not logged in
    }

    if (!data.wishlist) {
        return null;
    }
    return data.wishlist.products;
};
export default getWishlist;
