<html lang = "en">
    <head>
        <title>Template</title>
        <meta charset = "utf-8">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
    </head>

    <body>
        <header>
            <a href="Home Page.html"><img  class="logo" src="../Images/Logo.svg"></a>
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
                            session_start();
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

<form id="propertyForm" action="property_search.php" method="POST">
    <label for="state">State:</label>
    <select id="state" name="state">
        <option value="">All States</option>
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

    <label for="title">Address:</label>
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
        <option value="">Any Residential</option>
        <option value="apartment">Apartment</option>
        <option value="condo">Condominium</option>
        <option value="townhouse">Townhouse</option>
        <option value="bungalow">Bungalow</option>
    </select>

    <input type="submit" name="submit" value="Search" />
</form>

<?php
include ("mysqli_connect.php");

//Function to build the WHERE clause based on provided inputs
function buildWhereClause($inputs)
{
    $conditions = array();

    if (!empty($inputs['title'])) {
		$conditions[] = "address LIKE '%" . $inputs['title'] . "%'";
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

    if (!empty($inputs['type'])) {
        $conditions[] = "listing_type = '". $inputs['type'] . "'";
    }

	//Forms Where Clauses
    if (!empty($conditions)) {
        return "WHERE " . implode(" AND ", $conditions);
    } else {
        return "";
    }
}

//Retrieve search inputs
$searchInputs = array(
    'title' => isset($_POST['title']) ? '%' . $_POST['title'] . '%' : null,
    'state' => isset($_POST['state']) ? $_POST['state'] : null,
    'property_type' => isset($_POST['property_type']) ? $_POST['property_type'] : null,
    'rooms' => isset($_POST['rooms']) ? intval($_POST['rooms']) : null,
    'floor_size' => isset($_POST['square_feet']) ? intval($_POST['square_feet']) : null,
    'min_price' => isset($_POST['min_price']) ? floatval($_POST['min_price']) : null,
    'max_price' => isset($_POST['max_price']) ? floatval($_POST['max_price']) : null,
    'rating' => isset($_POST['rating']) ? floatval($_POST['rating']) : null,
    'type' => isset($_GET['type']) ? $_GET['type'] : null
);

//Pagination variables
$resultsPerPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $resultsPerPage;

//Build the WHERE clause based on the inputs
$whereClause = buildWhereClause($searchInputs);

//Construct the SQL query
$q = "SELECT * FROM property $whereClause";
$result = @mysqli_query($dbc, $q);

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
