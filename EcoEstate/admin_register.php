<?php
// This script performs an INSERT query to add a record to the users table.

// Redirect function
include_once ("login_functions.inc.php");

// Check if admin is properly logged in
session_start();

//Session timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    redirect_user("home.php?redirect=1&timeout=1");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if (!isset($_SESSION["admin_id"]) || !isset($_SESSION["name"])){
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
	redirect_user("login.php?redirect=1&!login=1");
}

// Initialising variables
$username = "username";

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
		// Test for unique admin username
        $q = "SELECT admin_id FROM admin WHERE name= '$username'";
        $r = @mysqli_query($dbc, $q);
        if (mysqli_num_rows($r) != 0){
            $errors[]= "This admin username has already been registered";
        }
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

	if (empty($errors)) { // If everything's OK.
	
		// Register the admin in the database...
		
		// Make the query:
		$q = "INSERT INTO admin (name, password) VALUES ('$username', SHA1('$password'))";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		
		if ($r) { // If it ran OK.
		
			$q = "SELECT admin_id FROM admin WHERE name = '$username'";
            $r = @mysqli_query ($dbc, $q);

            $row = mysqli_fetch_assoc($r);
			// Print a message:
            $_SESSION['admin_id'] = $row['admin_id'];
			$_SESSION['name'] = $username;
			redirect_user("admin_page.php");
		
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
        <title>Admin Register Page</title>
        <meta charset = "utf-8">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>

    <body class="pagewidth">
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

		<div class="adregformbg">
            <div class="adregformborder">
                <div>
                    <div class="formborderdesc">Admin Registration</div>
                    <div class="regformborderdescspace"></div>
                </div>
                <div>
                    <form action="admin_register.php" method="post">
                        <div class="formques">Username</div>
                        <div><input class="formquesbox" type="text" id="username" name="username" required value="<?php echo $username;?>"></div>
                        
                        <div class="formques">Password</div>
                        <div><input class="formquesbox" type="password" id="password" name="pass1" required></div>

                        <div class="formques">Confirm Password</div>
                        <div><input class="formquesbox" type="password" id="confirm_password" name="pass2" required></div>

                        <div><button type="submit" class="formsubmitbutton">Register</button></div>
                    </form>
                </div>
                <?php
                if (!empty($errors)) {
                    echo '<p class="errorclass">The following error(s) occurred:<br />';
                    foreach ($errors as $msg) { // Print each error.
                        echo " - $msg<br />\n";
                    }
                    echo '</p><p class="errorclass">Please try again.</p><p><br /></p>';
                }
                ?>
            </div>
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