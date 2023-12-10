<?php

session_start();

//Redirect user function
include_once("login_functions.inc.php");

if (isset($_SESSION["admin_id"]) && isset($_SESSION["name"])){
    $admin_id = $_SESSION["admin_id"];
}
else{
    redirect_user("login.php"); // Redirect to login.php if not logged in
}

// Check if user is deleting profile
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    include_once("mysqli_connect.php");

    $q = "DELETE FROM admin WHERE admin_id = $admin_id;";
    $r = @mysqli_query($dbc, $q);

    if($r){
        session_unset();
        session_destroy();

        echo "Account deleted sucessfully";
        sleep(5);

        redirect_user("home.php");
    }
}
?>