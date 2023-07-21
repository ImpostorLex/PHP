<?php
$servername = "localhost";
$username = "root";
$password_db = "NEW_PASSWORD";
$db = "clinic_db";

$mysqli = new mysqli($servername, $username, $password_db, $db);

if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
    $sql = "SELECT user_acc_fk FROM subscribed";
    $result = $mysqli->query($sql);

    $user_ids = array(); // Array to store user IDs

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_ids[] = $row['user_acc_fk'];
        }

        // Use placeholder for the IN clause based on the number of user IDs
        $placeholders = implode(',', array_fill(0, count($user_ids), '?'));

        $sql2 = "SELECT u.first_name, u.last_name, u.email, s.user_acc_fk FROM user AS u
                 INNER JOIN subscribed AS s ON u.user_id = s.user_acc_fk
                 WHERE u.user_id IN ($placeholders)";
        $stmt = $mysqli->prepare($sql2);

        // Bind the user IDs as parameters
        $stmt->bind_param(str_repeat('i', count($user_ids)), ...$user_ids);
        $stmt->execute();
        $result2 = $stmt->get_result();

        $emails = array();
        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $emails[] = $row2;
            }
        }
    } else {
        $stat_msg = "No emails";
    }

    $mysqli->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KantoFood</title>
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
                            <a href="send_email.php" class="nav-link py-3 px-2 hovertext" data-hover="Create Email"
                                title="" data-bs-toggle="tooltip" data-bs-placement="right"
                                data-bs-original-title="Dashboard">
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
                            <a href="" class="nav-link py-3 px-2 hovertext active" data-hover="Email" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Dashboard">
                                <i class="fa-solid fa-envelope" style="color:white;"></i>
                            </a>
                        </li>
                        <li class="nav-item pt-2 pb-2">
                            <a href="login.php" class="nav-link py-3 px-2 hovertext" data-hover="Sign-out" title=""
                                data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Sign-out">
                                <i class="fa-solid fa-right-from-bracket" style="color:white;"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9 col-md-9 p-3 min-vh-100 mx-auto table-responsive-sm"
                style="height: 50px; overflow: auto;">
                <h1 class="text-center" style="color:#f55052;">Newsletter subscribers</h1>
                <br>
                <?php
                if (isset($_GET['st_message']) && $_GET['st_message'] === "not_digit") {
                    echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>ID inputted</strong> is not a digit!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                } elseif (isset($_GET['st_message']) && $_GET['st_message'] === "e_s") {
                    echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Customer</strong> successfully remove from receiving newsletter
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                } elseif (isset($_GET['st_message']) && $_GET['st_message'] === "e_f") {
                    echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Error</strong> customer is not successfully remove from receiving newsletter
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                } elseif (isset($_GET['st_message']) && $_GET['st_message'] === "e_ss") {
                    echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Newsletter</strong> sent to all subscribers!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                }
                ?>
                <form method="POST" action="backend.php" class="needs-validation">
                    <input type="hidden" name="formIdentifier" value="form7">

                    <div class="input-group mb-3">
                        <input type="number" class="form-control input-text" placeholder="Unsuscribe user"
                            id="search_term" name="search_term" required>
                        <div class="input-group-append">
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
                            <th scope="col">First name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (isset($emails) && is_array($emails) && count($emails) > 0) {
                            foreach ($emails as $email) { ?>
                                <tr>
                                    <td>
                                        <?php echo $email['user_acc_fk']; ?>
                                    </td>
                                    <td>
                                        <?php echo $email['first_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $email['last_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $email['email']; ?>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                        <tr>
                            <td colspan="4">No subscribers found.</td>
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