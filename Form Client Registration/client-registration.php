<?php

$servername = "localhost";
$username = "root";
$password_db = "NEW_PASSWORD";
$db = "simple_registration";

function isLettersOnly($fname, $lName)
{
    # Check for non-letters and numbers
    if (!preg_match("/[a-zA-Z]+/", $fname) || !preg_match("/[a-zA-Z]+/", $lName)) {
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
        #return "<br>" . $fName . "<br>" . $lName;
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
            $_SESSION['password'] = $password_form;
            echo "<script> alert('Access Granted!'); window.location.href = 'admin.php';</script>";
        } else if ($result->num_rows <= 0) {
            return "User does not exists please try again.";
        } else {
            return "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}

function showUser($username_session, $password_session)
{
    # Make these var global so we can access them inside function.
    global $servername, $username, $password_db, $db;
    # Create connection to MySQL
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "SELECT first_name, last_name, username, sex FROM client where username != '$username_session' and password != '$password_session';";

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

function deleteUser($username_form)
{
    # Make these var global so we can access them inside function.
    global $servername, $username, $password_db, $db;
    # Create connection to MySQL
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "DELETE from client where username = '$username_form'";

        if ($mysqli->query($sql) === TRUE) {
            $mysqli->close();
            return "Deletion of Record successfully";
        } else {
            return false;
        }
    }


}

function searchUser($username_form)
{
    # Make these var global so we can access them inside function.
    global $servername, $username, $password_db, $db;
    # Create connection to MySQL
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "SELECT first_name, last_name, username, sex from client where username = '$username_form';";

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