<html lang = "en">
    <head>
        <title>Property Details Page</title>
        <meta charset = "utf-8">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                min-width: 1200px;
            }

            section.details {
                padding: 20px;
                overflow: hidden;
            }

            .top {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .details {
                font-size: 24px;
                font-weight: bold;
            }

            .stars {
                display: flex;
                align-items: center;
            }

            .star-image {
                width: 30px;
                height: 30px;
                margin-right: 5px;
            }

            .sustainability-info {
                display: flex;
                align-items: center;
            }

            .save-button {
                background-color: #3498db;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .bottom {
                margin-top: 20px;
                display: flex;
                justify-content: space-between;
            }

            .column {
                width: calc(100% / 9);
                text-align: center;
            }

            section {
                max-width: 80%;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            div.images{
                padding: 0.5em 3em;
                max-height: 500px;
            }

            img.profile-pic{
                border-radius: 50%;
                width: 50px;
                height: 50px;
                object-fit: cover;
                transition: filter 2s;
                cursor: pointer;
            }

            div.mySlides, div.mySlides img{
                max-height: inherit;
            }

            div.mySlides img{
                border-radius: 20px;
                display: block;
                object-fit: cover;
                width: 1000px;
                margin-left: auto;
                margin-right: auto;
            }

            img.select {
                border-radius: 10px;
                object-fit: cover;
                width: 90%;
                height: 300px;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

            div.select-images{
                float: left;
            }

            div.select{
                box-sizing: inherit; 
                width: 1200px; 
                margin: auto;
                height: 310px;
            }


            div.column p { 
                display: inline;
            }
            
            .container-stuff {
                display: flex;
                width: 80vw;
                height: 100vh;
                margin: auto;
                padding: 20px;
                min-width: 1200px;
            }

            .left-side {
                flex: 60%;
                padding-right: 2em;
            }

            .right-side {
                flex: 40%;
                padding-left: 2em;
            }

            .top-left, .top-right, .bottom-left, .bottom-right {
                width: 100%;
                height: 50%;
                box-sizing: border-box;
                padding: 20px;
                border-radius: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 2em 1em;
            }

            div.top-right{
                column-count: 2;
                column-gap: 10px;
                column-fill: balance;
                min-height: inherit;
            }

            div.top-right ul{
                margin: 0;
            }

            .bottom-left {
                display: flex;
                flex-wrap: wrap;
            }

            div.header {
                flex: 100%;
            }

            .left-column{
                flex: 6%;
                padding: 10px;
            }

            .right-column {
                flex: 50%;
                padding: 10px;
            }

            .left-column p, .right-column p {
                margin: 0;
            }

            .bottom-left img {
                max-width: 100%;
                height: auto;
            }

            section.user{
                display: flex;
                justify-content: space-between;
                width: 80%;
                margin: 2em auto; /* Center the container */
            }

            section.user div.column{
                width: 20%; /* Adjust the width as needed */
                padding: 10px;
                box-sizing: border-box;
                text-align: left;
            }

            section.user div.column-2{
                width: 50%; /* Adjust the width as needed */
                padding: 10px;
                box-sizing: border-box;
                text-align: left;
            }

            #popup-delete{
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

            #popup-click{
                cursor: pointer;
                font-family: Roboto;
            }

            #popup-click:hover{
                cursor: pointer;
                font-weight:bolder;
                color: #799ecf;
            }

            #popup-build, #popup-renew, #popup-energy, #popup-water, #popup-delete {
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

            #popup-click{
                cursor: pointer;
                font-family: Roboto;
            }

            #popup-click:hover{
                cursor: pointer;
                font-weight:bolder;
                color: #799ecf;
            }

            .starpointalign{
                display: flex;
                align-items: center;
            }

            .starpointalignspace{
                width: 8px;
            }

            .ratealign{
                padding: 5px;
            }
        </style>
    </head>

    <body>
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

        <!--Property Details Page Content Section-->
        <div class="images">
            <?php
                // Images
                $q = "SELECT img_dir FROM property_image WHERE property_id = $property_id LIMIT 4";
                $r = @mysqli_query($dbc, $q);

                $Images = $r; // Use loop to display on the display page
                if($Images){
                    while ($image = mysqli_fetch_assoc($Images)){
                        echo '<div class="mySlides" style="position: relative; box-sizing: inherit;">
                        <img src="' . $image['img_dir'] . '" style="margin-bottom:-6px">
                        </div>';
                    }
                }
            ?>
        </div>

        <div class="select">
            <?php
                // Images
                $q = "SELECT img_dir FROM property_image WHERE property_id = $property_id LIMIT 4";
                $r = @mysqli_query($dbc, $q);

                $Images = $r; // Use loop to display on the display page

                $width = (100 / mysqli_num_rows($Images)) - 0.0001; // Set Column Width

                if($Images){
                    $i = 1;
                    while ($image = mysqli_fetch_assoc($Images)){
                        echo '<div class="select-images" style = "width: ' . $width . '%;">
                        <img class="select" src="'. $image['img_dir'] .'" style="cursor:pointer" onclick="currentDiv('. $i .')">
                        </div>';
                        $i++;
                    }
                }
            ?>
        </div>

        <section class="details">
            <div class="top">
                <div class="details">
                    <?php echo $full_address;?>
                </div>
                <div class="stars">
                    <div class="sustainability-info">
                        <?php
                        for($i = 0; $i < 5; $i++){
                            // Prints Green Star
                            if(round($total_rate) > $i){
                                echo '<img class="star-image" src="../Images/EcoEstateImages/pdstar1.svg" width="30" height="30" alt="G">';
                            }
                            // Pringts Grey Star
                            else{
                                echo '<img class="star-image" src="../Images/EcoEstateImages/pdstar2.svg" width="30" height="30" alt="B">';
                            }   
                        }
                        echo "<div class='starpointalignspace'></div>";
                        echo "<span>Sustainability: $total_rate</span>"
                        ?>
                    </div>
                    <?php

                        // Create the query
                        $q = "SELECT * FROM property_approval WHERE property_id = $property_id AND approval_date IS NOT NULL";
                        $r = @mysqli_query($dbc, $q);

                        // Button to approve property
                        if(mysqli_num_rows($r) <= 0){
                            echo '
                            <form action="show_property.php" method="get">
                                <input type="hidden" name="approve" value="1" /> 
                                <button name="id" class="save-button" type="submit" value="' . $property_id . '">Approve Property</button>
                            </form>';
                        }
                    ?>
                </div>
            </div>
            <div class="bottom">
                <div class="column">
                    <div><img src="../Images/EcoEstateImages/pdlogo1.svg" width="30" height="30" alt="Image 1"></div>
                    <p><?php echo $bedrooms; ?></p>
                </div>
                <div class="column">
                    <div><img src="../Images/EcoEstateImages/pdlogo2.svg" width="30" height="30" alt="Image 2"></div>
                    <p><?php echo $bathrooms; ?></p>
                </div>
                <div class="column">
                    <div><img src="../Images/EcoEstateImages/pdlogo3.svg" width="30" height="30" alt="Image 3"></div>
                    <p><?php echo $carparks; ?></p>
                </div>
                <div class="column">
                    <div><img src="../Images/EcoEstateImages/pdlogo4.svg" width="30" height="30" alt="Image 4"></div>
                    <p><?php
                        if ($furnished == 'yes'){
                            echo 'Furnished';
                        }
                        else{
                            echo 'Not Furnished';
                        }
                    ?></p>
                </div>
                <div class="column">
                    <div><img src="../Images/EcoEstateImages/pdlogo5.svg" width="30" height="30" alt="Image 5"></div>
                    <p><?php echo $construction_date;?></p>
                </div>
                <div class="column">
                    <div><img src="../Images/EcoEstateImages/pdlogo6.svg" width="30" height="30" alt="Image 6"></div>
                    <p><?php echo $floor_size;?></p>
                </div>
                <div class="column">
                    <div><img src="../Images/EcoEstateImages/pdlogo7.svg" width="30" height="30" alt="Image 7"></div>
                    <p>RM<?php echo $price;?></p>
                </div>
                <div class="column">
                    <div><img src="../Images/EcoEstateImages/pdlogo8.svg" width="30" height="30" alt="Image 8"></div>
                    <p><?php echo $property_type;?></p>
                </div>
                <div class="column">
                    <div><img src="../Images/EcoEstateImages/pdlogo9.svg" width="30" height="30" alt="Image 9"></div>
                    <p>For <?php echo $listing_type;?></p>
                </div>
            </div>
        </section>

        <div class="container-stuff">
            <div class="left-side">
                <div class="top-left">
                    <h1>Description</h1>
                    <hr>
                    <p>
                        <?php
                            echo $description;
                        ?>
                    </p>
                </div>
                <div class="bottom-left">
                    <div class="header">
                        <h1>Sustainability Ratings</h1>
                        <hr>
                    </div>
                    <div class="left-column">
                        <p class="ratealign" id="popup-click" onclick="openPopupFormBuild()">Building Materials:</p>
                        <p class="ratealign" id="popup-click" onclick="openPopupFormRenew()">Renewable Energy:</p>
                        <p class="ratealign" id="popup-click" onclick="openPopupFormEnergy()">Energy Efficiency:</p>
                        <p class="ratealign" id="popup-click" onclick="openPopupFormWater()">Water Efficiency:</p>
                    </div>
                    <div class="right-column">
                        <?php
                            function generateSustainabilityTier($rating) {
                                if ($rating >= 0 && $rating <= 1) {
                                    return "Low";
                                } elseif ($rating > 1 && $rating <= 2) {
                                    return "Moderate";
                                } elseif ($rating > 2 && $rating <= 3) {
                                    return "Intermediate";
                                } elseif ($rating > 3 && $rating <= 4) {
                                    return "High";
                                } elseif ($rating > 4 && $rating <= 5) {
                                    return "Exceptional";
                                } else {
                                    return "Invalid Rating";
                                }
                            }                        
                        ?>
                        <div class="starpointalign">
                            <?php
                                for($i = 0; $i < 5; $i++){
                                    // Prints Green Star
                                    if(round($build_rate) > $i){
                                        echo '<img class="star-image" src="../Images/EcoEstateImages/pdstar1.svg" width="30" height="30" alt="G">';
                                    }
                                    // Pringts Grey Star
                                    else{
                                        echo '<img class="star-image" src="../Images/EcoEstateImages/pdstar2.svg" width="30" height="30" alt="B">';
                                    }   
                                }
                                echo "<div class='starpointalignspace'></div>";
                                echo '<span id="popup-click" onclick="openPopupFormBuild()" >' . $build_rate . ' | ' .generateSustainabilityTier($build_rate) . '</span>';
                            ?>
                        </div>
                        <div class="starpointalign">
                            <?php
                                for($i = 0; $i < 5; $i++){
                                    // Prints Green Star
                                    if(round($renew_rate) > $i){
                                        echo '<img class="star-image" src="../Images/EcoEstateImages/pdstar1.svg" width="30" height="30" alt="G">';
                                    }
                                    // Pringts Grey Star
                                    else{
                                        echo '<img class="star-image" src="../Images/EcoEstateImages/pdstar2.svg" width="30" height="30" alt="B">';
                                    }   
                                }
                                echo "<div class='starpointalignspace'></div>";
                                echo '<span id="popup-click" onclick="openPopupFormRenew()">' .$renew_rate . ' | '  .generateSustainabilityTier($renew_rate) . '</span>';
                            ?>
                        </div>
                        <div class="starpointalign">
                            <?php
                                for($i = 0; $i < 5; $i++){
                                    // Prints Green Star
                                    if(round($energy_rate) > $i){
                                        echo '<img class="star-image" src="../Images/EcoEstateImages/pdstar1.svg" width="30" height="30" alt="G">';
                                    }
                                    // Pringts Grey Star
                                    else{
                                        echo '<img class="star-image" src="../Images/EcoEstateImages/pdstar2.svg" width="30" height="30" alt="B">';
                                    }   
                                }
                                echo "<div class='starpointalignspace'></div>";
                                echo '<span id="popup-click" onclick="openPopupFormEnergy()">'. $energy_rate . ' | ' .generateSustainabilityTier($energy_rate) . '</span>';
                            ?>
                        </div>
                        <div class="starpointalign">
                            <?php
                                for($i = 0; $i < 5; $i++){
                                    // Prints Green Star
                                    if(round($water_rate) > $i){
                                        echo '<img class="star-image" src="../Images/EcoEstateImages/pdstar1.svg" width="30" height="30" alt="G">';
                                    }
                                    // Pringts Grey Star
                                    else{
                                        echo '<img class="star-image" src="../Images/EcoEstateImages/pdstar2.svg" width="30" height="30" alt="B">';
                                    }   
                                }
                                echo "<div class='starpointalignspace'></div>";
                                echo '<span id="popup-click" onclick="openPopupFormWater()">'. $water_rate . ' | ' .generateSustainabilityTier($water_rate) . '</span>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-side">
                <div class="top-right">
                    <h1 style="column-span: all;">Features</h1>
                    <hr style="column-span: all;">
                    <ul>
                        <?php
                            if($Features){
                                while($feature = mysqli_fetch_assoc($Features)){
                                    echo "<li> ". $feature['feature'] ." </li>";
                                }
                            }
                        ?>
                    </ui>
                </div>
                <div class="bottom-right">
                    <h1>Certificates</h1>
                    <hr>
                    <ul>
                        <?php
                            foreach($Certificates as $certificate){
                                echo "<li>$certificate</li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <section class="user">
            <div class="column">
                <h3>Interested?</h3>
                <h3>Contact the owner now!</h3>
            </div>
            <div class="column">
                <h4>Email Address:</h4>
                <h4><?php echo $email;?></h4>
            </div>
            <div class="column">
                <h4>Mobile Number:</h4>
                <h4><?php echo $phone;?></h4>
            </div>
            <div class="column">
                <br>
                <h3>About The Owner:</h3>
                <br>
            </div>
            <div class="column">
                <section class="user" style="margin:0;">
                    <div class="column-2">
                        <img class="profile-pic" src="<?php echo $profile;?>">
                    </div>
                    <div class="column-2">
                        <p><?php echo $username;?></p>
                        <a href="user_page.php?user_id=<?php echo $user_id;?>">View Profile</a>
                    </div>
                </section>
            </div>
        </section>

        <section>
            <h3 id="popup-click" onclick="openPopupFormDelete()">Delete Property</h3>
        </section>

        <!-- Popup Edit -->
        <div id="overlay" onclick="closePopupForm()"></div>

        <div id="popup-delete">
            <h2>Delete Property</h2>
                <form action="property_delete.php" method="post">
                    <!-- Your form fields go here -->
                    <p>Are You Sure You Want To Delete This Property?</p>

                    <br><br><button name="property_id" type="submit" value="<?php echo $property_id;?>">Yes</button>
                </form>
            <button onclick="closePopupForm()">No</button>
        </div>

        <div id="popup-build">
            <h2>Update Rating</h2>
                <form action="show_property.php" method="post">
                    <!-- Your form fields go here -->
                    <p>Enter a new rating for building materials:</p>

                    <input type="number" id="build" name="build" step="0.1" min="0" max="5" required>
                    <input type="hidden" id="id" name="id" value="<?php echo $property_id;?>">

                    <br><br><button type="submit">Submit</button>
                </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-renew">
            <h2>Update Rating</h2>
                <form action="show_property.php" method="post">
                    <!-- Your form fields go here -->
                    <p>Enter a new rating for renwable energy:</p>

                    <input type="number" id="renew" name="renew" step="0.1" min="0" max="5" required>
                    <input type="hidden" id="id" name="id" value="<?php echo $property_id;?>">

                    <br><br><button type="submit">Submit</button>
                </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-energy">
            <h2>Update Rating</h2>
                <form action="show_property.php" method="post">
                    <!-- Your form fields go here -->
                    <p>Enter a new rating for energy efficiency:</p>

                    <input type="number" id="energy" name="energy" step="0.1" min="0" max="5" equired>
                    <input type="hidden" id="id" name="id" value="<?php echo $property_id;?>">

                    <br><br><button type="submit">Submit</button>
                </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-water">
            <h2>Update Rating</h2>
                <form action="show_property.php" method="post">
                    <!-- Your form fields go here -->
                    <p>Enter a new rating for water efficiency:</p>

                    <input type="number" id="water" name="water" step="0.1" min="0" max="5" required>
                    <input type="hidden" id="id" name="id" value="<?php echo $property_id;?>">

                    <br><br><button type="submit">Submit</button>
                </form>
            <button onclick="closePopupForm()">Close</button>
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

        <script>
            // Slideshow Apartment Images
            var slideIndex = 1;
            showDivs(slideIndex);

            function plusDivs(n) {
                showDivs(slideIndex += n);
            }

            function currentDiv(n) {
                showDivs(slideIndex = n);
            }

            function showDivs(n) {
                var i;
                var x = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("demo");
                if (n > x.length) {slideIndex = 1}
                if (n < 1) {slideIndex = x.length}
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
                }
                x[slideIndex-1].style.display = "block";
            }

            function openPopupFormDelete() {
                document.getElementById("popup-delete").style.display = "block";
                document.getElementById("overlay").style.display = "block";
            }

            function openPopupFormBuild() {
                document.getElementById("popup-build").style.display = "block";
                document.getElementById("overlay").style.display = "block";
            }
            
            function openPopupFormRenew() {
                document.getElementById("popup-renew").style.display = "block";
                document.getElementById("overlay").style.display = "block";
            }
            
            function openPopupFormEnergy() {
                document.getElementById("popup-energy").style.display = "block";
                document.getElementById("overlay").style.display = "block";
            }

            function openPopupFormWater() {
                document.getElementById("popup-water").style.display = "block";
                document.getElementById("overlay").style.display = "block";
            }

            function closePopupForm() {
                document.getElementById("popup-delete").style.display = "none";
                document.getElementById("popup-build").style.display = "none";
                document.getElementById("popup-renew").style.display = "none";
                document.getElementById("popup-energy").style.display = "none";
                document.getElementById("popup-water").style.display = "none";
                document.getElementById("overlay").style.display = "none";
            }
        </script>

    </body>
    
</html>
