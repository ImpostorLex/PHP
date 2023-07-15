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
                            <a href="" class="nav-link py-3 px-2 hovertext active" data-hover="Add Product" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                                <i class="fa-solid fa-plus fa-lg" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="nav-item pt-2 pb-2">
                            <a href="send_email.php" class="nav-link py-3 px-2 hovertext" data-hover="Create Email"
                                title="" data-bs-toggle="tooltip" data-bs-placement="right"
                                data-bs-original-title="Home">
                                <i class="fa-solid fa-envelope-open-text fa-lg" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="nav-item pt-2 pb-2">
                            <a href="search.php" class="nav-link py-3 px-2 hovertext" data-hover="Product" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                                <i class="fa-solid fa-magnifying-glass fa-lg" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="nav-item pt-2 pb-2">
                            <a href="email.php" class="nav-link py-3 px-2 hovertext" data-hover="Subscriber" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                                <i class="fa-solid fa-envelope fa-lg" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="nav-item pt-2 pb-2">
                            <a href="login.php" class="nav-link py-3 px-2 hovertext" data-hover="Sign-out" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Sign-out">
                                <i class="fa-solid fa-right-from-bracket fa-lg" style="color:white;"></i>
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
                            <h3 class="card-title text-center">Add Food Form</h3>
                            <form id="registrationForm" enctype="multipart/form-data" class="needs-validation"
                                method="POST" action="backend.php">
                                <div class="row">
                                    <input type="hidden" name="formIdentifier" value="form3">

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="firstNameInput" class="form-label">Food Name</label>
                                            <input type="text" class="form-control custom-name" name="firstNameInput"
                                                id="firstNameInput" required>
                                            <div class="invalid-feedback">
                                                Food name should have at least 3 characters and no numbers.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="lastNameInput" class="form-label"> Price</label>
                                            <input type="number" class="form-control custom-name" name="lastNameInput"
                                                id="lastNameInput" required>
                                            <div class="invalid-feedback">
                                                Price should be letters only
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <select class="form-select" id="category" name="category"
                                    aria-label="Default select example">
                                    <option selected value="On the stick food">On the stick food</option>
                                    <option value="Drinks">Drinks</option>
                                    <option value="Food">Food</option>
                                </select>

                                <div class="mb-3">
                                    <label for="uploadButton" class="form-label">Image</label>
                                    <input required type="file" class="form-control" name="uploadButton"
                                        id="uploadButton">
                                    <div class="invalid-feedback">
                                        Image only (.png, .jpeg, .jpg)
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Product creation is successful.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Failure Modal -->
    <div class="modal fade" id="failureModal" tabindex="-1" role="dialog" aria-labelledby="failureModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="failureModalLabel">Failure</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Failed to insert the product.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    <?php
    if (isset($_GET['message'])) {
        $msg = $_GET['message'];
        if ($msg == 'True') {
            echo "<script type='text/javascript'>
            $(document).ready(function(){
$('#successModal').modal('show');
});
            </script>";
        } else if ($msg == 'Failed to insert the product.' || $msg == 'Something went wrong!') {
            echo "<script type='text/javascript'>
            $(document).ready(function(){
$('#failureModal').modal('show');
});
            </script>";
        }
    }
    ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
    <script src="js/update-create.js"></script>
</body>


</html>