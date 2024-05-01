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
                <?php
                foreach($films as $film) {
                    include __DIR__.'/shared/filmTile.php';
                }
                ?>
            </main>
        </div>

        <?php include_once __DIR__.'/shared/tabBar.php' ?>

        <?php include_once __DIR__.'/shared/rateFilmModal.php' ?>
    </body>
</html>

<template id="film-template">
    <?php
    if (isset($film)) {
        unset($film);
    }

    include __DIR__.'/shared/filmTile.php';
    ?>
</template>
