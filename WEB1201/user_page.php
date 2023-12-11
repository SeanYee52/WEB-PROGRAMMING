<?php

// Database Connection
include_once("mysqli_connect.php");
//Redirect user function
include_once("login_functions.inc.php");
error_reporting(E_ERROR | E_WARNING | E_PARSE); 

session_start();

// Check if user is logging out
if ($_SERVER["REQUEST_METHOD"] === 'GET'){
    if(isset($_GET['logout'])){
        session_start();
        session_unset();
        session_destroy();
        redirect_user("home.php?redirect=1&logout=1");
    }
}

//Session timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    redirect_user("home.php?redirect=1&timeout=1");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

// Check if user is logged in
// View other account
if (isset($_GET['user_id'])){
    $user_id = $_GET["user_id"];
}
// View their own account
elseif (isset($_SESSION["user_id"]) && isset($_SESSION["username"])){
    $user_id = $_SESSION["user_id"];
}
else{
    if(!isset($_SESSION["user_id"]) || !isset($_SESSION["username"])){
        redirect_user("login.php?redirect=1&!login=1"); // Redirect to login.php if not logged in
    }
}

$q = "SELECT * FROM user WHERE user_id = $user_id;";
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

    $user = mysqli_fetch_assoc($r);

    $user_id = $user["user_id"];
    $username = $user["username"];
    $email = $user["email"];
    $phone_no = $user["phone_no"];
    $about_me = $user["about_me"];
    $join_date = $user["join_date"];
    $profile_img = $user["profile_img_dir"];
    $banner_img = $user["banner_img_dir"];

    if(!isset($_SESSION["user_id"])){
        include("user_page_view.php"); // Admin viewing profile
    }
    elseif ($user_id == $_SESSION["user_id"]){
        include("user_page_display.php"); // User viewing their own profile
    }
    else{
        include("user_page_view.php"); // User viewing other profile
    }
}
?>