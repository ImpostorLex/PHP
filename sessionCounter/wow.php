<!doctype html>
<html lang="en">

<?php
session_start();

include 'server.php';

$currentTimestamp = time();
$currentDateTime = date('Y-m-d H:i:s', $currentTimestamp);

if (isset($_SESSION['counter'])) {
    $_SESSION['counter'] += 1;
    $last_visit = getSelectedDate();
    saveLastVisit($currentDateTime);
} else {
    $_SESSION['counter'] = 0;
    saveLastVisit($currentDateTime);

}

$msg = "You have visited this page " . $_SESSION['counter'] . "in this session."
    ?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid d-flex justify-content-center">
        <div class="card text-center mx-auto" style="width: 50%; position: absolute; top:30%;">
            <div class="card-body">
                <h3 class="card-title">
                    <?php echo "Welcome " . $_COOKIE['username'] . "your password is " . $_COOKIE['password'] . "this is done via cookie :)" ?>
                </h3>
                <p>
                    <?php
                    if (session_status() === PHP_SESSION_ACTIVE) {
                        $sessionId = session_id();
                        echo "Your Session ID: " . $sessionId;
                    }
                    ?>
                </p>
                <p>
                    <?php
                    if (isset($last_visit)) {
                        echo "Last time visited page " . $last_visit;
                    }
                    ?>
                </p>
                <p>
                    <?php
                    if (isset($_SESSION['counter'])) {
                        echo "You have visited this page " . $_SESSION['counter'];
                    }
                    ?>
                </p>




            </div>
            <br>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>