const markAsReadAllNoti = async() => {

    try {
        const res = await fetch(`/dashboard/mark-as-read-noti`,{
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            }
        });
        if (!res.ok) throw new Error("Fetch error");
        const data = await res.json();
        return data;
    } catch (e) {
        console.error("Error fetching order notifications:", e);
    }
}
export default markAsReadAllNoti


