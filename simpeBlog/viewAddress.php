<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Registration Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b5d820a994.js" crossorigin="anonymous"></script>

</head>

<!-- Include the php function for form validation if the form is submitted-->

<body>

    <div class="container">
        <header class="d-flex bg-dark flex-wrap justify-content-center py-3 mb-4 border-bottom navbar">
            <a href="dashboard.html"
                class="d-flex text-white align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none navbar-brand">
                <span class="fs-4">Student blog</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="viewpost.php" class="nav-link" aria-current="page">Posts</a></li>
                <li class="nav-item"><a href="dashboard.html" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="secret.php" class="nav-link">Users</a></li>
                <li class="nav-item"><a href="create_post.php" class="nav-link">Create</a></li>
                <li class="nav-item"><a href="index.php" class="nav-link">Logout</a></li>
            </ul>
        </header>
    </div>

    <div class="container-fluid d-flex justify-content-center">
        <div class="card text-center mx-auto" style="width: 50%; position: absolute; top:15%;">
            <div class="card-body">
                <br>
                <h1 class="card-title">Existing Address!</h1>
                <br>
                <?php
                include 'server.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {


                    if (isset($_POST['form_identifier'])) {
                        $formIdentifier = $_POST['form_identifier'];

                        if ($formIdentifier === 'form1') {
                            $result5 = isAddressExist($_POST['addr']);
                        } elseif ($formIdentifier === 'form2') {
                            $result5 = updateAddress($_POST['address_id'], $_POST['addr']);
                        }
                    }

                }

                $error_msg = showAddresses();
                ?>
                <div class="table-responsive">
                    <?php
                    if ($error_msg == false) {
                        echo "<br>" . $error_msg;
                    } else { ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Address</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($error_msg as $row): ?>
                                    <tr>
                                        <td id="pID">
                                            <?php echo $row["id"]; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['address']; ?>
                                        </td>
                                        <td>
                                            <a href="#" data-address="<?php echo $row['id']; ?>" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal2">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>

                                        </td>
                                        <td>
                                            <a href="server.php?action=deleteAdd&id=<?php echo $row['id']; ?>"
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
                    } elseif (isset($_GET['del'])) {
                        echo $_GET['del'];
                    }
                    ?>
                </p>
                <a href="adduser.php" style="text-decoration: none;">Add More User</a> |
                <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration:none;">Add
                    Address</a>

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

    <!-- Add address modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Address</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <input type="hidden" name="form_identifier" value="form1">
                        <div class="mb-3">
                            <label for="addr" class="form-label">Address</label>
                            <input type="text" class="form-control" id="addr" name="addr" required
                                placeholder="Earth 2.0">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Address ID: <span
                            id="modal-address"></span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <input type="hidden" name="form_identifier" value="form2">
                        <input type="hidden" name="address_id" id="modal-address-input">
                        <div class="mb-3">
                            <label for="addr" class="form-label">Address</label>
                            <input type="text" class="form-control" id="addr" name="addr" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid my-1 fixed-bottom">

        <footer class="bg-dark text-center text-white rounded">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: Social media -->
                <section class="mb-4">
                    <!-- Facebook -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                            class="fab fa-facebook-f"></i></a>

                    <!-- Twitter -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                            class="fab fa-twitter"></i></a>

                    <!-- Google -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                            class="fab fa-google"></i></a>

                    <!-- Instagram -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                            class="fab fa-instagram"></i></a>

                    <!-- Linkedin -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                            class="fab fa-linkedin-in"></i></a>

                    <!-- Github -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                            class="fab fa-github"></i></a>
                </section>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2023 Copyright:
                <a class="text-white" href="">Alex Macenas</a>
            </div>
        </footer>

    </div>

    <script>
        var result5 = "<?php echo isset($result5) ? $result5 : ''; ?>";
        if (result5) {
            alert(result5);
            result5 = '';
        }
    </script>

    <!-- Get address to be updated script-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('exampleModal2');
            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const address = button.getAttribute('data-address');
                const modalAddress = document.getElementById('modal-address');
                const modalInput = document.getElementById('modal-address-input');
                modalAddress.textContent = address;
                modalInput.value = address;
            });
        });
    </script>





    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>