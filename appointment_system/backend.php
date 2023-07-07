<?php
$servername = "localhost";
$username = "root";
$password_db = "";
$db = "clinic_db";

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
        $sql = "SELECT COUNT(*) AS count from user_acc where username = ? and password = ?";

        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("ss", $username_form, $password_form);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result) {
            $row = $result->fetch_assoc();
            $count = $row['count'];

            if ($count > 0) {
                // Change home.php to whatever the homepage after succesful login
                header("Location: home.php");
                exit;
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
    } else {
        $status_msg = "Something unexpected happen please try again.";
        header("Location: login.php?message=" . urlencode($status_msg));
        exit;
    }
}

?>