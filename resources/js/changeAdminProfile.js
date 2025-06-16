const initializeChangeAdminProfile = () => {
    const changeProfileBtn = document.querySelector(".change-profile-btn");
    const file = document.querySelector(".file");
    const adminProfileUrl = document.querySelector("[data-admin-profile]");

    const action = adminProfileUrl.dataset.adminProfile;

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    const handleClick = () => {
        const handleFileChange = async (e) => {
            const files = e.target.files;

            if (!files) return;

            const formData = new FormData();

            for (let file of files) {
                formData.append("profile_image", file);
            }

            try {
                const res = await fetch(
                    `/dashboard/admin-profile/change-profile-image`,
                    {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        body: formData,
                    }
                );

                if (res.ok) {
                    location.href = action;
                }
                // const data = await res.json();

                console.log(await res.json());
            } catch (e) {
                console.log(e);
            }
        };
        file.addEventListener("change", handleFileChange);

        file.click();
        //   location.href = '/dashboard/admin-profile'
    };

    changeProfileBtn.addEventListener("click", handleClick);
};

document.addEventListener("DOMContentLoaded", initializeChangeAdminProfile);
