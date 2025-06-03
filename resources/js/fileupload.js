const initializeFileUpload = () => {
    const file = document.querySelector(".file");
    const upload = document.querySelector(".upload");

    file.addEventListener("change", (e) => {
        const fileList = e.target.files[0];

        const button = document.createElement("button");
        button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 stroke-2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
        `;
        button.classList.add("remove-image-btn");
        upload.parentNode.appendChild(button);
        const img = document.createElement("img");

        img.classList.add("uploaded-image");
        const fileReader = new FileReader();
        fileReader.onload = () => {
            img.src = fileReader.result;
        };

        if (fileList) {
            fileReader.readAsDataURL(fileList);
        } else {

           console.log('cancelled')
        }
        upload.replaceChild(img, upload.firstElementChild);

    });

    const handleFileUpload = () => {
        console.log(upload.firstElementChild);
        file.click();
    };

    upload.addEventListener("click", handleFileUpload);
};

document.addEventListener("DOMContentLoaded", initializeFileUpload);

// const initializeFileUpload = () => {
//     const fileInput = document.querySelector(".file");
//     const upload = document.querySelector(".upload");

//     let files = [];
//     const handleFileUpload = async () => {
//         const [fileHandle] = await window.showOpenFilePicker({
//             multiple: false,
//         });
//         const fileData = await fileHandle.getFile();
//         files.push(fileData);
//         const fileReader = new FileReader();
//         fileReader.onload = () => {
//             const img = document.createElement("img");
//             img.classList.add("uploaded-image");
//             img.src = fileReader.result;
//             upload.replaceChild(img, upload.firstElementChild);
//         };

//         if (files.length <= 0) {
//             console.log("error");
//             return;
//         }

//         fileInput.value = files[files.length - 1];

//         fileReader.readAsDataURL(fileData);
//     };

//     upload.addEventListener("click", handleFileUpload);
// };

// document.addEventListener("DOMContentLoaded", initializeFileUpload);
