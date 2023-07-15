<?php

?>

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


    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #f55052;">
        <div class="container">
            <a class="navbar-brand" href="#" style="color:white;">KantoFoods</a>
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item pt-2 pb-2">
                        <a href="create.php" class="nav-link py-3 px-2 hovertext" data-hover="Add Product" title=""
                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
                            <i class="fa-solid fa-plus fa-lg" style="color:white;"></i>
                        </a>
                    </li>
                    <li class="nav-item pt-2 pb-2">
                        <a href="send_email.php" class="nav-link py-3 px-2 hovertext" data-hover="Create Email" title=""
                            data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Home">
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
    </nav>

    <div class="d-flex justify-content-evenly align-items-center" style="height: 100vh;">
        <div class="card card-2 custom-card w-50">
            <div class="card-body">
                <h3 class="card-title text-center">Create Newsletter</h3>
                <form id="registrationForm" class="needs-validation" method="POST" action="backend.php">
                    <div class="row">
                        <input type="hidden" name="formIdentifier" value="form9">

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="titleInput" class="form-label">Title</label>
                                <input type="text" class="form-control custom-name" name="titleInput" id="titleInput"
                                    required>
                                <div class="invalid-feedback">
                                    Title should have at least 3 characters and must not be greater than 100
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="lastNameInput" class="form-label">Sender</label>
                                <input type="email" class="form-control custom-name" name="lastNameInput"
                                    id="lastNameInput" required value="navarrojr.dennis@ue.edu.ph" readonly>
                                <div class="invalid-feedback">
                                    Email should contain @ and the domain and must be at least three characters long.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="text-body" class="form-label">Message</label>
                        <textarea class="form-control" name="text-body" id="text-body" style="width: 100%;"
                            rows="4"></textarea>
                        <div class="invalid-feedback">
                            Message must be atleast 10 characters long and must not be greater than 1000
                        </div>
                    </div>
                    <div class="mb-3">
                        <a style="text-decoration:none" href="email.php">Verify subscribers</a>
                    </div>

                    <button type="submit" class="btn btn-primary">Send to all Subscriber</button>
                </form>

                <?php
                if (isset($_GET['st_message']) && $_GET['st_message'] == "e_f") {
                    $var = "It looks like we dont have any subscriber yet";
                    echo "<p style='color:red;' class='text-center'>$var</p>";
                } elseif (isset($_GET['st_message']) && $_GET['st_message'] == "e_s") {
                    $var = "Email sent succesfully!";
                    echo "<p style='color:green;' class='text-center'>$var</p>";
                } elseif (isset($_GET['st_message']) && $_GET['st_message'] == "e_fs") {
                    $var = "Email sending failed!";
                    echo "<p style='color:yellow;' class='text-center'>$var</p>";
                } elseif (isset($_GET['st_message']) && $_GET['st_message'] == "e_ue") {
                    $var = "Email sending failed unknown error.";
                    echo "<p style='color:red;' class='text-center'>$var</p>";
                }
                ?>


            </div>
        </div>
    </div>


    <script src="js/email.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>