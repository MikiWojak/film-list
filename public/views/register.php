<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Register</title>

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

        <script type="text/javascript" src="./public/js/registerValidation.js" defer></script>
    </head>
    <body class="flex-row-center-center">
        <div class="auth-container">
            <a href="/dashboard" class="logo">
                <span class="material-symbols-outlined logo__image">
                    movie
                </span>
                <h1 class="logo__text">Film Rate</h1>
            </a>

            <form
                action="register"
                method="POST"
                class="flex-column-center-center form"
            >
                <div class="form__input">
                    <label for="username">Username</label>
                    <input
                        id="username"
                        name="username"
                        placeholder="Username"
                        class="input__text"
                    />
                </div>

                <div class="form__input">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="hello@company.com"
                        class="input__text"
                    />
                </div>

                <div class="form__input">
                    <label for="password">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Password"
                        class="input__text"
                    />
                </div>

                <div class="form__input">
                    <label for="confirmedPassword">Confirm password</label>
                    <input
                        id="confirmedPassword"
                        name="confirmedPassword"
                        type="password"
                        placeholder="Confirm password"
                        class="input__text"
                    />
                </div>

                <div class="checkbox-container">
                    <label class="checkbox-label">I agree to terms and conditions
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <button type="submit" class="btn--reset btn btn--purple form__submit"> Register </button>

                <span class="form_redirect">
                    Already have an account? <a href="/login">Login</a>
                </span>
            </form>
        </div>
    </body>
</html>
