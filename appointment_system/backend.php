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

        // Return the usernames as a JSON string
        return json_encode($usernames);
    }
}

// Call the function to execute it
getAllUser();
?>