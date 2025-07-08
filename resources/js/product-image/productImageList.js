import { fetchProductImages } from "../services/fetchProductImage";
import renderProductImageList from "./renderProductImageList";

const productImageList = async (productId, container) => {
    const data = await fetchProductImages(
        `/dashboard/product/${productId}/edit/get-product-image`
    );

    if (data?.product_images) {
        await renderProductImageList(data, container);
    }
};
export default productImageList
