<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['formID'])) {
        $formIdentifier = $_POST['formID'];

        if ($formIdentifier == "1" && isset($_POST['user'])) {
            $searchTerm = $_POST['user'];

            $user_array = array("alex", "person2", "discordman");

            if (!empty($searchTerm) && in_array(strtolower($searchTerm), $user_array)) {
                // Redirect the user to a new URL using a GET request
                header("Location: " . $searchTerm . ".jpg");
                exit;
            }
        } elseif ($formIdentifier == "2" && isset($_POST['animal'])) {
            $searchTerm = $_POST['animal'];

            $user_array = array("panda", "crocodile", "lizard man");

            if (!empty($searchTerm) && in_array(strtolower($searchTerm), $user_array)) {
                // Redirect the user to a new URL using a GET request
                header("Location: " . $searchTerm . ".jpg");

                exit;
            }
        } else {
            echo '<script type="text/javascript">alert("User not found maybe it is an animal or person??");</script>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to YouTube 1980s</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: black;
        }

        table {
            height: 100%;
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
            border: 1px solid black;
        }

        #video-player {
            width: 50%;
            background-color: lightgray;
        }

        #video-list {
            width: 10%;
            background-color: lightblue;
        }

        #comments-section {
            width: 40%;
            background-color: black;
            color: white;
        }

        .link-style {
            text-decoration: underline;
            cursor: pointer;
            color: green;
            border: none;
            background-color: transparent;
            padding: 0;
        }

        .shorter-form {
            width: 40%;

            margin-left: 120px;

        }
    </style>

</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">YouTube 1982</a>
            <a class="nav-link" href="new.html">See list of Images and Users here</a>

            <form class="d-flex" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="search" method="POST">
                <input class="form-control me-2" type="search" name="user" placeholder="Search" aria-label="Search">
                <input class="form-control me-2" type="hidden" name="formID" value="1" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <h1 class="text-center text-white">Search is now available!</h1>
    <p class="text-center text-white">You can now search your favorite image</p>

    <table>
        <tbody>
            <tr>
                <td id="video-player" class="text-center" rowspan="3">
                    <iframe class="iframeh" id="mainContent" src="" width="800" height="600"></iframe>
                </td>
                <td id="video-list" class="text-center">
                    <button class="link-style" onclick="putContent('robber.png')">Government</button>
                </td>
            </tr>
            <tr>
                <td id="video-list" class="text-center">
                    <button class="link-style" onclick="putContent('bbq.jpg')">BBQ YUM!</button>

                </td>
            </tr>
            <tr>
                <td id="video-list" class="text-center">
                    <button class="link-style" onclick="putContent('student.png')">Working Student</button>

                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <h2 class="text-center text-white">Search User Here:</h2>
    <p class="text-center text-white">Note: User comments are removed due to toxicity, please wait for the next update
    </p>
    <form class="shorter-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="search" method="POST">
        <input class="form-control me-2" type="search" placeholder="Search" name="animal" aria-label="Search">
        <input class="form-control me-2" type="hidden" name="formID" value="2" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    <script>
        function putContent(src) {
            var iFrame = document.getElementById('mainContent');
            iFrame.src = src;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



</body>

</html>