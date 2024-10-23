const laptopButton = document.querySelector('.laptopDatabase');
const userButton = document.querySelector('.userDatabase');
const feedbackButton = document.querySelector('.feedbackDatabase');
const searchBar = document.getElementById('searchBar');
const addIcon = document.getElementById('add');
const adminTable = document.getElementById('adminTable');

laptopButton.addEventListener('mouseover', () => {
    temporarilyRemoveActiveClass(laptopButton);
});
laptopButton.addEventListener('mouseout', () => {
    restoreActiveClass(laptopButton);
});
userButton.addEventListener('mouseover', () => {
    temporarilyRemoveActiveClass(userButton);
});
userButton.addEventListener('mouseout', () => {
    restoreActiveClass(userButton);
});
feedbackButton.addEventListener('mouseover', () => {
    temporarilyRemoveActiveClass(feedbackButton);
});
feedbackButton.addEventListener('mouseout', () => {
    restoreActiveClass(feedbackButton);
});

function handleButtonClick(clickedButton) {
    const buttons = [laptopButton, userButton, feedbackButton];
    const isActive = clickedButton.classList.contains('active');

    buttons.forEach(button => {
        button.classList.remove('active');
    });

    if (!isActive) {
        clickedButton.classList.add('active');
        searchBar.style.display = 'flex';
        addIcon.style.display = 'flex';
        adminTable.style.display = 'table';
    } else {
        searchBar.style.display = 'none';
        addIcon.style.display = 'none';
        adminTable.style.display = 'none';
    }
}

function temporarilyRemoveActiveClass(element) {
    const buttons = [laptopButton, userButton, feedbackButton];
    buttons.forEach(button => {
        if (button !== element && button.classList.contains('active')) {
            button.classList.add('temp-active');
            button.classList.remove('active');
        }
    });
}

function restoreActiveClass(element) {
    const buttons = [laptopButton, userButton, feedbackButton];
    buttons.forEach(button => {
        if (button !== element && button.classList.contains('temp-active')) {
            button.classList.add('active');
            button.classList.remove('temp-active');
        }
    });
}

deleteButtonClicked = false;
popUpTitle = document.getElementById('popUpTitle');
popUpMsg = document.getElementById('popUpMsg');

function showPopUp() {
    document.getElementById('popUp').style.display = 'flex';
    deleteButtonClicked = true;
}

function closePopUp() {
    document.getElementById('popUp').style.display = 'none';
    deleteButtonClicked = false;
}

submitButton = document.getElementById("id")

function prepareEdit(id) {
    submitButton.value = id;
    if (deleteButtonClicked) {
        popUpMsg.innerHTML = `Are you sure you want to delete ${id}?`;
    } else {
        submitButton.click();
    }
}

let isEmpty = inputValue => inputValue.trim() == "";

function checkEditType() {
    document.getElementById('data').value = document.querySelector('.adminButton button.active').value;
    checkSearchInput();
    if (deleteButtonClicked) {
        document.forms.edit.action = 'delete.php';
    }
}

function checkSearchInput() {
    document.getElementById("getData").value = document.querySelector('.adminButton button.active').value;
    document.getElementById("getSearchData").value = document.querySelector('.adminButton button.active').value;
    let search = document.getElementById("search");
    if (isEmpty(search.value)) {
        search.removeAttribute("name");
    }
}
