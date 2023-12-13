<?php
//A short function to add multiple features into one property
function add_features($dbc, $property_id, $features){

    if (!empty($features)) {
        //Loops through until all features have been added
        for ($i = 0; $i < count($features); $i++){
            // Make the query
            $q = "INSERT INTO property_features (property_id, feature_id) VALUES ($property_id, '$features[$i]')";
            $r = @mysqli_query ($dbc, $q); // Run the query
        }
        return 1;
    }
    else{
        return 0;
    }

}

function all_features($dbc){
    // Make the query
    $q = "SELECT * FROM features";
    $r = @mysqli_query($dbc, $q); // Run the query

    // Count the number of returned rows
    $num = mysqli_num_rows($r);

    if ($num > 0) { // If it ran OK, display the records
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        //For addproperty page
		echo '<input type="checkbox" id="facilities" name="facilities[]" value="' . $row['feature_id'] . '"> ' . $row['feature']; 
	}
	
	mysqli_free_result ($r); // Free up the resources

    } else { // If no records were returned

	echo '<p class="error">There are currently no features available.</p>';

    }
}

?>