export function setupRateButtons () {
    const rateModal = document.querySelector("#rate-modal");
    const rateButtons = document.querySelectorAll("#rate__btn");

    rateButtons.forEach(rateButton => {
        rateButton.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const title = this.getAttribute("data-title");

            rateModal.querySelector("#modal-film-id").innerText = id;
            rateModal.querySelector("#modal-film-title").innerText = title;

            rateModal.classList.add('enabled');
        });
    });
}
