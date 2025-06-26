const checkCoupon = async (couponCode) => {
    try {
        const res = await fetch(`coupon-check?coupon_code=${couponCode}`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        });
        // if (!res.ok) {
        //     console.log(res)
        // }
        console.log(res)
        const data = await res.json();
        return data;
    } catch (e) {
        console.log(e);
    }
};
export default checkCoupon;
