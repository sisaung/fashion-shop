document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const closeSidebarBtn = document.getElementById('closeSidebar');
    const openSidebarBtn = document.getElementById('openSidebar'); // if you have an open button
    const overlay = document.getElementById('sidebarOverlay');

    const openSidebar = () => {
        sidebar.classList.remove('-translate-x-full');
        if (window.innerWidth < 1024) { // show overlay only on mobile
            overlay.classList.remove('hidden');
        }
    };

    const closeSidebar = () => {
        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    };

    if (closeSidebarBtn) {
        closeSidebarBtn.addEventListener('click', () => {
            closeSidebar();
        });
    }

    if (openSidebarBtn) {
        openSidebarBtn.addEventListener('click', () => {
            openSidebar();
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            closeSidebar();
        });
    }
});
