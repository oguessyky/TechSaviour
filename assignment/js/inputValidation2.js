let isEmpty = inputValue => inputValue.trim() == "";

function validateInput(input, defaultErrorMsg, ...additionalConditionsAndErrorMessages) {
    input.setCustomValidity("");
    var validity = input.validity.valid;
    const errorMsgDisplay = input.nextElementSibling;
    var displayText = defaultErrorMsg;
    for (const [condition, errorMsg] of additionalConditionsAndErrorMessages) {
        if (condition(input.value)) {
            validity = false;
            displayText = errorMsg;
            break;
        }
    }
    if (validity) {
        /*
        errorMsgDisplay.classList.remove("invalid");
        errorMsgDisplay.style.display = 'none';
        */
        return true;
    } else {
        /*
        errorMsgDisplay.textContent = displayText;
        errorMsgDisplay.classList.add("invalid");
        errorMsgDisplay.style.display = 'flex';
        */
        input.setCustomValidity(displayText);
        return false;
    }
}

function validateForm(form,event) {
    var validity = true;
    const inputs = form.querySelectorAll('input');
    inputs.forEach(input => {
        validity &= input.oninput(event);
    });
    return validity;
}