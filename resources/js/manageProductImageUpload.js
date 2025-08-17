import productImageList from "./product-image/productImageList";
import renderProductImageSkeleton from "./product-image/renderProductImageSkeletor";
import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

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
        console.log(files);
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
                Toastify({
                    text: "Image uploaded successfully",
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
