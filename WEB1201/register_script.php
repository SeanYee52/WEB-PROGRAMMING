<?php
// This script performs an INSERT query to add a record to the users table.

require ('login_functions.inc.php');

// Check if user already logged in
session_start();
if (isset($_SESSION["user_id"]) && isset($_SESSION["username"])){
	redirect_user("user_page.php");
}
elseif (isset($_SESSION["admin_id"]) && isset($_SESSION["name"])){
	redirect_user("admin_register.php");
}

// Initialising variables
$username = "username";
$email = "email";
$phone = "+60XXXXXXXXX";

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); // Connect to the db.

	$errors = array(); // Initialize an error array.

	// Validate username
    if (empty($_POST['username'])) {
        $errors[] = "Username is required";
    }
	else{
		$username = mysqli_real_escape_string($dbc, $_POST['username']);
	}

    // Validate email
    if (empty($_POST['email'])) {
        $errors[] = "Email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
	else{
		$email = mysqli_real_escape_string($dbc, $_POST['email']);
        //  Test for unique email address
        $q = "SELECT user_id FROM user WHERE email = '$email'";
        $r = @mysqli_query($dbc, $q);
        if (mysqli_num_rows($r) != 0){
            $errors[]= "The email address has already been registered";
        }
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
	
    //  Test for unique phone number
	$q = "SELECT user_id FROM user WHERE phone_no = '$phone'";
	$r = @mysqli_query($dbc, $q);
    if (mysqli_num_rows($r) != 0){
        $errors[]= "The email address has already been registered";
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
    } 
    elseif ($password !== $_POST['pass2']) {
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
		
	if (empty($errors)) {

		// Make the query:
		$q = "INSERT INTO user (username, email, phone_no, password, join_date) VALUES ('$username', '$email', '$phone', SHA1('$password'), NOW() )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
            $q = "SELECT user_id, username FROM user WHERE email = '$email'";
            $r = @mysqli_query ($dbc, $q);

            $row = mysqli_fetch_assoc($r);
			// Print a message:
            $_SESSION['user_id'] = $row['user_id'];
			$_SESSION['username'] = $row['username'];
			echo '<h1>Thank you!</h1>
			<p>You are now registered successfully.</p><p><br /></p>';
            sleep(5);
            redirect_user("user_page.php");	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.

		mysqli_close($dbc); // Close the database connection.

		exit();

	}
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>

<html lang = "en">
    <head>
        <title>Template</title>
        <meta charset = "utf-8">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>

    <body>
         <!--HEADER, BEGINNING OF CODE (DO NOT EDIT)-->
         <header>
            <a href="home.php"><img  class="logo" src="../Images/Logo.svg"></a>
            <nav>
                <div class="right">
                    <div>
                        <a href="about_us.php">ABOUT US</a>
                    </div>
                    <div>
                        <a href="property_search.php?type=sale">BUY</a>
                    </div>
                    <div>
                        <a href="property_search.php?type=rent">RENT</a>
                    </div>
                    <div>
                        <a href="addproperty.php">ADVERTISE</a>
                    </div>
                </div>
                <div class="buttons">
                    <div class="login">
                        <button
                            <?php
                            if (isset($_SESSION["user_id"]) && $_SESSION["username"]){
                                echo 'onclick="window.location.href=';
                                echo "'user_page.php';";
                                echo ';">MY ACCOUNT';
                            }
                            elseif (isset($_SESSION['admin_id']) && $_SESSION['name']){
                                echo 'onclick="window.location.href=';
                                echo "'admin_page.php';";
                                echo ';">ADMIN PAGE';
                            }
                            else{
                                echo 'onclick="window.location.href=';
                                echo "'login.php';";
                                echo ';">LOGIN';
                            }
                            ?>
                        </button>
                    </div>
                </div>
            </nav>
        </header>
        <!--HEADER, END OF CODE-->

		<div >
			<?php
			if (!empty($errors)) {
				echo '<h1>Error!</h1>
				<p class="error">The following error(s) occurred:<br />';
				foreach ($errors as $msg) { // Print each error.
					echo " - $msg<br />\n";
				}
				echo '</p><p>Please try again.</p><p><br /></p>';
			}
			?>
			<form action="register_script.php" method="post">
					<p>Username: <input type="text" id="username" name="username" required value="<?php echo $username;?>"></p>
				
					<p>Email Address: <input type="email" id="email" name="email" required value="<?php echo $email;?>"></p>

					<p>Phone Number: <input type="tel" id="phone" name="phone" required value="<?php echo $phone;?>"></p>

					<p>Password: <input type="password" id="password" name="pass1" required></p>

					<p>Confirm Password: <input type="password" id="confirm_password" name="pass2" required></p>

					<br><button type="submit">Register</button>
			</form>
		</div>

        <!--FOOTER, BEGINNING OF CODE (DO NOT EDIT)-->
        <footer>
            <div class="footer">
                <div class="row">
                    <img src="../Images/Logo.svg" style = "min-width: 10%; max-width: 10%; margin-left: auto; margin-right: auto;">
                </div>
                <div class="footer-links">
                    <a href="home.php">HOME</a>
                    <a href="property_search.php?type=sale">BUY</a>
                    <a href="property_search.php?type=rent">RENT</a>
                    <a href="addproperty.php">ADVERTISE</a>
                    <a href="login.php">LOGIN</a>
                    <a href="about_us.php">ABOUT US</a>
                    <a href="t&c.php">T&C</a>
                </div>
                <div class="socials">
                    <img class="icon" src="../Images/FB.svg">
                    <img class="icon" src="../Images/Insta.svg">
                    <img class="icon" src="../Images/Twitt.svg">
                    <img class="icon" src="../Images/VK.svg">
                    <img class="icon" src="../Images/Pin.svg">
                </div>
                <div class = "row">
                    <ul>
                        <li>
                            <p class="copyright">&copy;Copyright 20023 EcoEstate. All rights reserved.</p>
                        </li>
                    </ul>
                </div>
            </div>
            
        </footer>
        <!--FOOTER, END OF CODE-->

    </body>

</html>