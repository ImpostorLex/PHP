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
                <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Posts</a></li>
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
                <h1 class="card-title">Existing Blogs!</h1>
                <br>
                <?php
                include 'server.php';

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    if (isset($_POST['selected_ids']) && !empty($_POST['selected_ids'])) {
                        $test = deleteBlog($_POST['selected_ids']);
                    } else {
                        $test = "No checkboxes checked.";
                    }
                }

                $error_msg = showBlogs();
                ?>
                <div class="table-responsive">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Student Number</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (is_array($error_msg)): ?>
                                    <?php foreach ($error_msg as $row): ?>
                                        <tr>
                                            <td>
                                                <!-- Add a checkbox input with the value being the record's ID -->
                                                <input type="checkbox" name="selected_ids[]" value="<?php echo $row['id']; ?>">
                                            </td>
                                            <td>
                                                <?php
                                                $title = $row['title'];
                                                echo (strlen($title) > 10) ? substr($title, 0, 10) . "..." : $title;
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $body = $row['body'];
                                                echo (strlen($body) > 20) ? substr($body, 0, 20) . "..." : $body;
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $row['st_id']; ?>
                                            </td>
                                            <td>
                                                <a href="server.php?action=editBlog&id=<?php echo $row['id']; ?>">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="server.php?action=deleteBlog&id=<?php echo $row['id']; ?>"
                                                    onclick="return confirmDelete();">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6">No blog found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="d-flex align-items-center mb-3">
                            <button type="submit" class="btn btn-danger me-4" name="delete_selected">Delete
                                Selected</button>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="selectall" name="selectall"
                                    autocomplete="off" onclick="selectAllCheckboxes()">
                                <label class="form-check-label" for="selectall">De/select All</label>
                            </div>
                        </div>
                    </form>
                </div>


                <p style="color:red;">
                    <?php
                    if (isset($error_msg3)) {
                        echo $error_msg3;
                    } elseif (isset($_GET['edit'])) {
                        echo $_GET['edit'];
                    } elseif (isset($test)) {
                        echo $test;
                    } elseif (isset($_GET['rBlogmsg'])) {
                        echo $_GET['rBlogmsg'];
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
            var confirmed = window.confirm("Are you sure you want to delete this record?");

            if (confirmed) {
                return true; // Continue with the link's href.
            } else {
                return false; // Cancel the link action.
            }
        }
    </script>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Address</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
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

    <script>
        var result5 = "<?php echo isset($result5) ? $result5 : ''; ?>";
        if (result5) {
            alert(result5);
            result5 = ''; // Clear the variable
        }
    </script>


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

    <!-- Checkbox de/select all function -->
    <script>
        function selectAllCheckboxes() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = !checkbox.checked;
            });
        }
    </script>



    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>