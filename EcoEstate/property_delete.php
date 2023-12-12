<?php

session_start();

//Redirect user function
include_once("login_functions.inc.php");

if (((!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) && (!isset($_SESSION['admin_id']) || !isset($_SESSION['name'])))){
    session_unset();
    session_destroy();
    redirect_user("login.php?redirect=1&!login=1");
}


// Check if user is deleting property
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    include_once("mysqli_connect.php");

    $property_id = $_POST['property_id'];

    $q = "DELETE FROM property WHERE property_id = $property_id;";
    $r = @mysqli_query($dbc, $q);

    mysqli_close($dbc);

    if($r){
        if(isset($_SESSION['user_id'])){

            echo '<script>alert("Property Deleted Successfully")</script>';

            redirect_user("home.php?redirect=1&property_delete=1");
        }
        else{

            echo '<script>alert("Property Deleted Successfully")</script>';

            redirect_user("admin_page.php");
        }
    }
}
?>