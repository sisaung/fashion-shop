const initializeChangeUserProfile = () => {
    const changeProfileBtn = document.querySelector(".change-profile-btn");
    const file = document.querySelector(".image-file-upload");
    const userProfileUrl = document.querySelector("[data-user-profile]");

        console.log(file);


    const action = userProfileUrl.dataset.userProfile;
    console.log(action)

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

            // formData.append("profile_image",file)

            try {
                const res = await fetch(
                    `/account/profile-information/change-profile`,
                    {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": csrfToken,
                        },
                        body: formData,
                        credentials:"same-origin"


                    }
                );

                if (res.ok) {

                    location.href = action;
                }

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

document.addEventListener("DOMContentLoaded", initializeChangeUserProfile);
