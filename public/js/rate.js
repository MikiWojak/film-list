const rateModal = document.querySelector("#rate-modal");
const rateButtons = document.querySelectorAll("#rate__btn");
const modalCloseBtn = document.querySelector(".modal__content__close");

rateButtons.forEach(rateButton => {
    rateButton.addEventListener("click", () => {
        rateModal.classList.add('enabled');
    });
})

modalCloseBtn.addEventListener("click", () => {
    rateModal.classList.remove('enabled');
});

window.addEventListener("click", (event) => {
    if (event.target === rateModal) {
        rateModal.classList.remove('enabled');
    }
});
