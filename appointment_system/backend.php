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

function processRegistrationForm($firstName, $lastName, $username, $address, $birthdate, $age, $password2, $email)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);

    } else {
        $sql = "INSERT INTO user_acc(id, username, password, is_admin) values(?, ?,?,?)";

        $stmt = $mysqli->prepare($sql);

        $id = 0;
        $is_admin = 0;
        # Bind the parameters to the prepared statement.
        $stmt->bind_param("issi", $id, $username, $password2, $is_admin);

        // -> is used to access methods or properties of an object.
        $stmt->execute();


        // Get the id of the newly added user.
        $sql2 = "SELECT id from user_acc where username = ? limit 1";

        $stmt2 = $mysqli->prepare($sql2);

        $stmt2->bind_param("s", $username);

        $stmt2->execute();

        // Bind the result 
        $stmt2->bind_result($sql_username_id);

        $sql3 = "INSERT INTO user (id, first_name, last_name, address, email, birthdate, age, email, user_id) values (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt3 = $mysqli->prepare($sql3);

        $stmt3->bind_param("issssisi", $is_admin, $firstName, $lastName, $address, $birthdate, $age, $email, $sql_usernames_id);


        $stmt3->execute();

        $stmt->close();
        $mysqli->close();
    }


}

if (isset($_POST['formIdentifier'])) {
    $formIdentifier = $_POST['formIdentifier'];
    $message = '';


    // Perform actions based on the form identifier
    if ($formIdentifier === 'form1') {

        // $usernames = getAllUser();
        $usernames = getAllUser();
        $username_to_be_registered = $_POST['userNameInput'];
        $firstName = $_POST['firstNameInput'];
        $lastName = $_POST['lastNameInput'];
        $address = $_POST['addressInput'];
        $birthdate = $_POST['birthdateInput'];
        $age = $_POST['ageInput'];
        $password2 = $_POST['Password'];
        $email = $_POST['emailInput'];

        foreach ($usernames as $username) {

            if ($username === $username_to_be_registered) {
                $message = "Username already exist please try again.";
                break;
            } else {
                processRegistrationForm($firstName, $lastName, $username, $address, $birthdate, $age, $password2, $email);
            }



        }
        header("Location: registration.php?message=" . urlencode($message));
        exit;


    }




} elseif ($formIdentifier === 'form2') {
    // Process the form data from form2.php
} else {
    // Handle other cases
}

?>