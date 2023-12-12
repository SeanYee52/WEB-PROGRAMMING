<?php
include_once ("mysqli_connect.php");

//Pagination variables
$resultsPerPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $resultsPerPage;

//Construct the SQL query
$q = "SELECT * FROM property";


//Display the search results

if (mysqli_num_rows($result) >= 5) {
    $q = "SELECT * FROM property $whereClause LIMIT $resultsPerPage OFFSET $offset";
    $result = @mysqli_query($dbc, $q);
}

if ($result) {
    while ($property = mysqli_fetch_assoc($result)) {
        echo "<h2>" . $property['address'] . "</h2>";
        echo "<p>State: " . $property['state'] . "</p>";
        echo "<p>Type: " . $property['property_type'] . "</p>";
        echo "<p>Rooms: " . $property['no_of_bedrooms'] + $property['no_of_bathrooms'] . "</p>";
        echo "<p>Floor Size: " . $property['floor_size'] . " sq. ft.</p>";
        echo "<p>Price: $" . $property['price'] . "</p>";
        echo "<p>Rating: " . $property['sustainability_rating'] . "</p>";

        $q = "SELECT * FROM property_image WHERE property_id = ".$property['property_id'].";";
        $r = @mysqli_query($dbc, $q);

        if ($r){
            while ($image = mysqli_fetch_assoc($r)){
                echo '<img style="width:300px;height:300px;object-fit: cover;" src="'. $image["img_dir"] . '">';
            }
        }

        echo "<hr>";
    }

    // Add pagination links
    $q = "SELECT COUNT(*) AS total FROM property $whereClause";
    $result = @mysqli_query($dbc, $q);
    $row = mysqli_fetch_assoc($result);
    $totalPages = ceil($row['total'] / $resultsPerPage);

    echo "<div class='pagination'>";
    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='?page=$i'>$i</a>";
    }
    echo "</div>";
} else {
    echo "No properties found matching the criteria.";
}

?>