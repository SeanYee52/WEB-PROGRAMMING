<?php
include ("mysqli_connect.php");

// Function to build the WHERE clause based on provided inputs
function buildWhereClause($inputs)
{
    $conditions = array();

    if (!empty($inputs['title'])) {
		$conditions[] = "name LIKE '%" . $inputs['title'] . "%'";
    }

    if (!empty($inputs['state'])) {
		$conditions[] = "state = '" . $inputs['state'] . "'";
    }

    if (!empty($inputs['property_type'])) {
        $conditions[] = "property_type = '" . $inputs['property_type'] . "'";
    }

    if (!empty($inputs['rooms'])) {
        $conditions[] = "(no_of_bedrooms + no_of_bathrooms) >= " . $inputs['rooms']; //To calculate total rooms
    }

    if (!empty($inputs['floor_size'])) {
        $conditions[] = "floor_size >= " . $inputs['floor_size'];
    }

    if (!empty($inputs['min_price'])) {
        $conditions[] = "price >= " . $inputs['min_price'];
    }

    if (!empty($inputs['max_price'])) {
        $conditions[] = "price <= " . $inputs['max_price'];
    }

    if (!empty($inputs['rating'])) {
        $conditions[] = "sustainability_rating >= " . $inputs['rating'];
    }

	//Forms Where Clauses
    if (!empty($conditions)) {
        return "WHERE " . implode(" AND ", $conditions);
    } else {
        return "";
    }
}

// Retrieve search inputs
$searchInputs = array(
    'title' => isset($_POST['title']) ? '%' . $_POST['title'] . '%' : null,
    'state' => isset($_POST['state']) ? $_POST['state'] : null,
    'property_type' => isset($_POST['property_type']) ? $_POST['property_type'] : null,
    'rooms' => isset($_POST['rooms']) ? intval($_POST['rooms']) : null,
    'floor_size' => isset($_POST['square_feet']) ? intval($_POST['square_feet']) : null,
    'min_price' => isset($_POST['min_price']) ? floatval($_POST['min_price']) : null,
    'max_price' => isset($_POST['max_price']) ? floatval($_POST['max_price']) : null,
    'rating' => isset($_POST['rating']) ? floatval($_POST['rating']) : null,
);

// Build the WHERE clause based on the inputs
$whereClause = buildWhereClause($searchInputs);

// Construct the SQL query
$sql = "SELECT * FROM property $whereClause";

// Execute the SQL query
$result = @mysqli_query($dbc, $sql);

// Display the search results
if ($result) {
    while ($property = mysqli_fetch_assoc($result)) {
        echo "<h2>" . $property['name'] . "</h2>";
        echo "<p>State: " . $property['state'] . "</p>";
        echo "<p>Type: " . $property['type'] . "</p>";
        echo "<p>Rooms: " . $property['no_of_bedrooms'] + $property['no_of_bathrooms'] . "</p>";
        echo "<p>Floor Size: " . $property['floor_size'] . " sq. ft.</p>";
        echo "<p>Price: $" . $property['price'] . "</p>";
        echo "<p>Rating: " . $property['sustainability_rating'] . "</p>";
        echo "<hr>";
    }
} else {
    echo "No properties found matching the criteria.";
}

?>

<form id="propertyForm" action="property_search.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title">

    <label for="minprice">Minimum Price:</label>
    <input type="number" id="min_price" name="min_price">

    <label for="maxprice">Maximum Price:</label>
    <input type="number" id="max_price" name="max_price">

    <label for="state">State:</label>
    <input type="text" id="state" name="state">

    <label for="rooms">Number of Rooms:</label>
    <input type="number" id="rooms" name="rooms">

    <label for="square_feet">Square Feet:</label>
    <input type="number" id="square_feet" name="square_feet">

    <label for="year_built">Sustainability Rating:</label>
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