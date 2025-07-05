const updateToggleUI = (isChecked) => {
    const toggleBg = document.getElementById("stockToggleBg");
    const toggleDot = document.getElementById("stockToggleDot");
    if (isChecked) {
        toggleBg.classList.replace("bg-gray-300", "bg-pearl-bush-500");
        toggleDot.style.transform = "translateX(16px)";
    } else {
        toggleBg.classList.replace("bg-pearl-bush-500", "bg-gray-300");
        toggleDot.style.transform = "translateX(0)";
    }
};
export default updateToggleUI;
