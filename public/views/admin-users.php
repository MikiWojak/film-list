<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin - Users</title>

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
                    <h2>Users</h2>
                </div>

                <div class="list--mobile">
                    <?php foreach ($users as $user): ?>
                        <section class="list__item">
                            <p>Username:</p>
                            <p>
                                <b><?= $user->getUsername() ?></b>
                            </p>

                            <p>Email:</p>
                            <p>
                                <b><?= $user->getEmail() ?></b>
                            </p>

                            <p>Roles:</p>
                            <p>
                                <b><?= $user->getRoleNames() ?></b>
                            </p>

                            <p>Created At:</p>
                            <p>
                                <b><?= $user->getCreatedAt() ?></b>
                            </p>

                            <div class="list__item__bottom">
                                <a
                                    href="admindeleteuser/<?= $user->getId() ?>"
                                    class="btn--reset white_link"
                                >
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user->getUsername() ?></td>
                                    <td><?= $user->getEmail() ?></td>
                                    <td><?= $user->getRoleNames() ?></td>
                                    <td><?= $user->getCreatedAt() ?></td>
                                    <td>
                                        <a
                                            href="admindeleteuser/<?= $user->getId() ?>"
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
