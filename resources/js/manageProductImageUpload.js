const initializeManageProductImageUpload = () => {
    const currentUrl = location.search;
    const manageImgeUpload = document.querySelector(".manage-image-upload");

    const file = document.querySelector(".file");
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    if (!manageImgeUpload) return;

    const handleClick = (e) => {
        e.preventDefault();

        const id = e.target.dataset.productId;
        const action = e.target.dataset.manageImageUrl;

        const handleFileChange = async (e) => {
            const files = e.target.files;
            console.log(files)

            if (!files) return;

            const formData = new FormData();

            for (let file of files) {
                formData.append("images[]", file);
            }

            try {
                const res = await fetch(
                    `/dashboard/product/${id}/edit/manage-image`,
                    {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                            'Accept': 'application/json'
                        },
                        body: formData,
                        credentials:"same-origin"
                    }
                );

                if (res.ok) {
                  location.reload();

                }


            } catch (e) {
                console.log(e);
            }
        };
        file.addEventListener("change", handleFileChange);

        file.click();

        //   const manageProductImageUrl = e.target.closest('[data-manage-image]')

        //   if(manageProductImageUrl) {

        //       const action = manageProductImageUrl.dataset.manageImage;
        //     location.href = `${action}${currentUrl}`

        //   }
    };

    manageImgeUpload.addEventListener("click", handleClick);
};

document.addEventListener(
    "DOMContentLoaded",
    initializeManageProductImageUpload
);
