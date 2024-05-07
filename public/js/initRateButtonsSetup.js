import { setupRateButtons } from './rateButtonsSetup.js';

const rateModal = document.querySelector("#rate-modal");
const modalCloseBtn = rateModal.querySelector(".modal__content__close");
const rateSubmitBtn = rateModal.querySelector("#rate-submit-btn");
const rate = rateModal.querySelector("#rate");
const filmId = rateModal.querySelector("#filmId");

setupRateButtons();

modalCloseBtn.addEventListener("click", () =>
    rateModal.classList.remove('enabled')
);

window.addEventListener("click", (event) => {
    if (event.target === rateModal) {
        rateModal.classList.remove('enabled');
    }
});

rateSubmitBtn.addEventListener("click", async (event) => {
    event.preventDefault();

    await rateFilm();
})

const rateFilm = async () => {
    const data = { rate: rate.value };

    try {
        const response = await fetch(`/rate/${filmId.value}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        });

    } catch (error) {
        console.error(error);
    }
}
