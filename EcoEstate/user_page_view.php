<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <style>

        section {
            max-width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        section.banner{
            background-image: url('<?php echo $banner_img;?>'); 
            max-width: 100%;
            background-repeat: no-repeat;
            background-attachment: fixed; 
            background-size: 100% 100%;
            margin:0;
            transition: background-color 2s;
        }

        img.profile-pic{
            border-radius: 50%;
            width: 200px;
            height: 200px;
            object-fit: cover;
            transition: filter 2s;
        }

        img.property-pic{
            width: 300px;
            height: 300px;
            object-fit: cover;
        }

        #popup-image, #popup-name, #popup-about, #popup-contact, #popup-pass, #popup-delete {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        #popup, #popup h2, #popup p{
            cursor: pointer;
            font-family: Roboto;
        }

        #popup:hover, #popup h2:hover, #popup p:hover{
            cursor: pointer;
            font-weight:bolder;
            color: #799ecf;
        }

        section.property{
            display: flex;
            width: 80%;
            flex-wrap: wrap;
        }

        div.property{
            width: 33%; /* Each column takes up 50% of the container */
            padding: 10px;
            box-sizing: border-box;
        }

        div.pagination{
            flex: 100%;
        }

        .rating-container {
            width: 75px;
            height: 75px;
            line-height: 45px;
            border-radius: 50%; /* Half of the height for a rounded appearance */
            overflow: hidden;
        }

        .rating-container p{
            text-align: center;
        }
    </style>
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
                        <a href="addproperty.php">ADVERTISE</a>
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

        <?php
         if (!empty($errors)) {
            echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
            foreach ($error as $msg) { // Print each error.
                echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br /></p>';
        }
        ?>

        <section>
            <section class="banner">
                <section style="max-width: 30%; margin: 20px auto 20px 20px">
                    <img class="profile-pic" src="<?php echo $profile_img; ?>" alt="User Profile Picture">
                    <h1 style="font-size: 32px;"><?php echo $username; ?></h1>
                    <p><strong>Join Date:</strong> <?php echo $join_date;?></p>
                    <p><strong>User ID:</strong> ECOR<?php echo $user_id;?></p>
                </section>
            </section>
            <p ><strong>About Me:</strong> <?php echo $about_me;?></p>
            <!-- User Page Banner -->

            <!-- Contact Information -->
            <div class="contact-info">
                <hr>
                <h2>Contact Information</h2>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone Number:</strong> <a href="tel:<?php echo $phone_no; ?>"><?php echo $phone_no; ?></a></p>
            </div>
        </section>

        <section class="property">
            <h2 style="flex: 100%;">Associated Properties</h2>
                <?php
                    //Pagination variables
                    $resultsPerPage = 3;
                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                    $offset = ($page - 1) * $resultsPerPage;
                    $pages = false; // Check if results exceeds limit

                    //Construct the SQL query
                    if (isset($_SESSION['admin_id'])){
                        $q = "SELECT * FROM property WHERE user_id = $user_id ORDER BY upload_date DESC";
                        $result = @mysqli_query($dbc, $q);
                    }
                    else{
                        $q = "SELECT * FROM property 
                        WHERE user_id = $user_id AND property_id IN (SELECT property_id FROM property_approval WHERE approval_date IS NOT NULL) 
                        ORDER BY upload_date DESC";
                        $result = @mysqli_query($dbc, $q);
                    }

                    //Check if results exceed limit
                    if (mysqli_num_rows($result) >= $resultsPerPage) {
                        $q = "SELECT * FROM property WHERE user_id = $user_id ORDER BY upload_date DESC LIMIT $resultsPerPage OFFSET $offset ";
                        $result = @mysqli_query($dbc, $q);
                        $pages = true;
                    }

                    //Display the search results
                    if (mysqli_num_rows($result) != 0) {
                        while ($property = mysqli_fetch_assoc($result)) {
                        
                            // Images
                            $q = "SELECT * FROM property_image WHERE property_id = " . $property['property_id'] . " LIMIT 1;";
                            $r = @mysqli_query($dbc, $q);
                            $image = mysqli_fetch_assoc($r);

                            // Approval date
                            $q = "SELECT approval_date FROM property_approval 
                            WHERE property_id = " . $property['property_id'] . " && approval_date IS NOT NULL;";
                            $r = @mysqli_query($dbc, $q);
                            $approval = mysqli_fetch_assoc($r);

                            if(isset($_SESSION['admin_id']) || mysqli_num_rows($r) >0){
                                echo '<div class="property">';

                                echo "<img class='property-pic' src='" . $image['img_dir'] . "'>";
                                echo "<h3>" . $property['address'] . ", " . $property['city'] . "</h3>";
                                echo "<p>" . $property['state'] . "</p>";
                                echo "<p>RM " . $property['price'] . "</p>";
                                echo "<p>For " . $property['listing_type'] . "</p>";
                                echo "<p>" . $property['property_type'] . "</p>";
                                echo "<p>" . $property['floor_size'] . " sq. ft</p>";
                                echo "<p>Upload Date: " . $property['upload_date'] . "</p>";

                                if(mysqli_num_rows($r) > 0){
                                    echo "<p>Approved Date: " . $approval['approval_date'] . "</p>";
                                }
                                else{
                                    echo "<p>Approved Date: NOT APPROVED</p>";
                                }

                                // Sustainability Ratings
                                $build_rate = $property['building_rating'];
                                $renew_rate = $property['renewable_rating'];
                                $energy_rate = $property['energy_rating'];
                                $water_rate = $property['water_rating'];
                                $total_rate = round(($build_rate + $renew_rate + $energy_rate + $water_rate) / 4, 1); // Average rating

                                if ($total_rate >= 0 && $total_rate <= 1) {
                                    $color= "#ff0000"; // Red
                                } elseif ($total_rate > 1 && $total_rate <= 2) {
                                    $color= "#ff6600"; // Orange
                                } elseif ($total_rate > 2 && $total_rate <= 3) {
                                    $color= "#ffcc00"; // Yellow
                                } elseif ($total_rate > 3 && $total_rate <= 4) {
                                    $color= "#99ff33"; // Light Green
                                } elseif ($total_rate > 4 && $total_rate <= 5) {
                                    $color= "#00cc00"; // Dark Green
                                } else {
                                    $color= "#ff0000"; // Default to red for invalid rating
                                }

                                echo '<div class="rating-container" style="background-color: ' . $color . ';">
                                <p>' . $total_rate . '</p>
                                </div>';

                                echo '<br><a href="show_property.php?id=' . $property['property_id'] . '">More Details</a>';
                                echo '</div>';
                            }
                        }

                        if($pages){
                            // Add pagination links
                            if(isset($_SESSION['admin_id'])){
                                $q = "SELECT COUNT(*) AS total FROM property WHERE user_id = $user_id";
                            }   
                            else{
                                $q = "SELECT COUNT(*) AS total FROM property WHERE user_id = $user_id 
                                AND property_id IN (SELECT property_id FROM property_approval WHERE approval_date IS NOT NULL)";
                            }
                            
                            $result = @mysqli_query($dbc, $q);
                            $row = mysqli_fetch_assoc($result);
                            $totalPages = ceil($row['total'] / $resultsPerPage);
                        
                            echo "<div class='pagination'>";
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo "<a href='?user_id=$user_id&page=$i'>$i</a>";
                            }
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No property to show</p>";
                    }
                ?>
        </section>

        <?php
        if(isset($_SESSION['admin_id']) && isset($_SESSION['name'])){
            echo '<section>
                    <h2>Account Settings</h2>
                    <h3 id="popup" onclick="openPopupFormDelete()">Delete Account</h3>
                </section>';
        }
        ?>

        <!-- Popup Edit -->
        <div id="overlay" onclick="closePopupForm()"></div>

        <?php
            if(isset($_SESSION['admin_id']) && isset($_SESSION['name'])){
                echo 
                '<div id="popup-delete">
                    <h2>Delete Account</h2>
                    <form action="user_page_delete.php" method="post"enctype="multipart/form-data">
                        <!-- Your form fields go here -->
                        <p>Are You Sure You Want To Delete Your Account</p>

                        <br><br><button name="user_id" type="submit" value="'. $user_id .'">Yes</button>
                    </form>
                    <button onclick="closePopupForm()">No</button>
                </div>';
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

        <script>

        function openPopupFormDelete() {
            document.getElementById("popup-delete").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closePopupForm() {
            document.getElementById("popup-delete").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
        </script>

    </body>
</html>
