import { setupModal } from './setupModal.js';
import { setupRateButton } from './setupRateButton.js'

const rateModal = document.querySelector("#rate-modal");
const rateButton = document.querySelector("#rate__btn");

setupModal(true);
setupRateButton(rateButton, rateModal);
