const initializeRating = () => {
    const ratingBtns = document.querySelectorAll(".rating-btn");
    const ratingInput = document.querySelector(".rating");
    const stars = document.querySelectorAll(".star");
    let selectedRating = 0;

    ratingBtns.forEach((btn, index) => {
        // Hover effect
        btn.addEventListener("mouseover", () => {
          stars.forEach((star, i) => {
            if (i <= index) {
              star.classList.add("fill-yellow-400");
              star.classList.remove("fill-gray-300");
            } else {
              star.classList.remove("fill-yellow-400");
              star.classList.add("fill-gray-300");
            }
          });
        });

        // Remove hover effect when mouse leaves the star area
        btn.addEventListener("mouseout", () => {
          stars.forEach((star, i) => {
            if (i < selectedRating) {
              star.classList.add("fill-yellow-400");
              star.classList.remove("fill-gray-300");
            } else {
              star.classList.remove("fill-yellow-400");
              star.classList.add("fill-gray-300");
            }
          });
        });

        // Click to select rating
        btn.addEventListener("click", (e) => {
            e.preventDefault()
            e.stopPropagation()
          selectedRating = index + 1; // store selected rating
          ratingInput.value = index + 1;

          console.log("Selected rating:", selectedRating);
        });
      });


  };

  document.addEventListener("DOMContentLoaded", initializeRating);
