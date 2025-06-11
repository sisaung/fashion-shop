const initializeTagActive = () => {
    const sizeTag = document.querySelector(".size-tags");
    const sizeHidden = document.querySelector(".size-hidden");

    let selectedIds = sizeHidden.value
        ? sizeHidden.value.split(",").map((id) => parseInt(id))
        : [];

    if (selectedIds) {
        sizeTag.querySelectorAll(".size-tag").forEach((tag) => {
            tag.classList.remove("selected");
            if (selectedIds.includes(parseInt(tag.dataset.id))) {
                tag.classList.add("selected");
            }
        });
    }

    const updateHiddenInput = () => {
        sizeHidden.value = selectedIds.join(",");
    };

    const handleFitTag = (e) => {
        const tag = e.target.closest(".size-tag");

        if (!tag) return;
        const id = parseInt(tag.dataset.id);

        if (selectedIds) {
            tag.classList.add("selected");
        }

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

    sizeTag.addEventListener("click", handleFitTag);
};

document.addEventListener("DOMContentLoaded", initializeTagActive);
