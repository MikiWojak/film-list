<?php $isRatedFilmSet = isset($ratedFilm); ?>

<section class="flex film">
    <img
        class="film__poster"
        src="<?= $isRatedFilmSet ? "public/uploads/{$ratedFilm->getFilm()->getPosterUrl()}" : ""  ?>"
        alt="Poster"
    >

    <div class="film__bottom">
        <h2 class="film__title">
            <a
                href="<?= $isRatedFilmSet ? "film?id={$ratedFilm->getFilm()->getId()}" : "" ?>"
                class="white_link film__title--inner"
            >
                <?= $isRatedFilmSet ? $ratedFilm->getFilm()->getTitle() : "" ?>
            </a>
        </h2>

        <div class="film__bottom__rate-section">
            <div class="flex-row-center-center film__rate">
                <span class="material-symbols-outlined star">
                    hotel_class
                </span>

                <span class="film__avg_rate--inner">
                    <?= $isRatedFilmSet ? number_format($ratedFilm->getFilm()->getAvgRate(), 2) : "" ?>
                </span>
            </div>
            <button
                id="rate__btn"
                class="flex-row-center-center btn--reset film__rate"
                data-id="<?= $isRatedFilmSet ? $ratedFilm->getFilm()->getId() : "" ?>"
                data-rate="<?= $isRatedFilmSet ? $ratedFilm->getRate() : "" ?>"
                data-title="<?= $isRatedFilmSet ? $ratedFilm->getFilm()->getTitle() : "" ?>"
            >
                <span class="material-symbols-outlined star">
                    star
                </span>

                <span class="film__my_rate--inner">
                    <?= $isRatedFilmSet && $ratedFilm->getRate() !== null ? $ratedFilm->getRate() : 'Rate' ?>
                </span>
            </button>
        </div>
    </div>
</section>
