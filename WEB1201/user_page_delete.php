<?php

session_start();

//Redirect user function
include_once("login_functions.inc.php");

if (isset($_SESSION["user_id"]) && isset($_SESSION["username"])){
    $user_id = $_SESSION["user_id"];
}
elseif(isset($_SESSION["admin_id"]) && isset($_SESSION["name"])){
    $user_id = $_POST['user_id'];
}
else{
    redirect_user("login.php?redirect=1&!login=1"); // Redirect to login.php if not logged in
}

// Check if user is deleting profile
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    include_once("mysqli_connect.php");

    $q = "DELETE FROM user WHERE user_id = $user_id;";
    $r = @mysqli_query($dbc, $q);

    mysqli_close($dbc);

    if($r){
        if($_SESSION["user_id"] == $user_id){
            session_unset();
            session_destroy();

            sleep(5);

            redirect_user("home.php?redirect=1&delete=1");
        }
        else{
            redirect_user("admin_page.php");
        }
    }
}
?>