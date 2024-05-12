import { fetchFilms } from "./filmsSearch.js";

export const setupModal = (isSingle = false) => {
    const rateModal = document.querySelector("#rate-modal");
    const modalCloseBtn = rateModal.querySelector(".modal__content__close");
    const rateSubmitBtn = rateModal.querySelector("#rate-submit-btn");
    const removeRateBtn = rateModal.querySelector("#remove-rate-btn");

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

        await doRate(isSingle);
    });

    removeRateBtn.addEventListener("click", async (event) => {
        event.preventDefault();

        await removeRate(isSingle);
    });
}

const doRate = async (isSingle = false) => {
    const rateModal = document.querySelector("#rate-modal");
    const rate = rateModal.querySelector("#rate");
    const filmId = rateModal.querySelector("#filmId");

    if (!rate.value) {
        return;
    }

    const data = { rate: rate.value };

    try {
        await fetch(`/rate/${filmId.value}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        });

        if (isSingle) {
            location.reload();
        } else {
            await fetchFilms();

            rateModal.classList.remove('enabled');
        }

    } catch (error) {
        console.error(error);
    }
}

const removeRate = async (isSingle = false) => {
    const rateModal = document.querySelector("#rate-modal");
    const filmId = rateModal.querySelector("#filmId");

    try {
        await fetch(`/removerate/${filmId.value}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
        });

        if (isSingle) {
            location.reload();
        } else {
            await fetchFilms();

            rateModal.classList.remove('enabled');
        }

        rateModal.classList.remove('enabled');
    } catch (error) {
        console.error(error);
    }
}
