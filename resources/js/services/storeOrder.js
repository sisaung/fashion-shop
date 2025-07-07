const storeOrder = async (url, data, csrfToken) => {
    try {
        const res = await fetch(url, {
            method: "POST",
            headers: {

                "Content-Type": "application/json",
                'Accept' : "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(data),
        });
        return res;
    } catch (e) {
        console.log(e);
    }
};
export default storeOrder;
