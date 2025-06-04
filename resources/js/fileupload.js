const initializeFileUpload = () => {
    const file = document.querySelector(".file");
    const upload = document.querySelector(".upload");

    const renderIcon = () => {
        file.value = "";
        upload.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-14 stroke-stone-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>`;
    };

    // renderIcon();

    file.addEventListener("change", (e) => {
        const fileList = e.target.files[0];

        if (!fileList) {
            renderIcon();
            return;
        }

        const img = document.createElement("img");
        img.classList.add("uploaded-image");
        const fileReader = new FileReader();
        fileReader.onload = () => {
            img.src = fileReader.result;
        };

        fileReader.readAsDataURL(fileList);

        upload.innerHTML = "";
        upload.appendChild(img);
        const button = document.createElement("button");
        button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 stroke-2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
        `;
        button.classList.add("remove-image-btn");
        upload.appendChild(button);
        button.addEventListener("click", (e) => {
            e.stopPropagation();
            renderIcon();
        })
    });

    const handleFileUpload = () => {
        file.click();
    };

    upload.addEventListener("click", handleFileUpload);
};

document.addEventListener("DOMContentLoaded", initializeFileUpload);

