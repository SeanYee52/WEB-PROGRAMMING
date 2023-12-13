<?php
session_start();
error_reporting(E_ERROR | E_WARNING | E_PARSE); 

//Redirect function
include ("login_functions.inc.php");

//Session timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    redirect_user("home.php?redirect=1&timeout=1");
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if (isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
}
else{
    redirect_user("login.php?redirect=1&!login=1");
}

require ("mysqli_connect.php");

//Gets values from the checkbox and verifies each one, returns an array
function verify_array($dbc, $inputName){
    
    if(!empty($_POST["$inputName"])){
        $array = $_POST["$inputName"];
        for ($i = 0; $i < count($array); $i++){
            $array[$i] = mysqli_real_escape_string($dbc, trim($array[$i])); //Makes sure each index is SQL legal
        }
        return $array;
    }
    else{
        return $_POST["$inputName"]; //returns an empty string, handled by add_features function
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Process input data
    $listing_type = mysqli_real_escape_string($dbc, trim($_POST["listing_type"]));
    $property_type = mysqli_real_escape_string($dbc, trim($_POST["property_type"]));
    $state = mysqli_real_escape_string($dbc, trim($_POST["state"]));
    $city = mysqli_real_escape_string($dbc, trim($_POST["city"]));
    $address = mysqli_real_escape_string($dbc, trim($_POST["address"]));
    $asking_price = floatval($_POST["asking_price"]);
    $floor_size = floatval($_POST["floor_size"]);
    $upload_date = date('Y-m-d H:i:s');

    $year_completion = mysqli_real_escape_string($dbc, trim($_POST["year_completion"]));
    $furnishing = mysqli_real_escape_string($dbc, trim($_POST["furnishing"]));
    $bedrooms = intval($_POST["bedrooms"]);
    $bathrooms = intval($_POST["bathrooms"]);
    $car_parks = intval($_POST["car_parks"]);
    $facilities = verify_array($dbc, "facilities");
    $description = mysqli_real_escape_string($dbc, trim($_POST["description"]));
    $green_building_certification = mysqli_real_escape_string($dbc, trim($_POST["green_building_certification"]));
    $assessment_date = mysqli_real_escape_string($dbc, trim($_POST["assessment_date"]));

    
	// Register the property in the database...
		
	// Make the query:
	$q = "INSERT INTO property
        (address, city, state, property_type, listing_type, price, floor_size, user_id, description, 
        furnished, no_of_bedrooms, no_of_bathrooms, no_of_carparks, upload_date, construction_date, certificates)
        VALUES('$address', '$city', '$state', '$property_type', '$listing_type', $asking_price, $floor_size, $user_id, '$description', '$furnishing', 
        $bedrooms, $bathrooms, $car_parks, '$upload_date', $year_completion, '$green_building_certification');";
	$r = @mysqli_query ($dbc, $q); // Run the query.
	if ($r) { // If it ran OK.
            
        include ("property_feature.php"); //For features
        include ("property_image.php"); //For images
        include ("property_approval.php"); //For admin approval

        $q = "SELECT property_id FROM property WHERE user_id = $user_id AND upload_date = '$upload_date'"; //get property_id of the recent property
        $r = @mysqli_query($dbc, $q);
        $property_id = mysqli_fetch_assoc($r)["property_id"];

        // Upload and handle photos
        $targetDirectory = "../Images/";
        $uploadedPhotos = array();

        if (!empty($_FILES["photos"]["name"])) {
            $totalPhotos = count($_FILES["photos"]["name"]); //Count number of photos
            
            //Upload photos accordingly
            for ($i = 0; $i < $totalPhotos; $i++) {
                $temp = explode(".", $_FILES["photos"]["name"][$i]);
                $newfilename = 'ECOP' . $property_id . $i . '.' . end($temp);
                $targetFile = $targetDirectory . $newfilename; //Specifies image folder
                move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $targetFile); //Uploads photo to folder
                $uploadedPhotos[] = $targetFile;
            }
        }

        $check1 = add_features($dbc, $property_id, $facilities);
        $check2 = send_approval($dbc, $property_id, $assessment_date);
        $check3 = add_img($dbc, $property_id, $uploadedPhotos);
        
        if($check3 == 1){
            redirect_user("show_property.php?id=$property_id&img>=1");
        }
        elseif($check3 == 2){
            redirect_user("show_property.php?id=$property_id");
        }
		
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
?>
<html lang = "en">
    <head>
        <title>Add Property Page</title>
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
                        <a class="titlebolder" href="addproperty.php">ADVERTISE</a>
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

        <!--Add Property Page Content Section-->
        <div class="apformbg">
            <div class="apformtitle">Add Advertised Property</div>
            <div class="apformborder">
                <form action="addproperty.php" method="post" enctype="multipart/form-data">
                    <!-- Property Information -->
                    <div class="apformsectitle">Property Information</div>
                    <div class="apformsecbox">
                        <div class="quecolrow"><label for="listing_type" class="quetitle">For Sale / For Rent:</label></div>
                        <select id="listing_type" name="listing_type" class="queselectbox" required>
                            <option value="Sale">For Sale</option>
                            <option value="Rent">For Rent</option>
                        </select>

                        <br><div class="quecolrow"><label for="property_type" class="quetitle">Property Type:</label></div>
                        <select id="property_type" name="property_type" class="queselectbox" required>
                            <option value="Apartment">Apartment</option>
                            <option value="Condominium">Condominium</option>
                            <option value="Townhouse">Townhouse</option>
                            <option value="Bungalow">Bungalow</option>
                        </select>

                        <br><div class="quecolrow"><label for="state" class="quetitle">State:</label></div>
                        <select id="state" name="state" class="queselectbox" required>
                            <option value="Johor">Johor</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Melaka">Melaka</option>
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Penang">Penang</option>
                            <option value="Perak">Perak</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Labuan">Labuan</option>
                            <option value="Putrajaya">Putrajaya</option>
                        </select>

                        <br><div class="quecolrow"><label for="city" class="quetitle">Suburb / City / Town:</label></div>
                        <input type="text" id="city" name="city" class="queansbox" required maxlength="50">

                        <br><div class="quecolrow"><label for="address" class="quetitle">Address:</label></div>
                        <input type="text" id="address" name="address" class="queansbox" required maxlength="100">

                        <br><div class="quecolrow"><label for="asking_price" class="quetitle">Asking Price:</label></div>
                        <input type="number" id="asking_price" name="asking_price" class="queansbox" required max="1000000000">

                        <br><div class="quecolrow"><label for="floor_size" class="quetitle">Floor Size (sq. ft.):</label></div>
                        <input type="number" id="floor_size" name="floor_size" class="queansbox" required max="1000000">
                    </div>

                    <!-- Additional Information -->
                    <div class="apformsectitle">Additional Information</div>
                    <div class="apformsecbox">
                        <div class="quecolrow"><label for="year_completion" class="quetitle">Year of Completion:</label></div>
                        <input id="year_completion" name="year_completion" type="number" class="queansbox" min="1900" max="<?php echo date("Y"); ?>" step="1" value="2016" />

                        <br><div class="quecolrow"><label for="furnishing" class="quetitle">Furnished:</label></div>
                        <select id="furnishing" name="furnishing" class="queselectbox" required>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>

                        <br><div class="quecolrow"><label for="bedrooms" class="quetitle">No. of Bedrooms:</label></div>
                        <input type="number" id="bedrooms" name="bedrooms" class="queansbox" required max="127">

                        <br><div class="quecolrow"><label for="bathrooms" class="quetitle">No. of Bathrooms:</label></div>
                        <input type="number" id="bathrooms" name="bathrooms" class="queansbox" required max="127">

                        <br><div class="quecolrow"><label for="car_parks" class="quetitle">No. of Car Parks:</label></div>
                        <input type="number" id="car_parks" name="car_parks" class="queansbox" required max="127">

                        <br><div class="quecolrowrb"><label for="facilities" class="quetitle">Facilities:</label></div>
                        <div class="queradioans">
                            <?php
                                include ("property_feature.php");
                                all_features($dbc);
                            ?>
                        </div>

                        <br><div class="quecolrowtb1"><label for="description" class="quetitle">Description:</label></div>
                        <textarea id="description" name="description" rows="1" class="queanstextbox" required maxlength="7500"></textarea>

                        <br><div class="quecolrowtb2"><label for="green_building_certification" class="quetitle">Green Building Certification:</label></div>
                        <textarea id="green_building_certification" name="green_building_certification" rows="1" class="queanstextbox" maxlength="7500"></textarea>

                        <br><div class="quecolrow"><label for="photos" class="quetitle">Photos (Upload File):</label></div>
                        <input type="file" id="photos" name="photos[]" accept="image/*" class="queuploadtext" multiple required>

                        <br><div class="quecolrowdb"><label for="assessment_date" class="quetitle">Preferred Date for Sustainability Assessment:</label></div>
                        <input class ="quedatebox" type="date" name="assessment_date" id="assessment_date" min="<?php $current_date = getdate(time() + 604800); echo "$current_date[year]-$current_date[mon]-$current_date[mday]" ?>">
                    </div>
                    <div><button type="submit" class="formsubmitbutton">Submit</button></div>
                </form>
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