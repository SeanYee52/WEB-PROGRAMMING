<?php

// This script retrieves all the records from the features table

require ('mysqli_connect.php'); // Connect to the db
		
// Make the query:
$q = "SELECT * FROM features";
$r = @mysqli_query($dbc, $q); // Run the query

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<input type="checkbox" id="facilities" name="facilities[]" value="' . $row['feature_id'] . '"> ' . $row['feature'];
	}
	
	mysqli_free_result ($r); // Free up the resources

} else { // If no records were returned

	echo '<p class="error">There are currently no features available.</p>';

}

mysqli_close($dbc); // Close the database connection

?>