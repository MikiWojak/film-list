<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?= $title ?></title>

        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
            rel="stylesheet"
        />

        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        />

        <link rel="stylesheet" type="text/css" href="public/css/main.css" />
        <link rel="stylesheet" type="text/css" href="public/css/common.css" />
        <link rel="stylesheet" type="text/css" href="public/css/films.css" />
        <link rel="stylesheet" type="text/css" href="public/css/modal.css" />

        <script type="module" src="./public/js/filmsSearch.js" defer></script>
        <script type="module" src="./public/js/initRateButtonsSetup.js" defer></script>
    </head>
    <body>
        <?php include_once __DIR__.'/shared/header.php' ?>

        <div class="film-container">
            <div class="flex-row-center-center search--desktop">
                <button class="search__rated-btn">
                    <span class="material-symbols-outlined star">
                        star
                    </span>
                </button>
                <div class="flex-row-center-center search__form">
                    <input
                        id="search"
                        type="text"
                        placeholder="Search"
                        class="input__text search__form__text">
                    <button class="search__form__submit white_link">
                        <span class="material-symbols-outlined">
                            search
                        </span>
                    </button>
                </div>
            </div>

            <main class="film_list">
                <?php foreach($films as $film): ?>
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
                <?php endforeach; ?>
            </main>
        </div>

        <?php include_once __DIR__.'/shared/tabBar.php' ?>

        <div id="rate-modal" class="modal">
            <div class="modal__content">
                <div class="modal__content__header">
                    <span class="modal__content__close">&times;</span>
                </div>

                <h2>Rate film (<span id="modal-film-id"></span>)</h2>
                <h1 id="modal-film-title"></h1>

                <form class="flex-column-center-center form">
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
                        class="btn--reset btn btn--purple form__submit"
                    >
                        Rate
                    </button>

                    <a href="#" class="modal__remove">Remove rate</a>
                </form>
            </div>
        </div>
    </body>
</html>

<template id="film-template">
    <section class="flex film">
        <img class="film__poster" src="" alt="Poster"/>

        <div class="film__bottom">
            <h2 class="film__title">
                <a href="/single-film" class="white_link film__title--inner"></a>
            </h2>

            <div class="film__bottom__rate-section">
                <div class="flex-row-center-center film__rate">
                    <span class="material-symbols-outlined star">
                        star_rate
                    </span>

                    <span class="film__avg_rate--inner"></span>
                </div>
                <button
                    id="rate__btn"
                    class="flex-row-center-center film__rate"
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
</template>
