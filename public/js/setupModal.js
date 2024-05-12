export const setupModal = () => {
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

        await doRate();
    });

    removeRateBtn.addEventListener("click", async (event) => {
        event.preventDefault();

        await removeRate();
    });
}

const doRate = async () => {
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

        // await refresh();

        rateModal.classList.remove('enabled');
    } catch (error) {
        console.error(error);
    }
}

const removeRate = async () => {
    const rateModal = document.querySelector("#rate-modal");
    const filmId = rateModal.querySelector("#filmId");

    try {
        await fetch(`/removerate/${filmId.value}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
        });

        // await refresh();

        rateModal.classList.remove('enabled');
    } catch (error) {
        console.error(error);
    }
}

// const refresh = () => {}