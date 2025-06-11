const initializeTagActive = () => {
    const fitTag = document.querySelector(".fit-tags");
    const fitHidden = document.querySelector(".fit-hidden");

    let selectedIds = fitHidden.value
        ? fitHidden.value.split(",").map((id) => parseInt(id))
        : [];

    if (selectedIds) {
        fitTag.querySelectorAll(".fit-tag").forEach((tag) => {
            tag.classList.remove("selected");
            if (selectedIds.includes(parseInt(tag.dataset.id))) {
                tag.classList.add("selected");
            }
        });
    }

    const updateHiddenInput = () => {
        fitHidden.value = selectedIds.join(",");
    };

    const handleFitTag = (e) => {
        const tag = e.target.closest(".fit-tag");

        if (!tag) return;
        const id = parseInt(tag.dataset.id);



        if (selectedIds.includes(id)) {
            selectedIds = selectedIds.filter((el) => el !== id);
            tag.classList.remove("selected");
        } else {
            selectedIds.push(id);
            tag.classList.add("selected");
        }

        console.log(selectedIds);
        updateHiddenInput();
    };

    fitTag.addEventListener("click", handleFitTag);
};

document.addEventListener("DOMContentLoaded", initializeTagActive);
