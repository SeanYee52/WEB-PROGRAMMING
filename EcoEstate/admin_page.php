<?php

// Start session
session_start();
// Redirect function
include_once("login_functions.inc.php");
// Database connection
include_once("mysqli_connect.php");

// Check if admin is logging out
if ($_SERVER["REQUEST_METHOD"] == 'GET'){
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

// Redirect user to login page if not logged in
if(isset($_SESSION['admin_id']) && isset($_SESSION['name'])){
    $admin_id = $_SESSION['admin_id'];
    $name = $_SESSION['name'];
}
else{
    redirect_user("login.php?redirect=1&!login=1");
}

// Admin editing details
if ($_SERVER["REQUEST_METHOD"] == 'POST'){

    include_once("mysqli_connect.php");

    $errors = array();

    // Check if new name is empty
    if (!empty($_POST["username"])){
        $newusername = mysqli_real_escape_string($dbc, trim($_POST["username"]));
    }
    else{
        $errors[]="Please enter a username";
    }

    // Validate password
    if (empty($_POST['pass1'])) {
        $errors[] = "Password is required";
    }
	else{
		$password = mysqli_real_escape_string($dbc, $_POST['pass1']);
	}

    // Validate confirm password
    if (empty($_POST['pass2'])) {
        $errors[] = "Confirm password is required";
    } elseif ($password !== $_POST['pass2']) {
        $errors[] = "Password and confirm password do not match";
    }

	// Validate Password Requirements
	// Requirement 1: At least 8 characters long
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }
    // Requirement 2: A combination of uppercase and lowercase letters
    if (!preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain a combination of uppercase and lowercase letters";
    }
    // Requirement 3: At least 1 number
    if (!preg_match('/\d/', $password)) {
        $errors[] = "Password must contain at least 1 number";
    }
    // Requirement 4: At least 1 special character
    if (!preg_match('/.*[!@#$%^&*()_+{}|:"<>?`~\-=[\];\',.\/\\\\].*/', $password)) {
        $errors[] = "Password must contain at least 1 special character";
    }

    if(empty($errors)){
        $q = "UPDATE admin SET password = SHA1('$password'), name = '$newusername' WHERE admin_id = $admin_id;";
        $r = @mysqli_query($dbc, $q);
        $_SESSION['name'] = $newusername;
        $name = $newusername;
    }
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

    include("admin_page_display.php");

}
?>