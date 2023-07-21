<?php
$servername = "localhost";
$username = "root";
$password_db = "NEW_PASSWORD";
$db = "clinic_db";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'sendmailf/PHPMailer-master/src/Exception.php';
require 'sendmailf/PHPMailer-master/src/PHPMailer.php';
require 'sendmailf/PHPMailer-master/src/SMTP.php';

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

            setcookie('foodName', $foodName, [
                'expires' => time() + (86400 * 30),
                'path' => '/',
                'secure' => true,
                'samesite' => 'None'
            ]);

            setcookie('id', $id, [
                'expires' => time() + (86400 * 30),
                'path' => '/',
                'secure' => true,
                'samesite' => 'None'
            ]);

            $randomString = generateRandomString(15);

            header("Location: update.php?token=" . urlencode($randomString) . "&message=" . urlencode($foodName) . "&price=" . urlencode($price) . "&category=" . urlencode($category));
            exit;


        } else {
            // user ID is not found in the database
            $randomString = generateRandomString(15);
            header("Location: search.php?token=" . $randomString . "&st_message=User_e");
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
            header("Location: update.php?st_message=True");
            exit;
        } else {
            // Update failed
            header("Location: update.php?st_message=False");
            exit;
        }
    }
}

function deleteProd($id)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        $sql = "DELETE FROM product where id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);

        // Execute the prepared statement
        $stmt->execute();

        // Check the affected rows
        if ($stmt->affected_rows > 0) {
            header("Location: search.php?st_message=product_s");
            exit();
        } else {
            header("Location: search.php?st_message=product_f");
            exit();
        }
    }
}

function deleteSubscriber($id)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        $sql = "DELETE FROM subscribed WHERE user_acc_fk = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $id);

        // Execute the prepared statement
        $stmt->execute();

        // Check for errors
        if ($stmt->error) {
            die("Delete error: " . $stmt->error);
        }

        // Check the affected rows
        if ($stmt->affected_rows > 0) {
            header("Location: email.php?st_message=e_s");
            exit();
        } else {
            header("Location: email.php?st_message=e_f&id=" . $id);
            exit();
        }
    }
}


function getSubscriber($title, $txtBody, $sender)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        $sql = "SELECT user_acc_fk FROM subscribed";
        $result = $mysqli->query($sql);

        $user_ids = array(); // Array to store user IDs

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_ids[] = $row['user_acc_fk'];
            }

            // Use placeholder for the IN clause based on the number of user IDs
            $placeholders = implode(',', array_fill(0, count($user_ids), '?'));

            $sql2 = "SELECT email, first_name FROM user WHERE id IN ($placeholders)";
            $stmt = $mysqli->prepare($sql2);

            // Bind the user IDs as parameters
            $stmt->bind_param(str_repeat('i', count($user_ids)), ...$user_ids);
            $stmt->execute();
            $result2 = $stmt->get_result();

            $emails = array();

            if ($result2->num_rows > 0) {
                while ($row2 = $result2->fetch_assoc()) {
                    $emails[] = $row2['email'];
                }
            }

            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, 'ssl' also accepted
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Username = "navarrojr.dennis@ue.edu.ph"; // Your Gmail email address
            $mail->Password = ''; // Your Gmail password or app-specific password

            $mail->setFrom($sender, 'KantoFoodKing'); // Sender email address and name

            // Add all recipients
            foreach ($emails as $email) {
                $mail->addAddress($email); // Recipient email address
            }

            # $mail->addAddress("navarrojr.dennis@ue.edu.ph"); // Recipient email address


            $mail->Subject = $title;
            $mail->Body = $txtBody;
            $mysqli->close();
            if ($mail->send()) {
                return 'email_t';
            } else {
                return 'email_f';

            }

        } else {
            return "No_em";
        }


    }
}


function sendNewsletter($title, $txtBody)
{
    $sender = "navarrojr.dennis@ue.edu.ph";
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        // Verify if there is any subscriber.
        $sql = "SELECT COUNT(*) from subscribed";
        $result = $mysqli->query($sql);


        // Check the affected rows
        if ($result->num_rows > 0) {

            $tas_msg = getSubscriber($title, $txtBody, $sender);

            if ($tas_msg === 'email_t') {
                header("Location: email.php?st_message=e_ss");
                exit();
            } elseif ($tas_msg === 'email_f') {
                header("Location: send_email.php?st_message=e_fs");
                exit();
            } else {
                header("Location: send_email.php?st_message=e_ue");
                exit();
            }


        } else {
            header("Location: send_email.php?st_message=e_f");
            exit();
        }
    }

}

// function subscribe($email)
// {
//     global $servername, $username, $password_db, $db;
//     $mysqli = new mysqli($servername, $username, $password_db, $db);
//     echo '<script>console.log("User ID2: ");</script>';

//     if ($mysqli->connect_error) {
//         echo '<script>console.log("User ID3: ");</script>';
//         die("Connection failed: " . $mysqli->connect_error);
//     } else {
//         $emails = getEmails();
//         echo '<script>console.log("User ID4:");</script>';

//         // Check if email is registered to the website
//         if (in_array($email, $emails)) {
//             // Verify if user is already subscribed
//             $sql = "SELECT user_id FROM user WHERE email = ?";
//             $stmt = $mysqli->prepare($sql);
//             $stmt->bind_param("s", $email);
//             $stmt->execute();
//             $result = $stmt->get_result();
//             echo '<script>console.log("User ID: ");</script>';

//             if ($result->num_rows > 0) {
//                 while ($row = $result->fetch_assoc()) {
//                     $user_id = $row['user_id'];
//                 }

//                 $sql2 = "SELECT COUNT(*) AS count FROM subscribed WHERE user_acc_fk = ?";
//                 $stmt2 = $mysqli->prepare($sql2);
//                 $stmt2->bind_param("i", $user_id);
//                 $stmt2->execute();
//                 $result2 = $stmt2->get_result();

//                 $row2 = $result2->fetch_assoc();
//                 $subscriptionCount = $row2['count'];
//                 echo '<script>console.log("User ID: ' . $user_id . '");</script>';


//                 if ($subscriptionCount > 0) {
//                     header("Location: home.php?i_e=alreadyS");
//                     exit();
//                 } else {

//                     echo '<script>console.log("User ID: ' . $user_id . '");</script>';
//                     $sql3 = "INSERT INTO subscribed (user_acc_fk) VALUES (?)";
//                     $stmt3 = $mysqli->prepare($sql3);
//                     $stmt3->bind_param("i", $user_id);
//                     $stmt3->execute();

//                     if ($stmt3->affected_rows > 0) {
//                         header("Location: home.php?i_e=ss");
//                         exit();
//                     }
//                 }
//             } else {
//                 header("Location: home.php?i_e=e_f");
//                 exit();
//             }
//         }
//     }
// }


function subscribe($email)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);
    echo '<script>console.log("User ID2: ");</script>';

    if ($mysqli->connect_error) {
        echo '<script>console.log("User ID3: ");</script>';
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        $emails = getEmails();
        echo '<script>console.log("User ID4:");</script>';

        // Check if email is registered to the website
        if (in_array($email, $emails)) {
            // Verify if user is already subscribed
            $sql = "SELECT user_id FROM user WHERE email = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            echo '<script>console.log("User ID: ");</script>';

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $user_id = $row['user_id'];
                }

                $sql2 = "SELECT COUNT(*) AS count FROM subscribed WHERE user_acc_fk = ?";
                $stmt2 = $mysqli->prepare($sql2);
                $stmt2->bind_param("i", $user_id);
                $stmt2->execute();
                $result2 = $stmt2->get_result();

                $row2 = $result2->fetch_assoc();
                $subscriptionCount = $row2['count'];
                echo '<script>console.log("User ID: ' . $user_id . '");</script>';

                if ($subscriptionCount > 0) {
                    header("Location: home.php?i_e=alreadyS");
                    exit();
                } else {
                    echo '<script>console.log("User ID: ' . $user_id . '");</script>';
                    $sql3 = "INSERT INTO subscribed (user_acc_fk) VALUES (?)";
                    $stmt3 = $mysqli->prepare($sql3);
                    $stmt3->bind_param("i", $user_id);
                    $stmt3->execute();

                    if ($stmt3->affected_rows > 0) {
                        header("Location: home.php?i_e=ss");
                        exit();
                    }
                }
            } else {
                header("Location: home.php?i_e=e_f");
                exit();
            }
        } else {
            // Email is not registered
            header("Location: home.php?i_e=notRegistered");
            exit();
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

        $id = trim($_POST['search_term']);


        if (isset($id) && !ctype_digit($id)) {
            header("Location: search.php?st_message=not_digit");
            exit();
        } elseif (isset($_POST['updateButton']) && $_POST['updateButton'] === 'update') {
            prefillform($id);
        } elseif (isset($_POST['deleteButton']) && $_POST['deleteButton'] === 'delete') {
            header("Location: test.php?id=" . $id);
            exit();
        }


    } elseif ($formIdentifier === 'form6') {

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            deleteProd($id);
        }

    } elseif ($formIdentifier === 'form7') {

        $id = $_POST['search_term'];

        if (isset($id) && !ctype_digit($id)) {
            header("Location: email.php?st_message=not_digit");
            exit();
        } else {
            $randomString = generateRandomString(15);
            header("Location: test2.php?token=" . $randomString . "&id=" . $id);
            exit();
        }
    } elseif ($formIdentifier === 'form8') {

        $id = intval($_POST['id2']);
        echo '<script>console.log("ID:", ' . $id . ');</script>';

        // Debugging statement to confirm form submission and data
        echo 'Form 8 submitted successfully. ID: ' . $id;

        deleteSubscriber($id);


    } elseif ($formIdentifier === 'form9') {

        $title = $_POST['titleInput'];
        $txtBody = $_POST['text-body'];
        sendNewsletter($title, $txtBody);
    } elseif ($formIdentifier === 'form10') {

        $email = $_POST['form5Example2'];

        subscribe($email);

    } else {
        $status_msg = "Something unexpected happen please try again.";
        header("Location: login.php?message=" . urlencode($status_msg));
        exit;
    }
}

?>