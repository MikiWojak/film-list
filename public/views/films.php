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

        <script type="text/javascript" src="./public/js/search.js" defer></script>
        <script type="text/javascript" src="./public/js/rate.js" defer></script>
    </head>
    <body>
        <header class="header">
            <div class="flex-row-center-center header_left">
                <a href="/dashboard" class="flex-row-center-center header__logo">
                    <span class="material-symbols-outlined header__logo__image">
                        movie
                    </span>
                    <h1 class="header__logo__text">Film Rate</h1>
                </a>
            </div>

            <a href="/login" class="flex-row-center-center header__login">
                <span class="material-symbols-outlined header__login__icon">
                    login
                </span>
            </a>
        </header>

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
                                <button id="myBtn" class="flex-row-center-center film__rate">
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

        <div class="tab-bar">
            <a href="/dashboard" class="tab-bar__option">
                <span class="material-symbols-outlined">
                    home
                </span>
            </a>
            <button class="tab-bar__option">
                <span class="material-symbols-outlined">
                    search
                </span>
            </button>
            <button class="tab-bar__option">
                <span class="material-symbols-outlined">
                    star
                </span>
            </button>
            <a href="/login" class="tab-bar__option">
                <span class="material-symbols-outlined">
                    login
                </span>
            </a>
        </div>

        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Some text in the Modal..</p>
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
                <button id="myBtn" class="flex-row-center-center film__rate">
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
