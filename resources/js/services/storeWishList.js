const storeWishList = async (url, formData) => {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    // const wishList = JSON.parse(localStorage.getItem('wishList')) || [];
    // localStorage.setItem('wishList', JSON.stringify(wishList));

    try {
        const res = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                'X-Requested-With': 'XMLHttpRequest',
                Accept: "applicaton/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(formData),
        });

        if (res.status == 401) {
            const data = await res.json();
            return data;
        }
        const data = await res.json();
        return data;
    } catch (e) {
        console.log(e);
    }
};

export default storeWishList;
