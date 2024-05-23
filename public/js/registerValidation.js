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

const isEmail = (email) => /\S+@\S+\.\S+/.test(email);

const arePasswordsSame = (password, confirmedPassword) => password === confirmedPassword;

const markValidation = (element, condition) =>
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');

const changeValidationStatus = (name, condition) => {
    validation[name] = condition;

    checkIfFormValid();
}

const checkIfFormValid = () => {
    const isFormValid = Object.values(validation).every(value => value);

    submitBtn.disabled = !isFormValid;

    return isFormValid;
}

const validateUsernameOnInput = () => {
    setTimeout(
        validateUsername,
        1000
    );
}

const validateUsername = () => {
    const value = usernameInput.value;

    const condition = value.trim().length > 0;

    markValidation(usernameInput, condition);
    changeValidationStatus('username', condition);
}

const validateEmailOnInput = () =>
    setTimeout(
        validateEmail,
        1000
    );

const validateEmail = () => {
    const value = emailInput.value;

    const isNotEmpty = value.trim().length > 0;
    const isValidEmail =  isEmail(value);
    const condition = isNotEmpty && isValidEmail;

    markValidation(emailInput, condition);
    changeValidationStatus('email', condition);
}

const validatePasswordOnInput = () => {
    setTimeout(
        validatePassword,
        1000
    );
}

const validatePassword = () => {
    const value = passwordInput.value;

    const condition = value.trim().length > 0;

    markValidation(passwordInput, condition);
    changeValidationStatus('password', condition);
}

const validateConfirmedPasswordOnInput = () =>
    setTimeout(
        validateConfirmedPassword,
        1000
    );

const validateConfirmedPassword = () => {
    const value = confirmedPasswordInput.value;

    const isNotEmpty = value.trim().length > 0;
    const arePasswordsSameFlag = arePasswordsSame(
        passwordInput.value,
        value
    );
    const condition = isNotEmpty && arePasswordsSameFlag;

    markValidation(confirmedPasswordInput, condition);
    changeValidationStatus('confirmedPassword', condition);
}

const validateTerms = () => {
    const condition = termsCheckbox.checked;

    const element = form.querySelector('.checkbox-container');

    markValidation(element, condition);
    changeValidationStatus('terms', condition);
}

usernameInput.addEventListener('keyup', validateUsernameOnInput);
emailInput.addEventListener('keyup', validateEmailOnInput);
passwordInput.addEventListener('keyup', validatePasswordOnInput);
confirmedPasswordInput.addEventListener('keyup', validateConfirmedPasswordOnInput);
termsCheckbox.addEventListener('change', validateTerms);

submitBtn.addEventListener('click', (event) => {
    validateUsername();
    validateEmail();
    validatePassword();
    validateConfirmedPassword();
    validateTerms();

    const isFormValid = checkIfFormValid();

    if (!isFormValid) {
        event.preventDefault();
    }
})
