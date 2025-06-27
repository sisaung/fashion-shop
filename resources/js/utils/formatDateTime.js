const formatDateTime = (date) => {
    const options = {
        year: "numeric",
        month: "short",
        day: "numeric",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
    };
    return new Date(date).toLocaleString("en-US", options);
};
export default formatDateTime
