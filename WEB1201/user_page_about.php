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

    if (!empty($_POST["description"])){

        $description = mysqli_real_escape_string($dbc, trim($_POST["description"]));

        $q = "UPDATE user SET about_me = '$description' WHERE user_id = $user_id";
        $r = @mysqli_query($dbc, $q);

    }
    else{
        $errors[]="Please enter a description";
    }

    include("user_page.php");
}
?>