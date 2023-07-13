<?php
$servername = "localhost";
$username = "root";
$password_db = "";
$db = "clinic_db";

$mysqli = new mysqli($servername, $username, $password_db, $db);

if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);

} else {
    $sql = "SELECT * from product";
    $result = $mysqli->query($sql);

    $usernames = array(); // Array to store usernames

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        $stat_msg = "no_product";
    }

    $mysqli->close();
}
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
                <?php
                if (isset($stat_msg) && $stat_msg === 'no_product') {

                    echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>No product</strong> found in the database nothing to show for table
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        ';
                } elseif (isset($_GET['st_message']) && $_GET['st_message'] === "User_e") {
                    echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ID inputted</strong> does not match any product
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                } elseif (isset($_GET['st_message']) && $_GET['st_message'] === "not_digit") {
                    echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Inputted value</strong> is not a number.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                } elseif (isset($_GET['st_message']) && $_GET['st_message'] === "product_s") {
                    echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Deletion</strong> of record is successful.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                } elseif (isset($_GET['st_message']) && $_GET['st_message'] === "product_f") {
                    echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Deletion</strong> of record is unsuccessful, it is most likey <strong>product id</strong> given does not exists
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                }
                ?>

                <form method="POST" action="backend.php" class="needs-validation">
                    <input type="hidden" name="formIdentifier" value="form5">

                    <div class="input-group mb-3">
                        <input type="number" class="form-control input-text" placeholder="Manipulate Product"
                            id="search_term" name="search_term" required>
                        <div class="input-group-append">
                            <button name="updateButton" value="update" type="submit"
                                class="btn btn-outline-warning btn-lg hovertext" data-hover="Update">
                                <i class="fa fa-pen"></i>
                            </button>
                        </div>
                        &nbsp;
                        <div class="input-group-append">
                            <button name="deleteButton" value="delete" class="btn btn-outline-danger btn-lg hovertext"
                                data-hover="Delete" type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </form>



                <br>


                <table class="table table-hover ingredient-table text-center">
                    <thead class="table-dark sticky-top">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Image</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (isset($products) && is_array($products) && count($products) > 0) {
                            foreach ($products as $product) { ?>
                                <tr>
                                    <td>
                                        <?php echo $product['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $product['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $product['price']; ?>
                                    </td>
                                    <td>
                                        <?php echo $product['category']; ?>
                                    </td>
                                    <td><img style="width:200px;" src="upload-files/<?php echo $product['image_path']; ?>"
                                            alt="Product Image"></td>
                                </tr>
                            <?php }
                        } else { ?>
                        <tr>
                            <td colspan="6">No products found.</td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="js/search.js"></script>
</body>


</html>