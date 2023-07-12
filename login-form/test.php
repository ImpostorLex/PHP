<?php

if (isset($_FILES['uploadButton'])) {

    $image = $_FILES['uploadButton'];
    $image_name = $image['name'];
    $fileTmpPath = $image["tmp_name"];
    $destination = "upload-files/" . $image_name;
    $result = move_uploaded_file($fileTmpPath, $destination);

    echo $result;

}


?>

<form id="registrationForm" enctype="multipart/form-data" class="needs-validation" method="POST" action="backend.php">
    <div class="row">
        <input type="hidden" name="formIdentifier" value="form5">

        <div class="mb-3">
            <label for="uploadButton" class="form-label">Image</label>
            <input type="number" class="form-control" name="uploadButton" id="uploadButton">
            <div class="invalid-feedback">
                Image only (.png, .jpeg, .jpg)
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
</form>