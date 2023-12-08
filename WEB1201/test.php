<?php

include ("mysqli_connect.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Upload and handle photos
    $targetDirectory = "../Images/";
    $uploadedPhotos = array();

    if (!empty($_FILES["photos"]["name"])) {
        $totalPhotos = count($_FILES["photos"]["name"]); //Count number of photos
        
        //Upload photos accordingly
        for ($i = 0; $i < $totalPhotos; $i++) {
            $targetFile = $targetDirectory . basename($_FILES["photos"]["name"][$i]); //Specifies image folder
            move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $targetFile); //Uploads photo to folder
            $uploadedPhotos[] = $targetFile;
        }
    }

    echo $uploadedPhotos[0];

}
?>

<html>
<form action="test.php" method="post" enctype="multipart/form-data">

    <label for="photos">Photos (Upload File):</label>
    <input type="file" id="photos" name="photos[]" accept="image/*" multiple>

    <button type="submit">Submit</button>
</form>
</html>