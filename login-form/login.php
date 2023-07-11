<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>

    <div class="d-flex justify-content-evenly align-items-center" style="height: 100vh;">
        <div class="card card-2 custom-card w-25">
            <div class="card-body">
                <h3 class="card-title text-center">Login</h3>
                <form id="loginForm" method="POST" action="backend.php">
                    <input type="hidden" name="formIdentifier" value="form2">

                    <div class="mb-3">
                        <label for="userName" class="form-label">Username</label>
                        <input type="text" class="form-control" name="userName" id="userName">
                        <div class="invalid-feedback">
                            Invalid credentials
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="Password" id="Password">
                    </div>

                    <div class="mb-3">
                        <a style="text-decoration:none" href="registration.php">Not registered yet?</a>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    $var = $_GET['message'];
    if (isset($var) && $var === "Success") {
        echo "
        <script>
            jQuery(document).ready(function() {
                jQuery('#successModal').modal('show');
            });
        </script>
    ";
    } else if (isset($var) && $var === "Failure") {

        echo "
        <script>
            jQuery(document).ready(function() {
                jQuery('#failureModal').modal('show');
            });
        </script>
    ";
    } else if (isset($var) && $var === "Invalid credentials please try again.") {
        echo "
    <script>
        jQuery(document).ready(function() {
            var userNameForm = jQuery('#userName');
            var passForm = jQuery('#Password');
            
            userNameForm.addClass('is-invalid');
            passForm.addClass('is-invalid');
        });
    </script>
";
    }
    ?>

    <!-- Show bootstrap modal if it is a success -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="successModalLabel">Success!</h5>
                </div>
                <div class="modal-body">
                    <p>Your registration was successful.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Show bootstrap modal if it is a failure -->
    <div class="modal fade" id="failureModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="failureLabel">Failure!</h5>
                </div>
                <div class="modal-body">
                    <p>Your registration was unsuccessful please try again later.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>