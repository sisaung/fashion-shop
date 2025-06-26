// const initalizeApplyCoupon = () => {
//     const container = document.querySelector(".summary-output");

//     if (!container) return;
//     container.addEventListener("click", (e) => {
//         const couponCode = e.target.closest(".coupon_code");
//         const couponApplyBtn = e.target.closest(".coupon-apply-btn");

//         let coupnCodeInput;
//         if (couponCode) {
//             const handleChange = (e) => {
//                 if (e.target.value) {
//                     //  change color apply btnc
//                     couponCode.setAttribute('data-coupon-code', e.target.value);
//                 }
//             };


//             console.log(couponCode.dataset)
//             couponCode.addEventListener("keyup", handleChange);
//         }

//         if (couponApplyBtn) {

//             console.log(couponApplyBtn);


//         }

//         // if (applyCoupon) {
//         //     const form = applyCoupon.closest("form");
//         //     form.submit();
//         // }
//     });
// };

// document.addEventListener("DOMContentLoaded", initalizeApplyCoupon);
