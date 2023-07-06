<?php

$servername = "localhost";
$username = "root";
$password_db = "";
$db = "simple_registration";

function isLettersOnly($fname, $lName)
{
    # Check for non-letters and numbers
    if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lName)) {
        return false;
    } else {
        return true;
    }
}

function processRegistrationForm($fName, $lName, $sex, $uName, $password_form, $confirmPassword)
{

    $name_is_letter = isLettersOnly($fName, $lName);
    # If this is true then it is safe to assume that data is 
    # correct and username accepts both letters, non-letter and numbers no need
    # to check for validation.
    if ($password_form == $confirmPassword && $name_is_letter == true) {

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
    } else if ($name_is_letter == false) {
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
            # SET COOKIE
            setcookie('username', $username_form, time() + 3600, 'wow.php');
            setcookie('password', $password_form, time() + 3600, 'wow.php');
            echo "<script> alert('Access Granted!'); window.location.href = 'wow.php';</script>";
        } else if ($result->num_rows <= 0) {
            return "User does not exists please try again.";
        } else {
            return "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}

function saveLastVisit($date)
{
    # Make these var global so we can access them inside function.
    global $servername, $username, $password_db, $db;
    # Create connection to MySQL
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "INSERT INTO date_records (id, dates) VALUES(0, '$date')";
        if ($mysqli->query($sql) === TRUE) {
            $mysqli->close();
            echo "Record saved!";
        } else {
            return "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}

function getSelectedDate()
{

    # Make these var global so we can access them inside function.
    global $servername, $username, $password_db, $db;
    # Create connection to MySQL
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    $sql = "SELECT dates FROM date_records ORDER BY id DESC LIMIT 1";
    $result = $mysqli->query($sql);

    if ($result !== false) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $selectedDate = $row['dates'];
            $mysqli->close();
            return $selectedDate;
        } else {
            $mysqli->close();
            echo "No rows found.";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }


}