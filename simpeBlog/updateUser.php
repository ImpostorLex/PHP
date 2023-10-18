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
<?php
include 'server.php';

$addresses = getAddress() ?? "No address created yet";

$id = $_GET['id'];
$first_name = $_GET['first_name'];
$last_name = $_GET['last_name'];
$username2 = $_GET['username'];
$sex = $_GET['sex'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $has_error = true;

    // Loop through each element in the $_POST array
    foreach ($_POST as $key => $value) {
        // Check if the current field is not set
        if (!isset($_POST[$key]) && str_replace(" ", '', $_POST[$key] == "")) {
            $has_error = false;
            break; // Exit the loop if any field is not set
        }
    }

    if ($has_error) {
        $fName = $_POST['firstName'];
        $lName = $_POST['lastName'];
        $sex = $_POST['sex'];
        $uName = $_POST['Username'];
        $password = $_POST['Password'];
        $confirmPassword = $_POST['confirmPassword'];
        $return_val = updateRecord($id, $fName, $lName, $sex, $uName, $password, $confirmPassword);

        $errormsg = "<p style='color:red;'>$return_val</p>";

    } else {
        $errormsg = "<p style='color:red;'>Please enter a value and do not include any whitespace</p>";
    }
}

?>

<body>

    <div class="displayContainer centerPseudo">
        <div class="card text-center centerPseudo mx-auto" style="width: 50%">
            <a href="secret.php" class="text-start pt-3 ps-4" style="text-decoration:none;">Go Back</a>
            <div class=" card-body">
                <h1 class="card-title">Update</h1>

                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required
                            value="<?php echo $first_name; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required
                            value="<?php echo $last_name; ?>">
                    </div>
                    <label for="sex" class="form-label">Address</label>
                    <select id="sex" class="form-select" aria-label="Sex" name="sex">
                        <?php
                        foreach ($addresses as $address) {
                            echo "<option value='$address'>$address</option>";
                        }
                        ?>
                    </select>
                    <div class="mb-3">
                        <label for="Username" class="form-label">Student Number</label>
                        <input type="text" class="form-control" id="Username" name="Username" required
                            value="<?php echo $username2; ?>">
                    </div>
                    <div class=" mb-3">
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="Password" name="Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="Password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                            required>
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

        <div class="container-fluid mt-5">

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
    </div>











    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>