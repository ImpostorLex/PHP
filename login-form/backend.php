<?php
$servername = "localhost";
$username = "root";
$password_db = "";
$db = "clinic_db";


session_start();

function getAllUser()
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "SELECT username from user_acc";
        $result = $mysqli->query($sql);

        $usernames = array(); // Array to store usernames

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $usernames[] = $row['username']; // Add each username to the array
            }
        }

        $mysqli->close();

        return $usernames;
    }
}

function getEmails()
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "SELECT email from user";
        $result = $mysqli->query($sql);

        $emails = array(); // Array to store emails

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $emails[] = $row['email']; // Add each email to the array
            }
        }

        $mysqli->close();

        return $emails;
    }
}

function processRegistrationForm($firstName, $lastName, $username_to_be_registered, $address, $birthdate, $age, $password2, $email)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "INSERT INTO user_acc (id, username, password, is_admin) VALUES (?, ?, ?, ?)";

        $stmt = $mysqli->prepare($sql);

        $id = 0;
        $is_admin = 0;
        $stmt->bind_param("issi", $id, $username_to_be_registered, $password2, $is_admin);
        $stmt->execute();

        if ($stmt->error) {
            echo "Error executing user_acc query: " . $stmt->error;
            $stmt->close();
            $mysqli->close();
            return;
        }

        $stmt->close();

        // Get the id of the newly added user.
        $sql2 = "SELECT id FROM user_acc WHERE username = ? LIMIT 1";

        $stmt2 = $mysqli->prepare($sql2);
        $stmt2->bind_param("s", $username_to_be_registered);
        $stmt2->execute();
        $stmt2->bind_result($sql_user_id);

        if ($stmt2->fetch()) {
            $stmt2->close();

            $sql3 = "INSERT INTO user (id, first_name, last_name, address, email, birthdate, age, user_id) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
            $stmt3 = $mysqli->prepare($sql3);
            $stmt3->bind_param("ssssssi", $firstName, $lastName, $address, $email, $birthdate, $age, $sql_user_id);
            $stmt3->execute();

            if ($stmt3->error) {
                echo "Error executing user query: " . $stmt3->error;
                $stmt3->close();
                $mysqli->close();
                return "Error";
            }

            $stmt3->close();
        } else {
            echo "No matching user found.";
            $stmt2->close();
            $mysqli->close();
            return "Error";
        }

        $mysqli->close();
        return "Success";
    }
}

function credsMatch($username_form, $password_form)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "SELECT COUNT(*) AS count, is_admin from user_acc where username = ? and password = ?";

        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("ss", $username_form, $password_form);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
            $is_admin = $row['is_admin'];

            if ($count > 0) {

                if ($is_admin == 0) {
                    // Change home.php to whatever the homepage after succesful login
                    header("Location: home.php");
                    exit;
                } else {
                    // Change home.php to whatever the homepage after succesful login
                    header("Location: search.php");
                    exit;
                }

            } else {
                $status_msg = "Invalid credentials please try again.";
                header("Location: login.php?message=" . urlencode($status_msg));
                exit;

            }
        } else {
            $status_msg = "Something unexpected happen please try again.";
            header("Location: login.php?message=" . urlencode($status_msg));
            exit;
        }


    }
}

function isProductExists($name)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        $sql = "SELECT name FROM product WHERE name = ?";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $name);

        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            // If there is a result, it means the product already exists
            if ($result->num_rows > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            // Execution failed
            $status_msg = "Failed to check if the product exists.";
            header("Location: error.php?message=" . urlencode($status_msg));
            exit;
        }
    }
}

function addProduct($name, $price, $category, $image_name, $image_tmp_path)
{
    $destination = "upload-files/" . $image_name;

    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {

        // Before executing the insert check if product exists
        $result = isProductExists($name);
        if (!$result) {
            $sql = "INSERT INTO product (id, name, price, category, image_path) VALUES (?, ?, ?, ?, ?)";

            $stmt = $mysqli->prepare($sql);
            $id = 0;
            $stmt->bind_param("isiss", $id, $name, $price, $category, $image_name);

            // Execute the statement and check if it was successful
            if ($stmt->execute()) {
                // Move the file as well.
                move_uploaded_file($image_tmp_path, $destination);

                $status_msg = "True";
                header("Location: create.php?message=" . urlencode($status_msg));
                exit;

            } else {
                // Insertion failed
                $status_msg = "Failed to insert the product.";
                header("Location: create.php?message=" . urlencode($status_msg));
                exit;
            }

        } else {
            $status_msg = "Something went wrong!";
            header("Location: create.php?message=" . urlencode($status_msg));
            exit;
        }

    }
}
function updateProduct($name, $price, $category, $image_name, $image_tmp_path)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        // Get the product ID from the URL or another source
        if (isset($_COOKIE['foodName'])) {
            $foodName = $_COOKIE['foodName'];
        }

        // Check if the product name already exists
        $sql = "SELECT * FROM product WHERE name = '$name'";
        $result = $mysqli->query($sql);

        if ($result->num_rows === 0 || ($result->num_rows === 1 && $name === $foodName)) {
            // No conflicting product names found or the name remains unchanged
            $destination = "upload-files/" . $image_name;
            move_uploaded_file($image_tmp_path, $destination);
            formUpdate($name, $price, $category, $image_name, $image_tmp_path);
        } else {
            // Conflicting product name found
            // Redirect to an appropriate page with an error message or handle the situation accordingly
            header("Location: test.php?message=Product name already exists");
            exit;
        }
    }
}




function generateRandomString($length = 15)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

function prefillform($id)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        // Get the product ID from the URL or another source

        $sql = "SELECT * FROM product WHERE id = $id limit 1";
        $result = $mysqli->query($sql);

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();

            // Retrieve the data from the row
            $id = $row['id'];
            $foodName = $row['name'];
            $price = $row['price'];
            $category = $row['category'];

            setcookie('foodName', $foodName, time() + (86400 * 30), '/');
            setcookie('id', $id, time() + (86400 * 30), '/');
            $randomString = generateRandomString(15);

            header("Location: update.php?token=" . urlencode($randomString) . "&message=" . urlencode($foodName) . "&price=" . urlencode($price) . "&category=" . urlencode($category));
            exit;


        } else {
            // Handle the case where the user ID is not found in the database
            header("Location: test.php?message=User does not exists");
            exit;
        }
    }
}

function formUpdate($name, $price, $category, $image_name, $image_tmp_path)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    // Get the product ID from the URL or another source
    if (isset($_COOKIE['id'])) {
        $id = $_COOKIE['id'];
    }

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        $sql = "UPDATE product SET name = ?, price = ?, category = ?, image_path = ? WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssssi", $name, $price, $category, $image_name, $id);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Update successful
            header("Location: update.php?message=True");
            exit;
        } else {
            // Update failed
            header("Location: update.php?message=False");
            exit;
        }
    }
}

if (isset($_POST['formIdentifier'])) {
    $formIdentifier = $_POST['formIdentifier'];
    $message = '';


    // Perform actions based on the form identifier
    if ($formIdentifier === 'form1') {

        // $usernames = getAllUser();
        $usernames = getAllUser();
        $emails = getEmails();
        $username_to_be_registered = $_POST['userNameInput'];
        $firstName = $_POST['firstNameInput'];
        $lastName = $_POST['lastNameInput'];
        $address = $_POST['addressInput'];
        $birthdate = $_POST['birthdateInput'];
        $age = $_POST['ageInput'];
        $password2 = $_POST['Password'];
        $email = $_POST['emailInput'];

        // Check if the username already exists
        if (in_array($username_to_be_registered, $usernames)) {
            $message = "Username already exists. Please try a different one.";
            header("Location: registration.php?message=" . urlencode($message));
            exit;
        }

        // Check if the email already exists
        if (in_array($email, $emails)) {
            $message = "Email already exists. Please try a different one.";
            header("Location: registration.php?message=" . urlencode($message));
            exit;
        }

        // Process the registration form
        $status_msg = processRegistrationForm($firstName, $lastName, $username_to_be_registered, $address, $birthdate, $age, $password2, $email);
        header("Location: login.php?message=" . urlencode($status_msg));

    } elseif ($formIdentifier === 'form2') {
        // Process the form data from form2.php
        $username_form = $_POST['userName'];
        $password_form = $_POST['Password'];
        credsMatch($username_form, $password_form);


        // Create Form
    } elseif ($formIdentifier === 'form3') {

        $name = $_POST['firstNameInput'];
        $price = $_POST['lastNameInput'];
        $cat = $_POST['category'];
        $image = $_FILES['uploadButton'];
        $image_name = $image['name'];
        $fileTmpPath = $image["tmp_name"];

        addProduct($name, $price, $cat, $image_name, $fileTmpPath);

    } elseif ($formIdentifier === 'form4') {
        $name = $_POST['firstNameInput'];
        $price = $_POST['lastNameInput'];
        $cat = $_POST['category'];
        $image = $_FILES['uploadButton'];
        $image_name = $image['name'];
        $fileTmpPath = $image["tmp_name"];

        updateProduct($name, $price, $cat, $image_name, $fileTmpPath);

    } elseif ($formIdentifier === 'form5') {

        $id = $_POST['uploadButton'];

        prefillform($id);
    } else {
        $status_msg = "Something unexpected happen please try again.";
        header("Location: login.php?message=" . urlencode($status_msg));
        exit;
    }
}

?>