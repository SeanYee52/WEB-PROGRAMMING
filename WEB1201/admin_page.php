<?php

// Start session
session_start();
// Redirect function
include_once("login_functions.inc.php");

// Check if admin is logging out
if ($_SERVER["REQUEST_METHOD"] === 'GET'){
    if(isset($_GET['logout'])){
        session_start();
        session_unset();
        session_destroy();
        redirect_user("home.php");
    }
}

// Redirect user to login page if not logged in
if(isset($_SESSION['admin_id']) && isset($_SESSION['name'])){
    $admin_id = $_SESSION['admin_id'];
    $name = $_SESSION['name'];
}
else{
    redirect_user("login.php");
}

$q = "SELECT * FROM admin WHERE admin_id = $admin_id AND name = '$name';";
$r = @mysqli_query($dbc, $q);

if (mysqli_num_rows($r) == 0) {

    echo "Error, please log in again";
    echo '<a href="login.php">LOGIN</a>';

    // clean the session variable
    session_unset();

    // destroy the session
    session_destroy();
}
else{

    include("user_page_display.php");

}
?>