const initializeTagActive = () => {
    const fitTag = document.querySelector(".fit-tags");
    const fitHidden = document.querySelector(".fit-hidden");
    const fitSelect = document.getElementById("fit-select");

    // let selectedIds = fitHidden.value
    //     ? fitHidden.value.split(",").map((id) => parseInt(id))
    //     : [];

    // if (selectedIds) {
    //     fitTag.querySelectorAll(".fit-tag").forEach((tag) => {
    //         tag.classList.remove("selected");
    //         if (selectedIds.includes(parseInt(tag.dataset.id))) {
    //             tag.classList.add("selected");
    //         }
    //     });
    // }

    // const updateHiddenInput = () => {
    //     fitHidden.value = selectedIds.join(",");
    // };

    // const handleFitTag = (e) => {
    //     const tag = e.target.closest(".fit-tag");

    //     if (!tag) return;
    //     const id = parseInt(tag.dataset.id);

    //     if (selectedIds.includes(id)) {
    //         selectedIds = selectedIds.filter((el) => el !== id);
    //         tag.classList.remove("selected");
    //     } else {
    //         selectedIds.push(id);
    //         tag.classList.add("selected");
    //     }

    //     console.log(selectedIds);
    //     updateHiddenInput();
    // };

    // fitTag.addEventListener("click", handleFitTag);

    // const fitChoices = new Choices("#fit-select", {
    //     removeItemButton: true,
    //     placeholder: true,
    //     searchPlaceholderValue: "Search fits...",
    //     placeholderValue: "Select fits...",
    //     allowHTML: true, // correct key instead of allowHtmlUserInput
    //     searchEnabled: true,
    //     searchChoices: true,
    // });

    new TomSelect("#fit-select", {
        plugins: ["remove_button"],
        placeholder: "Select fits...",
        persist: false,
        create: false,
    });


};
document.addEventListener("DOMContentLoaded", initializeTagActive);
