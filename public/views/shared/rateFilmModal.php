<div id="rate-modal" class="modal">
    <div class="modal__content">
        <div class="modal__content__header">
            <span class="modal__content__close">&times;</span>
        </div>

        <h2>Rate film</h2>
        <h1 id="modal-film-title"></h1>

        <div
            class="flex-column-center-center form"
        >
            <input type="hidden" name="filmId" id="filmId" value="" />

            <select name="rate" id="rate">
                <option disabled selected value>-- Rate film --</option>
                <option value="10">(10) Masterpiece</option>
                <option value="9">(9) Great</option>
                <option value="8">(8) Very Good</option>
                <option value="7">(7) Good</option>
                <option value="6">(6) Fine</option>
                <option value="5">(5) Average</option>
                <option value="4">(4) Bad</option>
                <option value="3">(3) Very Bad</option>
                <option value="2">(2) Horrible</option>
                <option value="1">(1) Appalling</option>
            </select>

            <button
                id="rate-submit-btn"
                class="btn--reset btn btn--purple form__submit"
            >
                Rate
            </button>

            <a href="#" id="remove-rate-btn" class="modal__remove">Remove rate</a>
        </div>
    </div>
</div>
