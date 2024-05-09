<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Saving Private Ryan</title>

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
    </head>
    <body>
        <?php include_once __DIR__.'/shared/header.php' ?>

        <div class="film-container">
            <a href="/" class="flex-row-start-center back">
                <span class="material-symbols-outlined">
                    arrow_left_alt
                </span>
                <span>
                    Back
                </span>
            </a>
            
            <main>
                <h2 class="title">
                    <?= $film->getTitle() ?>
                </h2>

                <section class="film-info">
                    <div class="film-info__poster">
                        <img
                            class="film-info__poster--img"
                            src="<?= "public/uploads/{$film->getPosterUrl()}"  ?>"
                            alt="Poster"
                        >
                    </div>


                    <div class="film-info__details">
                        <div class="film-info_rate">
                            <div class="flex-row-center-center film__rate">
                                <span class="material-symbols-outlined star">
                                    star_rate
                                </span>

                                <span><?= $film->getAvgRate() ?></span>
                            </div>
                            <div class="flex-row-center-center film__rate">
                                <span class="material-symbols-outlined star">
                                    star
                                </span>

                                <span>
                                    <?= $film->getRate() === null ? 'Rate' : $film->getRate() ?>
                                </span>
                            </div>
                        </div>

                        <div class="desktop-only">
                            <p>
                                Director:
                                <b>
                                    <?= "{$film->getDirector()->getFirstName()} {$film->getDirector()->getLastName() }" ?>
                                </b>
                            </p>
                        </div>
                    </div>
                </section>

                <section class="film-info--mobile">
                    <p>
                        Director:
                        <b>
                            <?= "{$film->getDirector()->getFirstName()} {$film->getDirector()->getLastName() }" ?>
                        </b>
                    </p>
                </section>

                <section class="film_desctiption">
                    <?= $film->getDescription() ?>
                </section>
            </main>
        </div>

        <?php include_once __DIR__.'/shared/tabBar.php' ?>
    </body>
</html>
