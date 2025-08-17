import destroyProductImage from "../services/destroyProductImage";
import productImageList from "./productImageList";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

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
       Toastify({
                           text: "Image deleted successfully",
                           duration: 2000,
                           close: true,
                           gravity: "top",
                           position: "center",
                           style: {
                               background: "#ecfdf3",
                               fontSize: "14px",
                               color: "#008a2e",
                               display: "flex",
                               alignItems: "center",
                               gap: "5px",
                           },
                           avatar: "/icons/check.png",
                       }).showToast();
    }

    productImageBtn.addEventListener('click',handleProductImage)
    return content;
};

export default renderProductImage;
