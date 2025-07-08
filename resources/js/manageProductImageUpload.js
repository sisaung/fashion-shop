import productImageList from "./product-image/productImageList";
import renderProductImageList from "./product-image/renderProductImageList";
import renderProductImageSkeleton from "./product-image/renderProductImageSkeletor";
import destroyProductImage from "./services/destroyProductImage";
import { fetchProductImages } from "./services/fetchProductImage";

const initializeManageProductImageUpload = async () => {
    const currentUrl = location.search;
    const manageImgeUpload = document.querySelector(".manage-image-upload");
    const productIdSelector = document.querySelector(".get-product-id");
    const productImageContainer = document.getElementById(
        "product-image-container"
    );
    const file = document.querySelector(".file");
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    const productId = productIdSelector.dataset.getProductId;

    // initial render
    renderProductImageSkeleton(productImageContainer);
    await productImageList(productId, productImageContainer);

    if (!manageImgeUpload) return;
    let currentProductId = null;

    const handleClick = (e) => {
        e.preventDefault();

        currentProductId = e.target.dataset.productId;

        file.click();
    };

    const handleFileChange = async (e) => {
        const files = e.target.files;

        if (!files || !currentProductId) return;
        renderProductImageSkeleton(productImageContainer);

        const formData = new FormData();

        for (let file of files) {
            formData.append("images[]", file);
        }

        try {
            const res = await fetch(
                `/dashboard/product/${currentProductId}/edit/manage-image`,
                {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: formData,
                    credentials: "same-origin",
                }
            );

            if (res.ok) {

                await productImageList(currentProductId, productImageContainer);
            }
        } catch (e) {
            console.log(e);
        }
    };
    file.addEventListener("change", handleFileChange);

    manageImgeUpload.addEventListener("click", handleClick);
};

document.addEventListener(
    "DOMContentLoaded",
    initializeManageProductImageUpload
);
