// @TODO How to assign triggers on search?
const rateModal = document.querySelector("#rate-modal");
const rateButtons = document.querySelectorAll("#rate__btn");
const modalCloseBtn = document.querySelector(".modal__content__close");

rateButtons.forEach(rateButton => {
    rateButton.addEventListener("click", function() {
        const id = this.getAttribute("data-id");
        const title = this.getAttribute("data-title");

        rateModal.querySelector("#modal-film-id").innerText = id;
        rateModal.querySelector("#modal-film-title").innerText = title;

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
