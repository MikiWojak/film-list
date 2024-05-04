<header class="header">
    <div class="flex-row-center-center header_left">
        <?php
            if(isset($_SESSION['isAdmin'])) {
                echo '
                    <button class="material-symbols-outlined btn--reset header_menu">
                        menu
                    </button>
                ';
            }
        ?>

        <a href="films" class="flex-row-center-center header__logo">
            <span class="material-symbols-outlined header__logo__image">
                movie
            </span>
            <h1 class="header__logo__text">Film Rate</h1>
        </a>
    </div>

    <a href="<?= isset($_SESSION['loggedUser']) ? "profile" : "login" ?>" class="flex-row-center-center header__login">
        <span class="material-symbols-outlined header__login__icon">
            <?= isset($_SESSION['loggedUser']) ? "account_circle" : "login" ?>
        </span>
    </a>
</header>
