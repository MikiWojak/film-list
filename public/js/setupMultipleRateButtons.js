import { setupRateButton } from "./setupRateButton.js";

export const setupMultipleRateButtons = () => {
    const rateModal = document.querySelector("#rate-modal");
    const rateButtons = document.querySelectorAll("#rate__btn");

    rateButtons.forEach(
        rateButton => setupRateButton(rateButton, rateModal)
    );
}
