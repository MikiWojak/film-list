<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Error</title>

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
    <link rel="stylesheet" type="text/css" href="public/css/auth.css" />
</head>
<body class="flex-row-center-center">
    <div class="flex-column-center-center">
        <h1 class="text--center">
            <?= isset($errorMessage) ? $errorMessage : 'Something went wrong...' ?>
        </h1>

        <div>
            <a href="/" class="btn--reset btn btn--purple">
                Return to homepage
            </a>
        </div>
    </div>
</body>
</html>
