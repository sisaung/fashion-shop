
const ajax = async (url, selector, renderSelector) => {
    try {
        const res = await fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });

        const htmlText = await res.text();

        const newContent = new DOMParser()
            .parseFromString(htmlText, "text/html")
            .querySelector(selector).innerHTML;

        renderSelector.innerHTML = newContent;

        window.history.pushState({}, "", url);
    } catch (error) {
        console.log(error);
    }
};

export default ajax;

