<html lang = "en">
    <head>
        <title>Search Property Page</title>
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
                        <a href="property_search.php?type=sale"
                            <?php 
                            if(isset($_GET)){
                                if($_GET['type'] == "sale"){
                                    echo 'style="font-weight: bolder;"';
                                }
                            } 
                            ?>
                        >
                            BUY
                        </a>
                    </div>
                    <div>
                        <a href="property_search.php?type=rent"
                        <?php 
                            if(isset($_GET)){
                                if($_GET['type'] == "rent"){
                                    echo 'style="font-weight: bolder;"';
                                }
                            } 
                            ?>
                        >
                            RENT
                        </a>
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

        <!--Search Property Page Content Section-->
        <div class="spbg">
            <div class="spsearchbox">
                <form id="propertyForm" action="property_search.php?type=<?php echo $_GET['type']?>" method="POST">
                    <div class="spsearchbar1">
                        <select class="spsb1drop" id="state" name="state">
                            <option value="">All States</option>
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
                        <input class="spsb1textbox" type="text" id="title" name="title" placeholder="Search by Address or Property Name">
                        <input class="spsubmitbutton" type="submit" name="submit" value="Search" />
                    </div>
                    <div class="spsearchbar2">
                        <div class="spsb2optionspace">
                            <label class="spsb2optiontitle" for="property_type">Property Type</label>
                            <div class="spsb2optiontitlespace"></div>
                            <select class="spsb2optionbox" id="property_type" name="property_type">
                                <option value="">Any Residential</option>
                                <option value="apartment">Apartment</option>
                                <option value="condo">Condominium</option>
                                <option value="townhouse">Townhouse</option>
                                <option value="bungalow">Bungalow</option>
                            </select>
                        </div>
                        <div class="spsb2optionspace">
                            <label class="spsb2optiontitle" for="minprice">Minimum Price</label>
                            <div class="spsb2optiontitlespace"></div>
                            <input class="spsb2optionbox" type="number" id="min_price" name="min_price" placeholder="Any">
                        </div>
                        <div class="spsb2optionspace">
                            <label class="spsb2optiontitle" for="maxprice">Maximum Price</label>
                            <div class="spsb2optiontitlespace"></div>
                            <input class="spsb2optionbox" type="number" id="max_price" name="max_price" placeholder="Any">
                        </div>
                        <div class="spsb2optionspace">
                            <label class="spsb2optiontitle" for="square_feet">Floor Size</label>
                            <div class="spsb2optiontitlespace"></div>
                            <input class="spsb2optionbox" type="number" id="square_feet" name="square_feet" placeholder="Any">
                        </div>
                        <div class="spsb2optionspace">
                            <label class="spsb2optiontitle" for="rooms">Number of Rooms</label>
                            <div class="spsb2optiontitlespace"></div>
                            <input class="spsb2optionbox" type="number" id="rooms" name="rooms" placeholder="Any">
                        </div>
                        <div class="spsb2optionspace">
                            <label class="spsb2optiontitle" for="rating">Sustainability Rating</label>
                            <div class="spsb2optiontitlespace"></div>
                            <input class="spsb2optionbox" type="number" id="rating" name="rating" placeholder="Any">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--Search Property Page Content Section (Result)-->
        <div class="spresultsec">
            <?php
            include ("mysqli_connect.php");

            //Session timeout
            if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
                // last request was more than 30 minutes ago
                session_unset();     // unset $_SESSION variable for the run-time 
                session_destroy();   // destroy session data in storage
            }
            $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

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
            $pages = false;

            //Build the WHERE clause based on the inputs
            $whereClause = buildWhereClause($searchInputs);

            //Construct the SQL query
            $q = "SELECT * FROM property $whereClause AND property_id IN (SELECT property_id FROM property_approval WHERE admin_id IS NOT NULL and approval_date IS NOT NULL)
             ORDER BY (building_rating + renewable_rating + energy_rating + water_rating) DESC;";
            $result = @mysqli_query($dbc, $q);

            //Display the search results

            if (mysqli_num_rows($result) >= $resultsPerPage) {
                $q = "SELECT * FROM property $whereClause AND property_id IN (SELECT property_id FROM property_approval WHERE admin_id IS NOT NULL and approval_date IS NOT NULL)
                 ORDER BY (building_rating + renewable_rating + energy_rating + water_rating) DESC LIMIT $resultsPerPage OFFSET $offset";
                $result = @mysqli_query($dbc, $q);
                $pages = true;
            }

            if (mysqli_num_rows($result) > 0) {

                while ($property = mysqli_fetch_assoc($result)) {

                    $property_id = $property['property_id'];

                    // Check if approved
                    $q = "SELECT * FROM property_approval WHERE property_id = $property_id AND approval_date IS NOT NULL";
                    $r = @mysqli_query($dbc, $q);

                    if(mysqli_num_rows($r) > 0){

                        echo "<div class='propertyresult'>";
                        $q = "SELECT * FROM property_image WHERE property_id = $property_id LIMIT 1;";
                        $r = @mysqli_query($dbc, $q);
                        if ($r){
                            while ($image = mysqli_fetch_assoc($r)){
                                echo '<img style="width:380px;height:220px;object-fit: cover;" src="'. $image["img_dir"] . '">';
                            }
                        }

                        echo "<div class='propertyresultdetail'>";
                        echo "<div class='propertytitle'>" . $property['address'] . "</div>";
                        echo "<div class='pdetailsecbox'>";
                        echo "<div class='pdetailsec'>";
                        echo "<div class='propertydetail'>State: " . $property['state'] . "</div>";
                        echo "<div class='propertydetail'>Type: " . $property['property_type'] . "</div>";
                        echo "<div class='propertydetail'>Rooms: " . $property['no_of_bedrooms'] + $property['no_of_bathrooms'] . "</div>";
                        echo "</div>";
                        echo "<div class='pdetailsec'>";
                        echo "<div class='propertydetail'>Floor Size: " . $property['floor_size'] . " sq. ft.</div>";
                        echo "<div class='propertydetail'>Price: $" . $property['price'] . "</div>";
                        $build_rate = $property['building_rating'];
                        $renew_rate = $property['renewable_rating'];
                        $energy_rate = $property['energy_rating'];
                        $water_rate = $property['water_rating'];
                        $total_rate = ($build_rate + $renew_rate + $energy_rate + $water_rate) / 4; // Average rating
                        echo "<div class='propertydetail'>Rating: " . $total_rate . "</div>";
                        echo "</div>";
                        echo "</div>";

                        echo '<br><a class="learnmorebutton" href="show_property.php?id=' . $property_id. '">Learn More</a>';

                        echo "</div>";
                        echo "</div>";

                    }
                }

                if ($pages){
                    // Add pagination links
                    $q = "SELECT COUNT(*) AS total FROM property $whereClause";
                    $result = @mysqli_query($dbc, $q);
                    $row = mysqli_fetch_assoc($result);
                    $totalPages = ceil($row['total'] / $resultsPerPage);

                    echo "<div class='pagination'>";
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo "<a class='sppagenumber' href='?page=$i&type=" . $searchInputs['type'] . "'>$i</a>";
                    }
                    echo "</div>";
                }
                
            } else {
                echo "<div class='nomatchproperty'>No properties found matching the criteria.</div>";
            }

            ?>
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
