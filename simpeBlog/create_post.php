<?php include 'server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $has_error = true;

    if (empty($_POST['title']) || trim($_POST['title']) === "") {
        $has_error = false;
    }

    if (empty($_POST['body']) || trim($_POST['body']) === "") {
        $has_error = false;
    }


    if ($has_error) {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $stid = $_SESSION['username'];
        $result_blog = processBlog($title, $body, $stid);
        $errormsg = "<p style='color:red;'>$result_blog</p>";
    } else {
        $errormsg = "<p style='color:red;'>Please enter a value and do not include any whitespace</p>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b5d820a994.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <header class="d-flex bg-dark flex-wrap justify-content-center py-3 border-bottom navbar">
            <a href="dashboard.html"
                class="d-flex text-white align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none navbar-brand">
                <span class="fs-4">Student blog</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="viewpost.php" class="nav-link" aria-current="page">Posts</a></li>
                <li class="nav-item"><a href="dashboard.html" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="secret.php" class="nav-link">Users</a></li>
                <li class="nav-item"><a href="create_post.php" class="nav-link active">Create</a></li>
                <li class="nav-item"><a href="index.php" class="nav-link">Logout</a></li>
            </ul>
        </header>
    </div>

    <div class="displayContainer centerPseudo">
        <div class="card text-center centerPseudo mx-auto" style="width: 50%">
            <div class=" card-body">
                <h1 class="card-title">Create Blog</h1>

                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="6" cols="50" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="Username" class="form-label">Student Number: </label>
                        <?php if (isset($_SESSION['username']))
                            echo $_SESSION['username']; ?>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <!-- Is used to make the .php file be able to differentiate what file is data coming from -->
                    <input type="hidden" name="source" value="registration">
                </form>

                <div class="div">
                    <?php
                    if (isset($errormsg)) {
                        echo "<br>" . $errormsg;
                    }
                    ?>
                </div>
                <br>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="container-fluid footer">

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

</body>

</html>