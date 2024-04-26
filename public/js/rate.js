const rateModal = document.getElementById("rate-modal");
const rateBtn = document.getElementById("rate-btn");
const modalCloseBtn = document.getElementsByClassName("modal__close")[0];

rateBtn.addEventListener("click", () => {
    rateModal.style.display = "block";
});

modalCloseBtn.addEventListener("click", () => {
    rateModal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === rateModal) {
        rateModal.style.display = "none";
    }
});
