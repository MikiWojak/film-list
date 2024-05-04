<?php
    $roles = $_SESSION['loggedUser']->getRoles();
    $isAdmin = false;

    foreach ($roles as $role) {
        if ($role->getName() === 'admin') {
            $isAdmin = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Profile</title>

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
            <div class="content">
                <div class="content__inner--shrink profile">
                    <h2>Hello, <?= $_SESSION['loggedUser']->getUsername() ?></h2>

                    <?php
                        if($isAdmin) {
                            echo '
                                <a href="adminFilms" class="btn--reset btn btn--blue">
                                    <span>Admin Panel</span>
                                </a>
                            ';
                        }
                    ?>

                    <a href="logout" class="btn--reset btn btn--red">
                        <span>Logout</span>
                    </a>
                </div>  
            </div>
        </div>

        <?php include_once __DIR__.'/shared/tabBar.php' ?>
    </body>
</html>
