<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin - Films</title>

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
        <link rel="stylesheet" type="text/css" href="public/css/admin.css" />
    </head>
    <body>
        <?php include_once __DIR__.'/shared/header.php' ?>

        <div class="admin-container">
            <!-- <nav class="navbar"> -->
            <nav class="navbar navbar--enabled">
                <ul>
                    <li>
                        <a href="/admin-users">
                            <span class="material-symbols-outlined">
                                account_circle
                            </span>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="material-symbols-outlined">
                                movie
                            </span>
                            <span>Films</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="material-symbols-outlined">
                                label
                            </span>
                            <span>Tags</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="material-symbols-outlined">
                                person
                            </span>
                            <span>Directors</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- <main class="content"> -->
            <main class="content navbar--enabled">
                <div class="list__header">
                    <h2>Films</h2>

                    <a
                        href="/admin-films-createedit"
                        class="btn--reset flex-row-center-center btn btn--purple add-item-btn"
                    >
                        <span class="material-symbols-outlined">
                            add_circle
                        </span>
                        <span>
                            Add new film
                        </span>
                    </a>
                </div>

                <div class="list--mobile">
                    <section class="list__item">
                        <p>Title:</p>
                        <p><b>Saving Private Ryan</b></p>

                        <div class="list__item__bottom">
                            <a href="/admin-films-createedit" class="btn--reset white_link">
                                <span class="material-symbols-outlined">
                                    edit
                                </span>
                            </a>
                            <button class="btn--reset white_link">
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                        </div>
                    </section>

                    <section class="list__item">
                        <p>Title:</p>
                        <p><b>Howl's Moving Castle</b></p>

                        <div class="list__item__bottom">
                            <a href="/admin-films-createedit" class="btn--reset white_link">
                                <span class="material-symbols-outlined">
                                    edit
                                </span>
                            </a>
                            <button class="btn--reset white_link">
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                        </div>
                    </section>

                    <section class="list__item">
                        <p>Title:</p>
                        <p><b>Jesteś Bogiem<b></p>

                        <div class="list__item__bottom">
                            <a href="/admin-films-createedit" class="btn--reset white_link">
                                <span class="material-symbols-outlined">
                                    edit
                                </span>
                            </a>
                            <button class="btn--reset white_link">
                                <span class="material-symbols-outlined">
                                    delete
                                </span>
                            </button>
                        </div>
                    </section>
                </div>

                <div class="table--desktop">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Saving Private Ryan</td>
                                <td>
                                    <a href="/admin-films-createedit" class="btn--reset white_link">
                                        <span class="material-symbols-outlined">
                                            edit
                                        </span>
                                    </a>
                                    <button class="btn--reset white_link">
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Howl's Moving Castle</td>
                                <td>
                                    <a href="/admin-films-createedit" class="btn--reset white_link">
                                        <span class="material-symbols-outlined">
                                            edit
                                        </span>
                                    </a>
                                    <button class="btn--reset white_link">
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jesteś Bogiem</td>
                                <td>
                                    <a href="/admin-films-createedit" class="btn--reset white_link">
                                        <span class="material-symbols-outlined">
                                            edit
                                        </span>
                                    </a>
                                    <button class="btn--reset white_link">
                                        <span class="material-symbols-outlined">
                                            delete
                                        </span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
            <a href="/profile" class="tab-bar__option">
                <span class="material-symbols-outlined">
                    account_circle
                </span>
            </a>
        </div>
    </body>
</html>
