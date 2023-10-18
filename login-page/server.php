<?php
session_start();
$servername = "localhost";
$username = "root";
$password_db = "NEW_PASSWORD";
$db = "simple_registration";

function isLettersOnly($fname, $lName)
{
    # Check for non-letters and numbers
    if (preg_match("/[0-9]+/", $fname) || preg_match("/[0-9]+/", $lName)) {
        return "False";
    } else {
        return "True";
    }
}

function processRegistrationForm($fName, $lName, $sex, $uName, $password_form, $confirmPassword)
{

    $name_is_letter = isLettersOnly($fName, $lName);
    # If this is true then it is safe to assume that data is 
    # correct and username accepts both letters, non-letter and numbers no need
    # to check for validation.
    if ($password_form == $confirmPassword && $name_is_letter == "True") {

        # Make these var global so we can access them inside function.
        global $servername, $username, $password_db, $db;
        # Create connection to MySQL
        $mysqli = new mysqli($servername, $username, $password_db, $db);

        if ($mysqli->connect_errno) {
            die("Connection failed: " . $mysqli->connect_error);

        } else {
            $sql = "INSERT INTO client (id, first_name, last_name, sex, username, password)
        VALUES (0, '$fName', '$lName', '$sex', '$uName', '$password_form')";

            if ($mysqli->query($sql) === TRUE) {
                $mysqli->close();
                return "New record created successfully";
            } else {
                return "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
    } else if ($name_is_letter == "False") {
        return "Error first and last name contains non-letters and numbers.";
    } else if ($password_form !== $confirmPassword) {
        return "Password does not match please try again.";
    }

}

function isUserExists($username_form, $password_form)
{
    # Make these var global so we can access them inside function.
    global $servername, $username, $password_db, $db;
    # Create connection to MySQL
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "SELECT * FROM client where username = '$username_form' and password = '$password_form'";

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            $mysqli->close();
            $_SESSION['username'] = $username_form;
            echo "<script> alert('Access Granted!'); window.location.href = 'secret.php';</script>";
        } else if ($result->num_rows <= 0) {
            return "User does not exists please try again.";
        } else {
            return "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}

function showUser()
{
    # Make these var global so we can access them inside function.
    global $servername, $username, $password_db, $db;
    # Create connection to MySQL
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "SELECT id, first_name, last_name, username, sex FROM client";

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                # Create an array
                $rows[] = $row;
            }
            return $rows;
        } else if ($result->num_rows <= 0) {
            return false;
        } else {
            return "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}

function deleteFunction($id)
{
    # Make these var global so we can access them inside function.
    global $servername, $username, $password_db, $db;
    # Create connection to MySQL
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "DELETE FROM client where id = '$id'";

        if ($mysqli->query($sql) === TRUE) {
            header("Location: secret.php?edit=Deletion of record successfully");
            exit;
        } else {
            header("Location: secret.php?edit=Something went wrong.");
            exit;
        }


    }
}

function editFunction($id)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        $sql = "SELECT id, first_name, last_name, username, sex FROM client WHERE id = '$id'"; // Corrected the WHERE clause.

        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            return false; // Record not found.
        }
    }
}

function updateRecord($id, $fName, $lName, $sex, $uName, $password_form, $confirmPassword)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        // Check if the password matches the confirmPassword.
        if ($password_form !== $confirmPassword) {
            return "Password and Confirm Password do not match.";
        }

        // Construct the UPDATE SQL statement.
        $sql = "UPDATE client SET
                first_name = '$fName',
                last_name = '$lName',
                sex = '$sex',
                username = '$uName',
                password = '$password_form'
                WHERE id = '$id'";

        if ($mysqli->query($sql) === TRUE) {
            return "Record updated successfully";
        } else {
            return "Error updating record: " . $mysqli->error;
        }
    }
}



if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'edit') {
        // Call the edit function 
        $data = editFunction($_GET['id']);
        if ($data) {
            // Redirect to updateUser.php with data as query parameters
            $url = "updateUser.php?id=" . $data['id'] . "&first_name=" . $data['first_name'] . "&last_name=" . $data['last_name'] . "&username=" . $data['username'] . "&sex=" . $data['sex'];
            header("Location: " . $url);
            exit;
        } else {
            echo "Record not found!";
        }
    } elseif ($action === 'delete') {
        // Call the delete function 
        deleteFunction($_GET['id']);
    } else {
        echo "Invalid action!";
    }
}