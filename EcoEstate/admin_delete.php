<?php

session_start();

//Redirect user function
include_once("login_functions.inc.php");

if (isset($_SESSION["admin_id"]) && isset($_SESSION["name"])){
    $admin_id = $_SESSION["admin_id"];
}
else{
    redirect_user("login.php?redirect=1&!login=1"); // Redirect to login.php if not logged in
}

// Check if user is deleting profile
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    include_once("mysqli_connect.php");

    $q = "DELETE FROM admin WHERE admin_id = $admin_id;";
    $r = @mysqli_query($dbc, $q);

    if($r){
        session_unset();
        session_destroy();

        redirect_user("home.php?redirect=1&delete=1");
    }
}
else{
    redirect_user("home.php");
}
?>