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

        <script type="text/javascript" src="public/js/headerMenu.js" defer></script>
    </head>
    <body>
        <?php include_once __DIR__.'/shared/header.php' ?>

        <div class="admin-container">
            <?php include_once __DIR__.'/shared/admin/sidebar.php' ?>

             <main class="content">
                <div class="list__header">
                    <h2>Films</h2>

                    <a
                        href="admincreatefilm"
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
                    <?php foreach ($films as $film): ?>
                        <section class="list__item">
                            <p>Title:</p>
                            <p>
                                <b><?= $film->getTitle() ?></b>
                            </p>

                            <p>Avg Rate:</p>
                            <p>
                                <b><?= $film->getAvgRate() ?></b>
                            </p>

                            <p>Created At:</p>
                            <p>
                                <b><?= $film->getCreatedAt() ?></b>
                            </p>

                            <div class="list__item__bottom">
                                <a
                                    href="admindeletefilm/<?= $film->getId() ?>"
                                    class="btn--reset white_link">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </a>
                            </div>
                        </section>
                    <?php endforeach; ?>
                </div>

                <div class="table--desktop">
                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Avg Rate</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($films as $film): ?>
                                <tr>
                                    <td><?= $film->getTitle() ?></td>
                                    <td><?= $film->getAvgRate() ?></td>
                                    <td><?= $film->getCreatedAt() ?></td>
                                    <td>
                                        <a
                                            href="admindeletefilm/<?= $film->getId() ?>"
                                            class="btn--reset white_link"
                                        >
                                            <span class="material-symbols-outlined">
                                                delete
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>

        <?php include_once __DIR__.'/shared/tabBar.php' ?>
    </body>
</html>
