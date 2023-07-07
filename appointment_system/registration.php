<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <div class="d-flex justify-content-evenly align-items-center" style="height: 100vh;">
        <div class="card custom-card w-50">
            <div class="card-body">
                <h3 class="card-title text-center">Register</h3>
                <form id="registrationForm" class="needs-validation" novalidate method="POST" action="backend.php">
                    <div class="row">
                        <input type="hidden" name="formIdentifier" value="form1">

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="firstNameInput" class="form-label">First Name</label>
                                <input type="text" class="form-control custom-name" name="firstNameInput"
                                    id="firstNameInput" required>
                                <div class="invalid-feedback">
                                    First name should have at least 3 characters and no numbers.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="lastNameInput" class="form-label">Last Name</label>
                                <input type="text" class="form-control custom-name" name="lastNameInput"
                                    id="lastNameInput" required>
                                <div class="invalid-feedback">
                                    Last name should have at least 3 characters and no numbers.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="userNameInput" class="form-label">Username</label>
                        <input type="text" class="form-control" name="userNameInput" id="userNameInput">
                        <div class="invalid-feedback">
                            Username must be atleast 3 characters long.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="addressInput" class="form-label">Address</label>
                        <input type="text" class="form-control" name="addressInput" id="addressInput">
                        <div class="invalid-feedback">
                            Address must be atleast 5 characters long.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="emailInput" class="form-label">Email</label>
                        <input type="email" class="form-control" name="emailInput" id="emailInput">
                        <div class="invalid-feedback">
                            Address must be atleast 5 characters long.
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="birthdateInput" class="form-label">Birthdate</label>
                                <input type="date" class="form-control" id="birthdateInput" name="birthdateInput"
                                    onchange="calculateAge()">
                                <div class="invalid-feedback">
                                    Birthdate is inccorrect please try again.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="ageInput" class="form-label">Age</label>
                                <input type="text" class="form-control" id="ageInput" name="ageInput" readonly>
                                <div class="invalid-feedback">
                                    Age cannot be negative number
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="Password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="Password" id="Password">
                                <div class="invalid-feedback">
                                    Password length must be greater than 5
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="cPassword" class="form-label">Confirm password</label>
                                <input type="password" class="form-control" name="cPassword" id="cPassword">
                                <div class="invalid-feedback">
                                    Password must match!
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <a style="text-decoration:none" href="login.php">Already Registered?</a>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <?php
                $var = $_GET['message'];
                if (isset($var)) {
                    echo "<p style='color:red;' class='text-center'>$var</p>";
                }
                ?>


            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
</body>


</html>