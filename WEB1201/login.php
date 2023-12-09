<?php
// This page processes the login form submission.
// The script uses sessions.
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE); 

require ('login_functions.inc.php');


if(isset($_SESSION["user_id"])){
	redirect_user('user_page.php');
}
elseif (isset($_SESSION["admin_id"])){
	redirect_user('admin_page.php');
}
else{
	// Check if the form has been submitted:
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		require ('mysqli_connect.php');

		// Check the login:
		list ($check, $data) = check_login($dbc, $_POST['username'], $_POST['pass']);
		
		if ($check == 1) { // OK!
			
			// Set the session data:
			$_SESSION['user_id'] = $data['user_id'];
			$_SESSION['username'] = $data['username'];
			
			// Redirect:
			redirect_user('user_page.php');	//placeholder php file for now, send to home page	
				
		}
		elseif ($check == 2){
			// Set the session data:
			$_SESSION['admin_id'] = $data['admin_id'];
			$_SESSION['name'] = $data['name'];
			
			// Redirect:
			redirect_user('loggedin.php'); //placeholder php file for now, send to admin page
		} 
		else { // Unsuccessful!

			// Assign $data to $errors for login_page.inc.php:
			$errors = $data;

		}
			
		mysqli_close($dbc); // Close the database connection.

	} // End of the main submit conditional.

	// Create the page:
	include ('login_page.inc.php');
}
?>