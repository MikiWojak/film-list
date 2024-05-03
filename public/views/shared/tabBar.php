<div class="tab-bar">
    <a href="films" class="tab-bar__option">
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
    <a href="<?= isset($_SESSION['loggedUser']) ? "profile" : "login" ?>" class="tab-bar__option">
        <span class="material-symbols-outlined">
            <?= isset($_SESSION['loggedUser']) ? "account_circle" : "login" ?>
        </span>
    </a>
</div>
