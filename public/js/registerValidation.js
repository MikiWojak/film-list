const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');

const isEmail = (email) => /\S+@\S+\.\S+/.test(email);

const arePasswordsSame = (password, confirmedPassword) => password === confirmedPassword;

const markValidation = (element, condition) =>
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');

const validateEmail = () =>
    setTimeout(
        () => markValidation(emailInput, isEmail(emailInput.value)),
        1000
    );

const validatePassword = () =>
    setTimeout(() => {
            const condition = arePasswordsSame(
                passwordInput.value,
                confirmedPasswordInput.value
            );

            markValidation(confirmedPasswordInput, condition)
        },
        1000
    );

emailInput.addEventListener('keyup', validateEmail);
confirmedPasswordInput.addEventListener('keyup', validatePassword);
