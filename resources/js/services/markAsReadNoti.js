const markAsReadNoti = async(notifId) => {

    try {
        const res = await fetch(`/dashboard/mark-as-read-noti/${notifId}`,{
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
export default markAsReadNoti


