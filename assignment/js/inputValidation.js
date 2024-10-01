function validateInput(input) {
    const errorMessage = input.getAttribute('data-error');
    let errorElement = input.nextElementSibling;
    if (!errorElement || !errorElement.classList.contains('error-message')) {
        errorElement = document.createElement('span');
        errorElement.classList.add('error-message');
        input.parentNode.appendChild(errorElement);
    }

    if (input.validity.valid) {
        errorElement.style.display = 'none';
        input.parentNode.classList.remove('invalid');
        return true;
    } else {
        errorElement.textContent = errorMessage;
        errorElement.style.display = 'flex';
        input.parentNode.classList.add('invalid');
        return false;
    }
}

function validateAllInputs(form) {
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('input', function() {validateInput(input);});

        input.addEventListener('invalid', function(event) {
            event.preventDefault();
            validateInput(input);
        });
    });
    form.addEventListener('submit', function(event) {
        let isValid = true;
        inputs.forEach(input => {
            isValid = validateInput(input) ? isValid : false;
        });
        if (!isValid) {
            event.preventDefault();
        }
    });
}

function validateForm(form) {
    document.addEventListener('DOMContentLoaded', function() {
        validateAllInputs(form);
        switch (form.getAttribute("name")) {
            case "Register":
                const passwordInput = form.querySelector('input[name="password"]');
                const passwordConfirmInput = form.querySelector('input[name="password_confirm"]');

                passwordConfirmInput.addEventListener('input', validatePasswordMatch);

                function validatePasswordMatch() {
                    const errorElement = passwordConfirmInput.nextElementSibling;
                    if (passwordInput.value !== passwordConfirmInput.value) {
                        errorElement.textContent = "Passwords do not match.";
                        errorElement.style.display = 'flex';
                        passwordConfirmInput.parentNode.classList.add('invalid');
                        return false;
                    } else {
                        errorElement.style.display = 'none';
                        passwordConfirmInput.parentNode.classList.remove('invalid');
                        return true;
                    }
                }
                break;
        }
    });
}