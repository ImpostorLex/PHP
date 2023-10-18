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
<?php
include 'server.php';

$addresses = getAddress() ?? "No address created yet";

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
        $return_val = processRegistrationForm($fName, $lName, $sex, $uName, $password, $confirmPassword);

        $errormsg = "<p style='color:red;'>$return_val</p>";

    } else {
        $errormsg = "<p style='color:red;'>Please enter a value and do not include any whitespace</p>";
    }
}
?>

<body>
    <div class="container-fluid d-flex justify-content-center">
        <div class="card text-center mx-auto" style="width: 50%; position: absolute; top:15%;">
            <a href="secret.php" class="text-start pt-3 ps-4" style="text-decoration:none;">Go Back</a>
            <div class=" card-body">
                <h1 class="card-title">Create</h1>
                <p>Adding users as <strong>user</strong>
                    <?php if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        echo "$username!";
                    }
                    ?>
                </p>

                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="mb-3">
                        <select id="sex" class="form-select" aria-label="Default select example" name="sex">
                            <?php
                            foreach ($addresses as $address) {
                                echo "<option value='$address'>$address</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="Username" name="Username" required>
                    </div>
                    <div class="mb-3">
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
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>