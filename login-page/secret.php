<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b5d820a994.js" crossorigin="anonymous"></script>

</head>

<!-- Include the php function for form validation if the form is submitted-->

<body>
    <div class="container-fluid d-flex justify-content-center">
        <div class="card text-center mx-auto" style="width: 50%; position: absolute; top:15%;">
            <div class="card-body">
                <br>
                <h1 class="card-title">Existing Users!</h1>
                <br>
                <?php
                include 'server.php';

                $error_msg = showUser();
                ?>
                <div class="table-responsive">
                    <?php
                    if ($error_msg == false) {
                        echo "<br>" . $error_msg;
                    } else { ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>User Name</th>
                                    <th>Sex</th>
                                    <th>Update</th>
                                    <th>Delete</th>
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
                                        <td>
                                            <a href="server.php?action=edit&id=<?php echo $row['id']; ?>">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="server.php?action=delete&id=<?php echo $row['id']; ?>"
                                                onclick="return confirmDelete();">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>



                <p style="color:red;">
                    <?php
                    if (isset($error_msg3)) {
                        echo $error_msg3;
                    } elseif (isset($_GET['edit'])) {
                        echo $_GET['edit'];
                    }
                    ?>
                </p>
                <a href="adduser.php" style="text-decoration: none;">Add More User</a>

            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            // Show a confirmation dialog to the user.
            var confirmed = window.confirm("Are you sure you want to delete this record?");

            // If the user confirms, proceed with the deletion.
            if (confirmed) {
                return true; // Continue with the link's href.
            } else {
                return false; // Cancel the link action.
            }
        }
    </script>



    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>