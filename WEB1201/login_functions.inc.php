<?php 
function redirect_user ($page) {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');
	
	// Add the page:
	$url .= '/' . $page;
	
	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

} // End of redirect_user() function.

function check_login($dbc, $email = '', $pass = '') {

	$errors = array(); // Initialize error array.

// Validate the email address:
	if (empty($_POST['username'])){
		$errors[] = 'You forgot to enter your username';
	} else{
		$n = mysqli_real_escape_string($dbc, trim($_POST['username']));
	}
	
	// Validate the password:
	if (empty($_POST['pass'])){
		$errors[] = 'You forgot to enter your password';
	} else{
		$p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
	}

	if (empty($errors)) { // If everything's OK.

		// Retrieve the user_id and first_name for that email/password combination:
		$q = "SELECT user_id, username FROM user WHERE username='$n' AND password=SHA1('$p')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		
		// Check the result:
		if (mysqli_num_rows($r) == 1) {

			// Fetch the record:
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
	
			// Return true and the record:
			return array(1, $row);
			
		} else { // Not a match in user table!
			
            $q = "SELECT admin_id, name FROM admin WHERE name='$n' AND password=SHA1('$p')";
            $r = @mysqli_query ($dbc, $q); // Run the query.
            
            if (mysqli_num_rows($r) == 1) {

                // Fetch the record:
                $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
        
                // Return true and the record:
                return array(2, $row);
                
            } else { // Not a match in admin table!
                $errors[] = 'The username and password entered do not match those on file.';
            }
		}
		
	} // End of empty($errors) IF.
	
	// Return false and the errors:
	return array(0, $errors);

} // End of check_login() function.


?>