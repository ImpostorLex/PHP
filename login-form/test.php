<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>

    <div class="d-flex justify-content-evenly align-items-center" style="height: 100vh;">
        <div class="card card-2 custom-card w-25">
            <div class="card-body">
                <h3 class="card-title text-danger">Delete Confirmation</h3>
                <!-- confirm_delete.php -->
                <html>

                <body>
                    <p></p>Are you sure you want to delete this record?
                    <?php echo $_GET['id']; ?>
                    </p>
                    <br>
                    <form method="POST" action="backend.php">
                        <input type="hidden" name="formIdentifier" value="form6">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <button type="submit" class="btn btn-danger" name="confirmationButton"
                            value="confirm">Confirm</button>
                        &nbsp;
                        <a class="btn btn-secondary" href="search.php">Go Back!</a>
                    </form>
                </body>

                </html>

            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>