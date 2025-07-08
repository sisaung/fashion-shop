const destroyProductImage = async (productImageId, csrfToken) => {
    try {
        const res = await fetch(
            `/dashboard/product/manage-image/${productImageId}`,
            {
                method: "DELETE",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": csrfToken,
                },
            }
        );
        // if (!res.ok) {
        //     console.log(res)
        // }
        console.log(res);
        const data = await res.json();
        return data;
    } catch (e) {
        console.log(e);
    }
};
export default destroyProductImage;
