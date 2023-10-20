<?php
session_start();
$servername = "localhost";
$username = "root";
$password_db = "NEW_PASSWORD";
$db = "register-with-blog";

function isLettersOnly($fname, $lName)
{
    # Check for non-letters and numbers
    if (preg_match("/[0-9]+/", $fname) || preg_match("/[0-9]+/", $lName)) {
        return "False";
    } else {
        return "True";
    }
}


function getAddress()
{
    global $servername, $username, $password_db, $db;
    # Create connection to MySQL
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        $sql = "SELECT * FROM date";
        $stmt = $mysqli->prepare($sql);
        $result = $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $addresses[] = $row['address'];
            }

            return $addresses;
        }
    }
}


function isAddressExist($address)
{
    global $servername, $username, $password_db, $db;
    # Create connection to MySQL
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("Connection failed: " . $mysqli->connect_error);
    } else {
        $sql = "SELECT count(*) FROM date WHERE address = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $address);

        if ($stmt->execute()) {
            $stmt->bind_result($count);
            $stmt->fetch();

            if ($count > 0) {
                $stmt->close(); // Close the first statement here
                $mysqli->next_result(); // Move to the next result set
                return "It seems like that address already exists.";
            } else {
                $stmt->close(); // Close the first statement here
                $mysqli->next_result(); // Move to the next result set
                $sql2 = "INSERT INTO date (address) values (?)";
                $stmt2 = $mysqli->prepare($sql2);
                $stmt2->bind_param("s", $address);
                $stmt2->execute();
                return "Address successfully added";
            }
        } else {
            echo "Error executing the query: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    }
}

function isTitleExist($title)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        return "Server error";
    } else {
        $sql = "SELECT count(*) FROM date_records WHERE title = ?";
        $stmt = $mysqli->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $title);

            if ($stmt->execute()) {
                $stmt->bind_result($count);
                $stmt->fetch();

                if ($count > 0) {
                    return 1; // Title exists
                } else {
                    return 0; // Title does not exist
                }
            }
        }
    }
}


function processBlog($title, $body, $stid)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    $is_title_exist = isTitleExist($title);


    if ($mysqli->connect_errno) {
        return "Server error";
    } else {
        if (strlen($title) <= 50 && strlen($body) <= 500) {
            $sql = "INSERT INTO date_records (id, title, body, st_id) VALUES (0, ?, ?, ?)";
            // Create a prepared statement
            $stmt = $mysqli->prepare($sql);

            if ($stmt && $is_title_exist == 0) {
                $stmt->bind_param("ssi", $title, $body, $stid);
                // Execute the prepared statement
                if ($stmt->execute()) {
                    return "Record inserted successfully.";
                } else {
                    return "Something went wrong.";
                }
            } else if ($is_title_exist == 1) {
                return "Title already exist please try another one";
            }
        } else {
            return "Error creating the prepared statement: " . $mysqli->error;
        }
    }
}




function processRegistrationForm($fName, $lName, $sex, $uName, $password_form, $confirmPassword)
{

    $name_is_letter = isLettersOnly($fName, $lName);
    $student_num_is_num = is_numeric($uName);

    # If this is true then it is safe to assume that data is 
    # correct and student number only accepts numbers.
    if ($password_form == $confirmPassword && $name_is_letter == "True" && $student_num_is_num == true) {

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
    } else if ($student_num_is_num == false) {
        return "Student number must only be a number.";
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
            echo "<script> alert('Access Granted!'); window.location.href = 'dashboard.html';</script>";
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

function showBlogs()
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("" . $mysqli->connect_error);
    } else {
        $sql = "SELECT * FROM date_records";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            return $rows;
        } else {
            return false;
        }
    }
}

function deleteBlog($blog_ids)
{
    // blog ids are stored via an array, so we need to implode it to a comma-separated string
    $idsString = implode(',', $blog_ids);

    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        die("" . $mysqli->connect_error);
    } else {

        if (!empty($blog_ids)) {

            $sql = "DELETE FROM date_records WHERE id IN ($idsString)";
            if ($mysqli->query($sql)) {
                return "Record(s) $idsString successfully deleted";
            } else {
                return "Something went wrong: " . $mysqli->error;
            }
        } else {
            return "No checkboxes checked.";
        }
    }
}

function deleteSingleBlog($blog_id)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        return "Server error: " . $mysqli->connect_error;
    } else {
        $checkSql = "SELECT id FROM date_records WHERE id = ?";
        $checkStmt = $mysqli->prepare($checkSql);
        $checkStmt->bind_param("i", $blog_id);

        if ($checkStmt->execute()) {
            $checkStmt->store_result();

            if ($checkStmt->num_rows == 0) {
                $checkStmt->close();
                return "Blog not found";
            }
        } else {
            $checkStmt->close();
            return "Error checking for the blog: " . $mysqli->error;
        }

        $checkStmt->close();
        $sql = "DELETE FROM date_records WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $blog_id);

        if ($stmt->execute()) {
            return "Blog with ID $blog_id has been deleted";
        } else {
            return "Error deleting the blog: " . $stmt->error;
        }
    }
}

// Noted
function editBlog($blog_id)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        return "Server error: " . $mysqli->connect_error;
    } else {
        $sql = "SELECT * FROM date_records WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("i", $blog_id);

        if ($stmt->execute()) {
            $results = $stmt->get_result();

            if ($results->num_rows === 0) {
                return "Blog entry not found";
            } else {
                // Fetch the result and return it, e.g., as an associative array
                return $results->fetch_assoc();
            }
        } else {
            return "Error fetching the blog entry: " . $stmt->error;
        }
    }
}

function updateBlog($title, $body, $stid, $id)
{
    global $servername, $username, $password_db, $db;
    $mysqli = new mysqli($servername, $username, $password_db, $db);

    if ($mysqli->connect_errno) {
        return "Connection error: " . $mysqli->connect_error;
    } else {
        $sql = "UPDATE date_records SET
                title = ?,
                body = ?,
                st_id = ?
                WHERE id = ?";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ssii", $title, $body, $stid, $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows === 1) {
                return "Update successful";
            } else {
                return "No rows were updated";
            }
        } else {
            return "Error executing update: " . $stmt->error;
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
        deleteFunction($_GET['id']);
    } elseif ($action === 'deleteBlog') {
        $rmsg = deleteSingleBlog($_GET['id']);
        header("Location: viewpost.php?rBlogmsg=" . $rmsg);
        exit();
    } elseif ($action === "editBlog") {
        header("Location: updateBlog.php?id=" . $_GET['id']);
        exit();
    } else {
        echo "Invalid action!";
    }
}