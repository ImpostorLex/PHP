function calculateAge() {
    var birthdate = new Date(document.getElementById('birthdateInput').value);
    var today = new Date();
    var age = today.getFullYear() - birthdate.getFullYear();

    if (today.getMonth() < birthdate.getMonth() || (today.getMonth() === birthdate.getMonth() && today.getDate() < birthdate.getDate())) {
        age--;
    }

    document.getElementById('ageInput').value = age;
}

// Custom validation for forms:


function validateNameInput(input) {
    const value = input.value.trim();
    const hasNumbers = /\d/.test(value);
    return value.length >= 3 && !hasNumbers;
}

function validateUser(input) {
    const user_value = input.value.trim();

    return user_value.length >= 3;
}

function validateAddress(input) {
    const address = input.value.trim();

    return address.length >= 5;
}

function validateDateInput(dateInput) {
    const datePattern = /^\d{4}-\d{2}-\d{2}$/;

    const dateValue = dateInput.trim();
    if (!datePattern.test(dateValue)) {
        // Invalid date format
        return false;
    }

    // Extract month, day, and year from the input value
    const [year, month, day] = dateValue.split('-');

    // Convert the month and day strings to numbers
    const monthNum = parseInt(month, 10);
    console.log(`Haha ${monthNum}`);
    const dayNum = parseInt(day, 10);
    const yearNum = parseInt(year, 10);

    console.log(`no ${dayNum}`);
    console.log(`yes ${yearNum}`);
    const currentYear = new Date().getFullYear();
    console.log(currentYear);
    // Validate year
    if (isNaN(yearNum) || yearNum < 1900 || yearNum > currentYear) {
        return false;
    }

    // Validate month
    if (isNaN(monthNum) || monthNum < 1 || monthNum > 12) {
        return false;
    }

    // Validate day
    const maxDay = new Date(yearNum, monthNum, 0).getDate();
    if (isNaN(dayNum) || dayNum < 1 || dayNum > maxDay) {
        return false;
    }

    // Date is valid
    return true;
}

function confirmPassword(input, input1) {

    return input === input1;
}

function passwordLength(input1, input2) {

    return input1.length > 5 && input2.length > 5;
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


                const firstNameInput = form.querySelector('#firstNameInput');
                const lastNameInput = form.querySelector('#lastNameInput');
                const userNameInput = form.querySelector('#userNameInput');
                const addressInput = form.querySelector('#addressInput');
                const birthdateInput = document.getElementById('birthdateInput');
                const birthdateValue = birthdateInput.value.trim();
                const passwordMatch = form.querySelector('#cPassword');
                const password = form.querySelector('#Password');

                let firstNameValid = validateNameInput(firstNameInput);
                let lastNameValid = validateNameInput(lastNameInput);
                let userNameValid = validateUser(userNameInput);
                let addressValid = validateAddress(addressInput);
                let dateValid = validateDateInput(birthdateValue);
                let ageInput = form.querySelector("#ageInput");
                let ageValue = ageInput.value;
                let age3 = parseInt(ageValue, 10);
                console.log(age3);
                let cPassword = confirmPassword(password.value, passwordMatch.value);
                let tPassword = passwordLength(password.value, passwordMatch.value);
                console.log(firstNameValid);
                console.log(lastNameValid);


                if (!tPassword || !cPassword || !dateValid || !firstNameValid || !lastNameValid || !userNameValid | !addressValid || age3 < 18) {
                    event.preventDefault();
                    event.stopPropagation();

                    if (!firstNameValid) {
                        firstNameInput.classList.add('is-invalid');
                    } else {
                        firstNameInput.classList.remove('is-invalid');
                    }

                    if (!lastNameValid) {
                        lastNameInput.classList.add('is-invalid');
                    } else {
                        lastNameInput.classList.remove('is-invalid');
                    }

                    if (!userNameValid) {
                        userNameInput.classList.add('is-invalid');
                    }
                    else {
                        userNameInput.classList.remove('is-invalid');
                    }

                    if (!addressValid) {
                        addressInput.classList.add('is-invalid');
                    }
                    else {
                        addressInput.classList.remove('is-invalid');
                    }

                    if (!dateValid) {
                        birthdateInput.classList.add('is-invalid');
                    }
                    else {
                        birthdateInput.classList.remove('is-invalid');
                    }

                    if (age3 < 18) {
                        ageInput.classList.add('is-invalid');
                    }
                    else {
                        ageInput.classList.remove('is-invalid');
                    }
                    if (!cPassword) {
                        passwordMatch.classList.add("is-invalid");
                    }
                    else {
                        passwordMatch.classList.remove('is-invalid');
                    }

                    if (!tPassword) {
                        password.classList.add("is-invalid");
                    }
                    else {
                        password.classList.remove('is-invalid');
                    }
                }


            }
        }, false);

        form.addEventListener('click', () => {
            form.classList.remove('was-validated');
        });
    });
})();




