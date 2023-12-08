<?php

// Database Connection
include ("mysqli_connect.php");

// Starts session
session_start();

// Check if user is logged in
if (isset($_SESSION["user_id"]) && isset($_SESSION["username"])){
    $user_id = $_SESSION["user_id"];
}
else{
    redirect_user("login.php"); // Redirect to login.php if not logged in
}

$q = "SELECT * FROM user WHERE user_id = $user_id;";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 0) {

    echo "Error, please log in again";

    // clean the session variable
    session_unset();

    // destroy the session
    session_destroy();
}
else{

    $user = mysqli_fetch_assoc($r);

    $user_id = $user["user_id"];
    $username = $user["username"];
    $email = $user["email"];
    $phone_no = $user["phone_no"];
    $about_me = $user["about_me"];
    $join_date = $user["join_date"];
    $profile_img = $user["profile_img_dir"];
    $banner_img = $user["banner_img_dir"];

    include("user_page_display.php");

}