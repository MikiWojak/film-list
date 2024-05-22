const form = document.querySelector("form");
const usernameInput = form.querySelector('input[name="username"]');
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]');
const confirmedPasswordInput = form.querySelector('input[name="confirmedPassword"]');
const termsCheckbox = form.querySelector('input[name="terms"]');
const submitBtn = form.querySelector('button[type="submit"]');

const validation = {
    username: false,
    email: false,
    password: false,
    confirmedPassword: false,
    terms: false
}

submitBtn.disabled = true;

const isEmail = (email) => /\S+@\S+\.\S+/.test(email);

const arePasswordsSame = (password, confirmedPassword) => password === confirmedPassword;

const markValidation = (element, condition) =>
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');

const changeValidationStatus = (name, condition) => {
    validation[name] = condition;

    const isFormValid = Object.values(validation).every(value => value);

    submitBtn.disabled = !isFormValid;
}

const validateUsername = () => {
    setTimeout(
        () => {
            const value = usernameInput.value;

            const condition = value.trim().length > 0;

            markValidation(usernameInput, condition);
            changeValidationStatus('username', condition);
        },
        1000
    );
}

const validateEmail = () =>
    setTimeout(
        () => {
            const value = emailInput.value;

            const isNotEmpty = value.trim().length > 0;
            const isValidEmail =  isEmail(value);
            const condition = isNotEmpty && isValidEmail;

            markValidation(emailInput, condition);
            changeValidationStatus('email', condition);
        },
        1000
    );

const validatePassword = () => {
    setTimeout(
        () => {
            const value = passwordInput.value;

            const condition = value.trim().length > 0;

            markValidation(passwordInput, condition);
            changeValidationStatus('password', condition);
        },
        1000
    );
}

const validateConfirmedPassword = () =>
    setTimeout(() => {
            const value = confirmedPasswordInput.value;

            const isNotEmpty = value.trim().length > 0;
            const arePasswordsSameFlag = arePasswordsSame(
                passwordInput.value,
                value
            );
            const condition = isNotEmpty && arePasswordsSameFlag;

            markValidation(confirmedPasswordInput, condition);
            changeValidationStatus('confirmedPassword', condition);
        },
        1000
    );

const validateTerms = () => {
        const condition = termsCheckbox.checked;

        const element = form.querySelector('.checkbox-container');

        markValidation(element, condition);
        changeValidationStatus('terms', condition);
}


usernameInput.addEventListener('keyup', validateUsername);
emailInput.addEventListener('keyup', validateEmail);
passwordInput.addEventListener('keyup', validatePassword);
confirmedPasswordInput.addEventListener('keyup', validateConfirmedPassword);
termsCheckbox.addEventListener('change', validateTerms);
