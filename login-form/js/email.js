
function validateNameInput(input) {
    const value = input.value.trim();
    return value.length >= 3 && value.length <= 100;
}

function validateEmailInput(input) {
    const value = input.value.trim();
    return value.length >= 10 && value.length <= 1000;
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


                const titleInput = form.querySelector('#titleInput');
                const textbody = form.querySelector('#text-body');

                let titleInputValid = validateNameInput(titleInput);
                let textbodyValid = validateEmailInput(textbody);


                if (!titleInputValid || !textbodyValid) {
                    event.preventDefault();
                    event.stopPropagation();

                    if (!titleInputValid) {
                        titleInput.classList.add('is-invalid');
                    } else {
                        titleInput.classList.remove('is-invalid');
                    }

                    if (!textbodyValid) {
                        textbody.classList.add('is-invalid');
                    } else {
                        textbody.classList.remove('is-invalid');
                    }


                }
            }
        }, false);

        form.addEventListener('click', () => {
            form.classList.remove('was-validated');
        });
    });
})();




