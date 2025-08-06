
const timeStep = (date) => {
    const createdDate = new Date(date);
    const now = new Date();

    const diffMs = now - createdDate;
    console.log(diffMs);
    const diffSecs = Math.floor(diffMs / 1000);
    console.log(diffSecs);
    const diffMins = Math.floor(diffMs / (1000 * 60));
    const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));

    let display = "";

    if (diffSecs < 60) {
        display = "Just now";
    } else if (diffMins < 60) {
        display = diffMins + (diffMins === 1 ? " min ago" : " mins ago");
    } else if (diffHours < 24) {
        display = diffHours + (diffHours === 1 ? " hr ago" : " hrs ago");
    } else {
        // Show formatted date e.g. July 17, 2024
        const options = { year: "numeric", month: "short", day: "numeric" };
        display = createdDate.toLocaleDateString("en-US", options);
    }
    return display;
};
export default timeStep;
