<?php

session_start();

//Redirect user function
include_once("login_functions.inc.php");

if (isset($_SESSION["user_id"]) && isset($_SESSION["username"])){
    $user_id = $_SESSION["user_id"];
}
else{
    redirect_user("login.php?redirect=1&!login=1"); // Redirect to login.php if not logged in
}

// Check if user is updating profile
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    include_once("mysqli_connect.php");

    $errors = array();

    // Validate email
    if (empty($_POST['email'])) {
        $error[] = "Email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
	else{
		$email = mysqli_real_escape_string($dbc, $_POST['email']);
	}

    // Validate phone number
	$phone_regex = "/^(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$/"; //Includes optional +60, only accepts Malaysian phone numbers
    if (empty($_POST['phone'])) {
        $errors[] = "Phone number is required";
    }
	elseif (!preg_match($phone_regex, $_POST['phone'])) {
		$errors[] = "Phone number is invalid";
	}
	else{
		$phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
	}

    if(empty($errors)){
        $q = "UPDATE user SET email = '$email', phone_no = '$phone' WHERE user_id = $user_id;";
        $r = @mysqli_query($dbc, $q);
    }

    include("user_page.php");
}
?>