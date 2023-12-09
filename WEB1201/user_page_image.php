<?php

session_start();

//Redirect user function
include_once("login_functions.inc.php");

if (isset($_SESSION["user_id"]) && isset($_SESSION["username"])){
    $user_id = $_SESSION["user_id"];
}
else{
    redirect_user("login.php"); // Redirect to login.php if not logged in
}

// Check if user is updating profile
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    include_once("mysqli_connect.php");

    $errors = array();

    // Upload and handle photos
    $targetDirectory = "../Images/";

    if (!empty($_FILES["photos"]["name"])) {
        
        //Renaming File
        $temp = explode(".", $_FILES["photos"]["name"][0]);
        $newfilename = 'ECOR' . $user_id . '.' . end($temp);

        //Upload photos accordingly
        $targetFile = $targetDirectory . $newfilename; //Specifies image folder
        move_uploaded_file($_FILES["photos"]["tmp_name"][0], $targetFile); //Uploads photo to folder

        $q = "UPDATE user SET profile_img_dir = '$targetFile' WHERE user_id = $user_id;";
        $r = @mysqli_query($dbc, $q);

    }
    else{
        $errors[]="Please upload a photo";
    }

    include("user_page.php");

}
?>