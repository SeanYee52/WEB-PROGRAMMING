<?php
session_start();
if (isset($_SESSION["user_id"])){
    $user_id = $_SESSION["user_id"];
}
else{
    redirect_user("home.php"); //temporary
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

    // Upload and handle photos
    $targetDirectory = "../Images/";
    $uploadedPhotos = array();

    if (!empty($_FILES["photos"]["name"])) {
        $totalPhotos = count($_FILES["photos"]["name"]); //Count number of photos
        
        //Upload photos accordingly
        for ($i = 0; $i < $totalPhotos; $i++) {
            $targetFile = $targetDirectory . basename($_FILES["photos"]["name"][$i]); //Specifies image folder
            move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $targetFile); //Uploads photo to folder
            $uploadedPhotos[] = $targetFile;
        }
    }


	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO property
            (address, city, state, property_type, listing_type, price, floor_size, user_id, description, furnished, no_of_bedrooms, no_of_bathrooms, no_of_carparks, upload_date, construction_date, certificates)
            VALUES('$address', '$city', '$state', '$property_type', '$listing_type', $asking_price, $floor_size, $user_id, '$description', '$furnishing', $bedrooms, $bathrooms, $car_parks, '$upload_date', $year_completion, '$green_building_certification');";
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
            
            include ("property_feature.php");
            include ("property_image.php");
            include ("property_approval.php");

            $q = "SELECT property_id FROM property WHERE user_id = $user_id AND upload_date = '$upload_date'"; //get property_id of the recent property
            $r = @mysqli_query($dbc, $q);
            $property_id = mysqli_fetch_assoc($r)["property_id"];

            $check1 = add_features($dbc, $property_id, $facilities);
            $check2 = send_approval($dbc, $property_id, $assessment_date);
            $check3 = add_img($dbc, $property_id, $uploadedPhotos);
            echo "adding features:". $check1 ."<br>adding approval". $check2 ."";
			// Print a message:
			echo '<h1>Thank you!</h1>
		    <p>You are now registered successfully.</p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>
<html>
<form action="addproperty.php" method="post" enctype="multipart/form-data">

    <!-- Property Information -->
    <h3>Property Information</h3>
    <label for="listing_type">For Sale / For Rent:</label>
    <select id="listing_type" name="listing_type" required>
        <option value="sale">For Sale</option>
        <option value="rent">For Rent</option>
    </select>

    <label for="property_type">Property Type:</label>
    <select id="property_type" name="property_type" required>
        <option value="apartment">Apartment</option>
        <option value="condo">Condominium</option>
        <option value="townhouse">Townhouse</option>
        <option value="bungalow">Bungalow</option>
    </select>

    <label for="state">State:</label>
    <select id="state" name="state" required>
        <option value="Johor">Johor</option>
        <option value="Kedah">Kedah</option>
        <option value="Kelantan">Kelantan</option>
        <option value="Melaka">Melaka</option>
        <option value="Negeri Sembilan">Negeri Sembilan</option>
        <option value="Pahang">Pahan</option>
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

    <label for="city">Suburb / City / Town:</label>
    <input type="text" id="city" name="city" required>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required>

    <label for="asking_price">Asking Price:</label>
    <input type="number" id="asking_price" name="asking_price" required>

    <label for="floor_size">Floor Size (sq. ft.):</label>
    <input type="number" id="floor_size" name="floor_size" required>

    <!-- Additional Information -->
    <h3>Additional Information</h3>
    <label for="year_completion">Year of Completion:</label>
    <input id="year_completion" name="year_completion" type="number" min="1900" max="<?php echo date("Y"); ?>" step="1" value="2016" />

    <label for="furnishing">Furnished:</label>
    <select id="furnishing" name="furnishing" required>
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select>

    <label for="bedrooms">No. of Bedrooms:</label>
    <input type="number" id="bedrooms" name="bedrooms" required>

    <label for="bathrooms">No. of Bathrooms:</label>
    <input type="number" id="bathrooms" name="bathrooms" required>

    <label for="car_parks">No. of Car Parks:</label>
    <input type="number" id="car_parks" name="car_parks" required>

    <label for="facilities">Facilities:</label>
    <?php
        include ("property_feature.php");
        all_features($dbc);
    ?>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required></textarea>

    <label for="green_building_certification">Green Building Certification:</label>
    <textarea id="green_building_certification" name="green_building_certification" rows="4"></textarea>

    <label for="photos">Photos (Upload File):</label>
    <input type="file" id="photos" name="photos[]" accept="image/*" multiple>

    <label for="assessment_date">Preferred Date for Sustainability Assessment:</label>
    <input type="date" name="assessment_date" id="assessment_date" min="<?php $current_date = getdate(); echo "$current_date[mday]-$current_date[mon]-$current_date[year]" ?>">

    <button type="submit">Submit</button>
</form>
</html>