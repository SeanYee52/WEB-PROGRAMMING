<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include ('mysqli_connect.php');

    // Retrieve form data
    $title = mysqli_real_escape_string($dbc, trim($_POST["title"]));
    $minprice = mysqli_real_escape_string($dbc, trim($_POST["minprice"]));
    $maxprice = mysqli_real_escape_string($dbc, trim($_POST["maxprice"]));
    $state = mysqli_real_escape_string($dbc, trim($_POST["state"]));
    $rooms = mysqli_real_escape_string($dbc, trim($_POST["rooms"]));
    $square_feet = mysqli_real_escape_string($dbc, trim($_POST["square_feet"]));
    $property_type = mysqli_real_escape_string($dbc, trim($_POST["property_type"]));
   
}
else {
	$q = "SELECT name, type, no_of_bedrooms + no_of_bathrooms AS rooms, floor_size, price, sustainability_rating FROM property ORDER BY sustainability_rating LIMIT $start, $display";		
	$r = @mysqli_query ($dbc, $q); // Run the query.
}

// Number of records to show per page:
$display = 5;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(property_id) FROM property";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}


// Table header:
echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr>
	<td align="left"><b>Edit</b></td>
	<td align="left"><b>Delete</b></td>
	<td align="left"><b><a href="view_users.php?sort=ln">Last Name</a></b></td>
	<td align="left"><b><a href="view_users.php?sort=fn">First Name</a></b></td>
	<td align="left"><b><a href="view_users.php?sort=rd">Date Registered</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_user.php?id='. $row['user_id'] .'">Edit</a></td>
		<td align="left"><a href="delete_user.php?id='. $row['user_id'] .'">Delete</a></td>
		<td align="left">' . $row['last_name'] .  '</td>
		<td align="left">' . $row['first_name'] . '</td>
		<td align="left">' . $row['dr'] . '</td>
	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_users.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section. 
?>

<form id="propertyForm" action="property_search.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title">

    <label for="minprice">Minimum Price:</label>
    <input type="number" id="minprice" name="minprice">

    <label for="maxprice">Minimum Price:</label>
    <input type="number" id="maxprice" name="maxprice">

    <label for="state">State:</label>
    <input type="text" id="state" name="state">

    <label for="rooms">Number of Rooms:</label>
    <input type="number" id="rooms" name="rooms">

    <label for="square_feet">Square Feet:</label>
    <input type="number" id="square_feet" name="square_feet">

    <label for="year_built">Year Built:</label>
    <input type="number" id="year_built" name="year_built">

    <label for="property_type">Property Type:</label>
    <select id="property_type" name="property_type">
        <option value="apartment">Apartment</option>
        <option value="condo">Condominium</option>
        <option value="townhouse">Townhouse</option>
        <option value="bungalow">Bungalow</option>
    </select>

    <input type="submit" name="submit" value="Search" />
</form>