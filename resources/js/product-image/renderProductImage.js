import destroyProductImage from "../services/destroyProductImage";
import productImageList from "./productImageList";

const renderProductImage = (productId,productImage,csrfToken) => {
    const productImageTemplate = document.getElementById(
        "product-image-template"
    );
    if (!productImageTemplate) return;
    const content = productImageTemplate.content.cloneNode(true);
    const productImageContainer = document.getElementById(
        "product-image-container"
    );

    const productImageSelector = content.querySelector(".product-image");
    const productImageBtn = content.querySelector(
        ".product-image-delete-btn"
    );

    productImageSelector.src = productImage.preview;
    productImageBtn.setAttribute('data-product-image-id',productImage.id)

    const handleProductImage = async() => {
        console.log(productImage.id)
        await destroyProductImage(productImage.id,csrfToken)
       await productImageList(productId,productImageContainer)
    }

    productImageBtn.addEventListener('click',handleProductImage)
    return content;
};

export default renderProductImage;
