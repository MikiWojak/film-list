import { setupRateButtons } from './rateButtonsSetup.js';

const rateModal = document.querySelector("#rate-modal");
const modalCloseBtn = document.querySelector(".modal__content__close");

setupRateButtons();

modalCloseBtn.addEventListener("click", () => {
    rateModal.classList.remove('enabled');
});

window.addEventListener("click", (event) => {
    if (event.target === rateModal) {
        rateModal.classList.remove('enabled');
    }
});
