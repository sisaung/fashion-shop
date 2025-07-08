import renderProductImage from "./renderProductImage";

const renderProductImageList = async (data, container) => {
    container.innerHTML = "";
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    if (data?.product_images.length > 0) {
        data?.product_images.forEach(async (image) => {
            const productImage = await renderProductImage(data.id,image, csrfToken);
            container.appendChild(productImage);
        });
    }
};

export default renderProductImageList;
