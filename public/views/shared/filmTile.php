<?php $isFilmSet = isset($film); ?>

<section class="flex film">
    <img
        class="film__poster"
        src="<?= $isFilmSet ? "public/uploads/{$film->getPosterUrl()}" : ""  ?>"
        alt="Poster"
    >

    <div class="film__bottom">
        <h2 class="film__title">
            <a href="<?= $isFilmSet ? "film?id={$film->getId()}" : "" ?>" class="white_link film__title--inner">
                <?= $isFilmSet ? $film->getTitle() : "" ?>
            </a>
        </h2>

        <div class="film__bottom__rate-section">
            <div class="flex-row-center-center film__rate">
                <span class="material-symbols-outlined star">
                    hotel_class
                </span>

                <span class="film__avg_rate--inner">
                    <?= $isFilmSet ? number_format($film->getAvgRate(), 2) : "" ?>
                </span>
            </div>
            <button
                id="rate__btn"
                class="flex-row-center-center btn--reset film__rate"
                data-id="<?= $isFilmSet ? $film->getId() : "" ?>"
                data-rate="<?= $isFilmSet ? $film->getRate() : "" ?>"
                data-title="<?= $isFilmSet ? $film->getTitle() : "" ?>"
            >
                <span class="material-symbols-outlined star">
                    star
                </span>

                <span class="film__my_rate--inner">
                    <?= $isFilmSet && $film->getRate() !== null ? $film->getRate() : 'Rate' ?>
                </span>
            </button>
        </div>
    </div>
</section>
