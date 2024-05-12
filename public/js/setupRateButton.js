export const setupRateButton = (rateButton, rateModal) => {
    rateButton.addEventListener("click", () => {
        const isLoggedIn = rateModal.querySelector("#isLoggedIn").value;

        if (!isLoggedIn) {
            alert("You must be logged in to rate a film");

            return;
        }

        const id = rateButton.getAttribute("data-id");
        const rate = rateButton.getAttribute("data-rate");
        const title = rateButton.getAttribute("data-title");

        const rateSelect = rateModal.querySelector("#rate");
        const removeRateBtn = rateModal.querySelector("#remove-rate-btn");

        rateModal.querySelector("#filmId").setAttribute("value", id);
        rateModal.querySelector("#modal-film-title").innerText = title;

        if (rate) {
            rateSelect.value = rate;
            removeRateBtn.classList.add('enabled');
        } else {
            rateSelect.value = '';
            removeRateBtn.classList.remove('enabled');
        }

        rateModal.classList.add('enabled');
    })
}
