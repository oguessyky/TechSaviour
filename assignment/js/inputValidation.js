let isEmpty = inputValue => inputValue.trim() == "";

var userList = [];

function userExists(username) {
    for (user of userList) {
        if (user[0] == username) {
            return true;
        }
    }
    return false;
}

function checkPassword(username,password) {
    for (user of userList) {
        if (user[0] == username) {
            return user[1] == password;
        }
    }
    return false;
}

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
        return true;
    } else {
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