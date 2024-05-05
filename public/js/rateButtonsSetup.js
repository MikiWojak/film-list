export const setupRateButtons = () => {
    const rateModal = document.querySelector("#rate-modal");
    const rateButtons = document.querySelectorAll("#rate__btn");

    rateButtons.forEach(rateButton =>
        rateButton.addEventListener("click", () => {
            const id = rateButton.getAttribute("data-id");
            const title = rateButton.getAttribute("data-title");

            rateModal.querySelector("#filmId").setAttribute("value", id);
            rateModal.querySelector("#modal-film-title").innerText = title;

            rateModal.classList.add('enabled');
        })
    );
}
