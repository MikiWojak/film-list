<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin - Directors</title>

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
                    <h2>Directors</h2>
                </div>

                <div class="list--mobile">
                    <?php foreach ($directors as $director): ?>
                        <section class="list__item">
                            <p>First Name:</p>
                            <p>
                                <b><?= $director->getFirstName() ?></b>
                            </p>

                            <p>Last Name:</p>
                            <p>
                                <b><?= $director->getLastName() ?></b>
                            </p>
                        </section>
                    <?php endforeach; ?>
                </div>

                <div class="table--desktop">
                    <table>
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($directors as $director): ?>
                            <tr>
                                <td><?= $director->getFirstName() ?></td>
                                <td><?= $director->getLastName() ?></td>
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
