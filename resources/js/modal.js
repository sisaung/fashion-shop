document.addEventListener('click', function(e) {
    // Handle dropdown toggle clicks
    if (e.target.closest('[data-dropdown-toggle]')) {
        const toggleId = e.target.closest('[data-dropdown-toggle]').getAttribute('data-dropdown-toggle');
        console.log(toggleId);
        const dropdown = document.getElementById(toggleId);
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }

    // Handle modal toggle clicks
    if (e.target.closest('[data-modal-toggle]')) {
        const modalId = e.target.closest('[data-modal-toggle]').getAttribute('data-modal-target');
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.toggle('hidden');
        }
    }
});
