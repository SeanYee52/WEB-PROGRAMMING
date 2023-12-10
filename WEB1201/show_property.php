<?php

// Database Connection
include_once ("mysqli_connect.php");
// Redirect function
include_once ("login_functions.inc.php");

//Starts session
session_start();

// Assign property id and redirect user if id does not exist
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $property_id = $_GET['id'];
}
else{
    redirect_user("home.php");
}

// Query
$q = "SELECT * FROM property WHERE property_id = $property_id";
$r = @mysqli_query($dbc, $q);

// Assign property into database
// If property does not exist
if (mysqli_num_rows($r) == 0){
    echo '<script>alert("Property does not exist")</script>';
    redirect_user("home.php");
}
// Assign variables to data from query
else{
    
    $property = mysqli_fetch_assoc($r);

    // Full Address
    $address = $property['address'];
    $city = $property['city'];
    $state = $property['state'];
    $full_address = $address . ", " . $city . ", " . $state;

    // Sustainability Ratings
    $build_rate = $property['building_rating'];
    $renew_rate = $property['renewable_rating'];
    $energy_rate = $property['energy_rating'];
    $water_rate = $property['water_rating'];
    $total_rate = ($build_rate + $renew_rate + $energy_rate + $water_rate) / 4; // Average rating

    // Rooms
    $bedrooms = $property['no_of_bedrooms'];
    $bathrooms = $property['no_of_bathrooms'];
    $carparks = $property['no_of_carparks'];
    $furnished = $property['furnished']; // Either 'yes' or 'no' only

    // Dates
    $construction_date = $property['construction_date']; // YEAR ONLY
    $upload_date = $property['upload_date']; // User will only see date, Admin will see datetime, difference will be handled on their respective .php files

    // Floor and Price
    $floor_size = $property['floor_size'];
    $price = $property['price'];

    // Type
    $property_type = $property['property_type'];
    $listing_type = $property['listing_type'];

    // Decription
    $description = $property['description'];

    // Features
    $q = "SELECT feature FROM features WHERE feature_id IN 
    (SELECT feature_id FROM property_features WHERE property_id = $property_id);";
    $r = @mysqli_query($dbc, $q);

    $Features = $r; // Use loop to display on the display page

    // Certificates
    $Certificates = explode(",", $property['certificates']); // To display like a list

    // User Details
    $user_id = $property['user_id'];
    $q = "SELECT username, phone_no, email, profile_img_dir FROM user WHERE user_id = $user_id;";
    $r = @mysqli_query($dbc, $q);

    if (mysqli_num_rows($r) == 1){
        $user = mysqli_fetch_assoc($r);
        $email = $user['email'];
        $phone = $user['phone_no'];
        $username = $user['username'];
        $profile = $user['profile_img_dir'];
    }
    else{
        echo '<script>alert("Error with finding user for property")</script>'; 
    }
}

// Include different files according to user, and redirect if session is not set properly
if ((!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) && (!isset($_SESSION['admin_id']) || !isset($_SESSION['name']))){
    session_unset();
    session_destroy();
    redirect_user("login.php");
}
elseif (isset($_SESSION['admin_id'])){
    $admin_id = $_SESSION['admin_id'];
    include_once("show_property_admin.php");
}
else{
    $user_id = $_SESSION['user_id'];
    include_once("show_property_user.php");
}

?>