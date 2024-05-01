<section class="flex film">
    <img class="film__poster" src="public/uploads/<?= $film->getPosterUrl(); ?>" alt="Poster">

    <div class="film__bottom">
        <h2 class="film__title">
            <a href="/single-film" class="white_link film__title--inner">
                <?= $film->getTitle(); ?>
            </a>
        </h2>

        <div class="film__bottom__rate-section">
            <div class="flex-row-center-center film__rate">
                <span class="material-symbols-outlined star">
                    star_rate
                </span>

                <span class="film__avg_rate--inner">
                    <?= $film->getAvgRate(); ?>
                </span>
            </div>
            <button
                id="rate__btn"
                class="flex-row-center-center film__rate"
                data-id="<?= $film->getId(); ?>"
                data-title="<?= $film->getTitle(); ?>"
            >
                <span class="material-symbols-outlined star">
                    star
                </span>

                <span class="film__my_rate--inner">
                    Rate
                </span>
            </button>
        </div>
    </div>
</section>
