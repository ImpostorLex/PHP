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
                            <a href="create.php" class="nav-link py-3 px-2 hovertext" data-hover="Create" title=""
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
                            <a href="" class="nav-link py-3 px-2 hovertext" data-hover="Search" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                                <i class="fa-solid fa-magnifying-glass" style="color:white;"></i>
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

            <div class="col-lg-9 col-md-9 p-3 min-vh-100 mx-auto table-responsive-sm"
                style="height: 50px; overflow: auto;">

                <h1 class="text-center" style="color:#f55052;">Update / Delete Form</h1>
                <br>
                <form method="POST" action="">
                    <input type="hidden" name="formIdentifier" value="form5">

                    <div class="input-group mb-3">
                        <input type="text" class="form-control input-text" placeholder="Manipulate Product"
                            aria-describedby="basic-addon2" id="search_term" name="search_term">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-warning btn-lg"><i
                                    class="fa fa-pen"></i></button>

                        </div>
                        &nbsp;
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-danger btn-lg"><i
                                    class="fa fa-trash"></i></button>

                        </div>
                    </div>
                </form>



                <table class="table table-hover ingredient-table text-center">
                    <thead class="table-dark sticky-top">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>

                    <tbody>


                        <tr>
                            <th scope="row">{{ loop.index0 + 1}}</th>
                            <td>{{ i.name }}</td>
                            <td>{{ round(i.quantity,2) }}</td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="js/admin.js"></script>
</body>


</html>