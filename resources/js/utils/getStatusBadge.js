const getStatusBadge = (status) => {
    const statusKey = status ? status.toLowerCase() : "Pending".toLowerCase();

    const statusMap = {
        pending: {
            text: "Pending",
            bg: "bg-yellow-100",
            textColor: "text-yellow-800",
            icon: `<svg xmlns="http://www.w3.org/2000/svg" class="size-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                   </svg>`
        },
        confirmed: {
            text: "Confirmed",
            bg: "bg-blue-100",
            textColor: "text-blue-800",
            icon: `<svg xmlns="http://www.w3.org/2000/svg" class="size-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16" />
                    </svg>`
        },
        delivered: {
            text: "Delivered",
            bg: "bg-purple-100",
            textColor: "text-purple-800",
            icon: `<svg xmlns="http://www.w3.org/2000/svg" class="size-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18" />
                    </svg>`
        },
        completed: {
            text: "Completed",
            bg: "bg-green-100",
            textColor: "text-green-800",
            icon: `<svg xmlns="http://www.w3.org/2000/svg" class="size-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>`
        }
    };

    const current = statusMap[statusKey] || {
        text: status.charAt(0).toUpperCase() + status.slice(1),
        bg: "bg-red-100",
        textColor: "text-red-800",
        icon: `<svg xmlns="http://www.w3.org/2000/svg" class="size-3" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>`
    };

    return `
        <span class="text-xs font-semibold ${current.textColor} ${current.bg} px-4 py-1 rounded-full inline-flex items-center gap-1">
            ${current.icon}
            <span>${current.text}</span>
        </span>
    `;
};
export default getStatusBadge;
