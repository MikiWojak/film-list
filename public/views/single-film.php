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
            <a href="/dashboard" class="flex-row-start-center back">
                <span class="material-symbols-outlined">
                    arrow_left_alt
                </span>
                <span>
                    Back
                </span>
            </a>
            
            <main>
                <h2 class="title">
                    Saving Private Ryan
                </h2>

                <section class="film-info">
                    <div class="film-info__poster">
                        <img src="public/img/Saving_Private_Ryan.jpg" alt="Poster" class="film-info__poster--img">
                    </div>


                    <div class="film-info__details">
                        <div class="film-info_rate">
                            <div class="flex-row-center-center film__rate">
                                <span class="material-symbols-outlined star">
                                    star_rate
                                </span>

                                <span>8.9</span>
                            </div>
                            <div class="flex-row-center-center film__rate">
                                <span class="material-symbols-outlined star">
                                    star
                                </span>

                                <span>Rate</span>
                            </div>
                        </div>

                        <div class="desktop-only">
                            <p>
                                Director: <b>Steven Spielberg</b>
                            </p>
                        </div>
            
                        <div class="flex-row-start-center tag_list desktop-only">
                            <div class="tag" style="color: #000000; background-color: #E84040;">
                                War
                            </div>
                            <div class="tag" style="color: #000000; background-color: #F2DD21;">
                                Drama
                            </div>
                        </div>
                    </div>
                </section>

                <section class="film-info--mobile">
                    <p>
                        Director: <b>Steven Spielberg</b>
                    </p>

                    <div class="flex-row-start-center tag_list">
                        <div class="tag" style="color: #000000; background-color: #E84040;">
                            War
                        </div>
                        <div class="tag" style="color: #000000; background-color: #F2DD21;">
                            Drama
                        </div>
                    </div>
                </section>

                <section class="film_desctiption">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed convallis turpis, ac cursus magna. Nunc vestibulum lobortis leo, in aliquam nulla vulputate sit amet. Mauris tristique varius pellentesque. In sodales urna sed urna pulvinar pharetra. Donec varius mauris vel sem finibus, sit amet placerat nunc luctus. Aenean euismod est ac pharetra viverra. Donec non mauris metus. Integer varius leo nec tempus malesuada.
                    </p>
                    <p>
                        Donec id massa euismod, pretium purus ut, imperdiet lorem. Integer maximus nisi eget purus egestas posuere. Vivamus sit amet fermentum erat. Vivamus at sem eu nisl sodales fringilla non vel magna. Etiam at ante eu ipsum blandit dignissim. Suspendisse ut nulla orci. Fusce ipsum sem, consectetur et rhoncus eget, consequat vel velit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Praesent augue mauris, tempus non odio eu, tristique aliquam ante. Sed euismod vel nulla et laoreet. Mauris mattis lorem vel justo consequat facilisis.
                    </p>
                    <p>
                        Duis lacinia nisi tempor purus iaculis, in finibus nunc commodo. Proin dignissim, tellus sed convallis pellentesque, elit lorem pretium eros, vitae convallis est lacus quis est. Nam id vehicula leo. Nulla ac commodo sapien, a tempor eros. Aliquam euismod elit sit amet odio cursus ultricies. Pellentesque cursus, nunc at iaculis ultrices, arcu ex rutrum diam, eu eleifend dolor nisi non augue. Praesent porttitor lectus turpis, eget porta mauris porta ac. Fusce quis lorem sed ligula cursus egestas. Donec dui ipsum, lobortis non purus sit amet, sodales sodales ex. Morbi at condimentum ante, a pulvinar est. Duis ac neque tincidunt, dictum ante ac, commodo velit. Mauris interdum purus at erat blandit placerat. Aenean consectetur, nunc vel varius egestas, nunc eros convallis dolor, sit amet sollicitudin arcu quam a nunc. Duis congue purus et enim blandit varius. Mauris a orci et nibh aliquam feugiat. Donec et mattis urna.
                    </p>
                </section>
            </main>
        </div>

        <?php include_once __DIR__.'/shared/tabBar.php' ?>
    </body>
</html>
