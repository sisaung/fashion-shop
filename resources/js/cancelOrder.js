
const initializeCancelOrder = () => {

    const toggleCancellationOrderForm = document.querySelector('.toggle-cancellation-order-form');
    const cancelOrderForm = document.querySelector('.cancel-order-form');
    const cancelReasonTag = document.querySelector('.cancle-reason-tag');




    cancelOrderForm.classList.add('hidden');
    if (!toggleCancellationOrderForm) return;

    const handleChange = (e) => {


        if (e.target.checked) {

            cancelOrderForm.classList.remove('hidden')
            cancelOrderForm.classList.add('add')

        }
        else {

            cancelOrderForm.classList.remove("grid")
            cancelOrderForm.classList.add("hidden")
        }

    }

    const handleClickTagBtn = (e) => {
        const reasons = document.querySelectorAll('[data-reason]');

        if (!reasons) return;

        reasons.forEach((reason) => {

            console.log(reason);



        })




    }

    cancelReasonTag.addEventListener('click', handleClickTagBtn)
    toggleCancellationOrderForm.addEventListener('change', handleChange)



}

document.addEventListener('DOMContentLoaded', initializeCancelOrder)
