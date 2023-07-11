<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/b5d820a994.js" crossorigin="anonymous"></script>
</head>


<body>

    <div class="container-fluid" id="wrapper">
        <div class="row">
            <div class="col-lg-auto col-md-auto sticky-top" style="background-color: #f55052;">
                <div class="d-flex flex-column align-items-center justify-content-center h-100">
                    <ul
                        class="nav nav-pills nav-flush pt-5 flex-column mb-auto text-center justify-content-center w-100 px-3 align-items-center">
                        <li class="nav-item pt-2 pb-2">
                            <a href="" class="nav-link py-3 px-2 hovertext" data-hover="Create" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                                <i class="fa-solid fa-plus" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="nav-item pt-2 pb-2">
                            <a href="" class="nav-link py-3 px-2 hovertext active" data-hover="Update" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                                <i class="fa-solid fa-sharp fa-pen" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="nav-item pt-2 pb-2">
                            <a href="" class="nav-link py-3 px-2 hovertext" data-hover="Recipes" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                                <i class="fa-solid fa-envelope" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="nav-item pt-2 pb-2">
                            <a href="{{ url_for('logout') }}" class="nav-link py-3 px-2 hovertext" data-hover="Sign-out"
                                title="" data-bs-toggle="tooltip" data-bs-placement="right"
                                data-bs-original-title="Sign-out">
                                <i class="fa-solid fa-right-from-bracket" style="color:white;"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Card content below -->
            <div class="col-lg-9 col-md-9 p-3 min-vh-100">
                <div class="d-flex justify-content-evenly align-items-center" style="height: 100vh;">
                    <div class="card card-2 custom-card w-50">
                        <div class="card-body">
                            <h3 class="card-title text-center">Update Food Form</h3>
                            <form id="registrationForm" class="needs-validation" method="POST" action="backend.php">
                                <div class="row">
                                    <input type="hidden" name="formIdentifier" value="form4">

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="firstNameInput" class="form-label">Food Name</label>
                                            <input type="text" class="form-control custom-name" name="firstNameInput"
                                                id="firstNameInput" required>
                                            <div class="invalid-feedback">
                                                First name should have at least 3 characters and no numbers.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="lastNameInput" class="form-label"> Price</label>
                                            <input type="number" class="form-control custom-name" name="lastNameInput"
                                                id="lastNameInput" required>
                                            <div class="invalid-feedback">
                                                Last name should have at least 3 characters and no numbers.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="uploadButton" class="form-label">Image</label>
                                    <input type="file" class="form-control" name="uploadButton" id="uploadButton">
                                    <div class="invalid-feedback">
                                        Username must be atleast 3 characters long.
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>



                        </div>
                    </div>
                </div>
            </div>





            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
                crossorigin="anonymous"></script>
            <script src="js/update-create.js"></script>
</body>


</html>