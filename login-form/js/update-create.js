
function validateNameInput(input) {
    const value = input.value.trim();
    const hasNumbers = /\d/.test(value);
    return value.length >= 3 && !hasNumbers;
}

function hasLetters(input) {
    var regex = /[a-zA-Z]/; // Regular expression to match any letter
    return regex.test(input);
}

function validateImage(file) {
    const allowedExtensions = ['.png', '.jpeg'];
    const fileName = file.name;
    console.log(fileName);
    const fileExtension = fileName.substring(fileName.lastIndexOf('.')).toLowerCase();
    return allowedExtensions.includes(fileExtension);
}





(() => {
    'use strict';

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {


                const foodName = form.querySelector('#firstNameInput');
                const priceInput = form.querySelector('#lastNameInput');
                const uploadInput = form.querySelector('#uploadButton');

                let firstNameValid = validateNameInput(foodName);
                let lastNameValid = hasLetters(priceInput);
                let userNameValid = validateImage(uploadInput);

                if (!firstNameValid || !lastNameValid || !userNameValid) {
                    event.preventDefault();
                    event.stopPropagation();

                    if (!firstNameValid) {
                        foodName.classList.add('is-invalid');
                    } else {
                        foodName.classList.remove('is-invalid');
                    }

                    if (!lastNameValid) {
                        priceInput.classList.add('is-invalid');
                    } else {
                        priceInput.classList.remove('is-invalid');
                    }

                    if (!userNameValid) {
                        uploadInput.classList.add('is-invalid');
                    }
                    else {
                        uploadInput.classList.remove('is-invalid');
                    }
                }


            }
        }, false);

        form.addEventListener('click', () => {
            form.classList.remove('was-validated');
        });
    });
})();
