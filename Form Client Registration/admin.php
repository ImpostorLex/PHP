<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<!-- Include the php function for form validation if the form is submitted-->

<body>
    <div class="container-fluid d-flex justify-content-center">
        <div class="card text-center mx-auto" style="width: 50%; position: absolute; top:15%;">
            <div class="card-body">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" name="form_type" value="form1">
                    <div class="mb-3">
                        <h1 class="card-title">Select Action 1:</h1>
                        <input class="form-check-input" type="radio" name="action" value="delete">
                        <label class="form-check-label">Delete</label>
                        <input class="form-check-input" type="radio" name="action" value="search" checked>
                        <label class="form-check-label">Search</label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username:</label>
                        <input type="text" class="form-control" name="username_action1" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Action 1</button>
                </form>
                <br>
                <h1 class="card-title">Existing Users!</h1>
                <?php
                include 'client-registration.php';
                $username_session = $_SESSION['username'];
                $password_session = $_SESSION['password'];
                $error_msg = showUser($username_session, $password_session);
                ?>
                <div class="div">
                    <?php
                    if ($error_msg == false) {
                        echo "<br>" . $error_msg;
                    } else { ?>
                        <table class="table-bordered">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Name</th>
                                    <th>Sex</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($error_msg as $row): ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['first_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['last_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['username']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sex']; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $formType = $_POST['form_type'];
                    if ($formType == "form1") {
                        if ($_POST['action'] == "search") {
                            $username_search = $_POST['username_action1'];
                            $is_user_exists = searchUser($username_search);
                            ?>
                            <h1 class="card-title">Search Users!</h1>
                            <div class="div">
                                <?php if ($is_user_exists === false) {
                                    echo "<br> User does not exist.";
                                } else { ?>
                                    <table class="table-bordered">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>User Name</th>
                                                <th>Sex</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($is_user_exists as $row): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['first_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['last_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['username']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['sex']; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                            <?php
                        }
                    } else if ($_POST['action'] == "delete") {
                        $username_search = $_POST['username_action1'];
                        $is_user_exists = deleteUser($username_search);
                        ?>
                            <h1 class="card-title">Search Users!</h1>
                            <div class="div">
                            <?php if ($is_user_exists === false) {
                                $error_msg3 = "User does not exist.";
                            } else {
                                $error_msg3 = "Deletion successful";
                            } ?>
                            </div>
                            <?php
                    }
                }
                ?>
            </div>
        </div>
        <p style="colore:red;">
            <?php echo $error_msg3 ?>
        </p>
    </div>



    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>