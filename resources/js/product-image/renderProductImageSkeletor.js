const renderProductImageSkeleton = (container, count = 8) => {
    container.innerHTML = ""; // clear container
    const skeletonTemplate = document.getElementById("product-image-skeleton").content;

    for (let i = 0; i < count; i++) {
        container.appendChild(skeletonTemplate.cloneNode(true));
    }
};
export default renderProductImageSkeleton
