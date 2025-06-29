// const initializeRating = () => {
//     const ratingBtn = document.querySelectorAll(".rating-btn");
//     const stars = document.querySelectorAll(".star");
//     ratingBtn.forEach((rating) => {
//         rating.addEventListener("click", () => {
//            stars.forEach(star => {
//            star.classList.toggle('fill-red-500')
//            })
//             console.log(rating.dataset.rating);

//         });
//     });
// }
// document.addEventListener("DOMContentLoaded", initializeRating);
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

    // ratingBtns.forEach((btn, index) => {



    //   btn.addEventListener("click", (e) => {
    //     e.preventDefault()
    //     e.stopPropagation()
    //     // Remove fill from all stars first
    //     stars.forEach(star => {
    //       star.classList.remove("fill-yellow-400");
    //       star.classList.add("fill-gray-300");
    //     });

    //     // Add fill to clicked star and all before it
    //     for (let i = 0; i <= index; i++) {
    //       stars[i].classList.remove("fill-gray-300");
    //       stars[i].classList.add("fill-yellow-400");
    //     }

    //     ratingInput.value = btn.dataset.rating;
    //   });
    // });
  };

  document.addEventListener("DOMContentLoaded", initializeRating);
