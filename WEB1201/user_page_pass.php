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

    $error = array();

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

    if(empty($error)){
        $q = "UPDATE user SET password = SHA1('$password') WHERE user_id = $user_id;";
        $r = @mysqli_query($dbc, $q);
    }

    include("user_page.php");
}
?>