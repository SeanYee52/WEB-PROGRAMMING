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
        }

        img.profile-pic{
            border-radius: 50%;
            width: 200px;
            height: 200px;
            object-fit: cover;
            transition: filter 2s;
            cursor: pointer;
        }

        img.property-pic{
            width: 300px;
            height: 300px;
            object-fit: cover;
        }

        img.profile-pic:hover, #popup:hover{
            filter: brightness(50%);
            color: #777777;
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
                    <img id="popup" class="profile-pic" src="<?php echo $profile_img; ?>" alt="User Profile Picture" onclick="openPopupFormImage()">
                    <h1 id="popup" style="font-size: 32px;" onclick="openPopupFormName()"><?php echo $username; ?></h1>
                    <p><strong>Join Date:</strong> <?php echo $join_date;?></p>
                    <p><strong>User ID:</strong> ECOR<?php echo $user_id;?></p>
                </section>
            </section>
            <p id="popup" onclick="openPopupFormAbout()"><strong>About Me:</strong> <?php echo $about_me;?></p>
            <!-- User Page Banner -->

            <!-- Contact Information -->
            <div id="popup" class="contact-info" onclick="openPopupFormContact()">
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

                    //Construct the SQL query
                    $q = "SELECT * FROM property WHERE user_id = $user_id";
                    $result = @mysqli_query($dbc, $q);

                    //Display the search results
                    if (mysqli_num_rows($result) >= $resultsPerPage) {
                        $q = "SELECT * FROM property WHERE user_id = $user_id ORDER BY upload_date DESC LIMIT $resultsPerPage OFFSET $offset ";
                        $result = @mysqli_query($dbc, $q);
                    }

                    if (mysqli_num_rows($result) != 0) {
                        while ($property = mysqli_fetch_assoc($result)) {

                            echo '<div class="property">';
                            
                            // Images
                            $q = "SELECT * FROM property_image WHERE property_id = " . $property['property_id'] . " LIMIT 1;";
                            $r = @mysqli_query($dbc, $q);
                            $image = mysqli_fetch_assoc($r);

                            // Approval date
                            $q = "SELECT approval_date FROM property_approval WHERE property_id = " . $property['property_id'] . " && approval_date IS NOT NULL;";
                            $r = @mysqli_query($dbc, $q);
                            $approval = mysqli_fetch_assoc($r);

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

                            echo '<br><a href="show_property.php?id=' . $property['property_id'] . '">More Details</a>';
                            echo '</div>';
                        }
                    
                        // Add pagination links
                        $q = "SELECT COUNT(*) AS total FROM property INNER JOIN property_approval ON property.property_id = property_approval.property_id 
                        WHERE property_approval.admin_id IS NULL";
                        $result = @mysqli_query($dbc, $q);
                        $row = mysqli_fetch_assoc($result);
                        $totalPages = ceil($row['total'] / $resultsPerPage);
                    
                        echo "<div class='pagination'>";
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo "<a href='?page=$i'>$i</a>";
                        }
                        echo "</div>";
                    } else {
                        echo "<p>No property to approve</p>";
                    }
                ?>
        </section>

        <section>
            <h2>Account Settings</h2>
            <h3 id="popup" onclick="openPopupFormPass()">Change Password</h3>
            <h3 id="popup" onclick="openPopupFormDelete()">Delete Account</h3>
            <h3><a style="font-size: inherit; font-weight:inherit;" href="user_page.php?logout=true">Logout</a><h3>
        </section>

        <!-- Popup Edit -->
        <div id="overlay" onclick="closePopupForm()"></div>

        <div id="popup-image">
            <h2>Change Profile Picture</h2>
            <form action="user_page_image.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>Select one image to upload as your profile image</p>
                <input type="file" id="photos" name="photos[]" accept="image/*">

                <br><br><button type="submit">Submit</button>
            </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-name">
            <h2>Change Username</h2>
            <form action="user_page_name.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>Enter a new username</p>
                <input type="text" name="username" size="20" maxlength="40" />

                <br><br><button type="submit">Submit</button>
            </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-about">
            <h2>Change About Me</h2>
            <form action="user_page_about.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>Describe Yourself:</p>
                <textarea id="description" name="description" rows="1" required></textarea>

                <br><br><button type="submit">Submit</button>
            </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-contact">
            <h2>Change Contact</h2>
            <form action="user_page_contact.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>New Email Address: <input type="email" id="email" name="email" required></p>

				<p>New Phone Number: <input type="tel" id="phone" name="phone" required></p>

                <br><br><button type="submit">Submit</button>
            </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-pass">
            <h2>Change Password</h2>
            <form action="user_page_pass.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>New Password: <input type="password" id="password" name="pass1" required></p>

				<p>Confirm New Password: <input type="password" id="confirm_password" name="pass2" required></p>

                <br><br><button type="submit">Submit</button>
            </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-delete">
            <h2>Delete Account</h2>
            <form action="user_page_delete.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>Are You Sure You Want To Delete Your Account</p>

                <br><br><button type="submit" value="delete">Yes</button>
            </form>
            <button onclick="closePopupForm()">No</button>
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
        function openPopupFormImage() {
            document.getElementById("popup-image").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function openPopupFormName() {
            document.getElementById("popup-name").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function openPopupFormAbout() {
            document.getElementById("popup-about").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function openPopupFormContact() {
            document.getElementById("popup-contact").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function openPopupFormPass() {
            document.getElementById("popup-pass").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function openPopupFormDelete() {
            document.getElementById("popup-delete").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closePopupForm() {
            document.getElementById("popup-image").style.display = "none";
            document.getElementById("popup-name").style.display = "none";
            document.getElementById("popup-about").style.display = "none";
            document.getElementById("popup-contact").style.display = "none";
            document.getElementById("popup-pass").style.display = "none";
            document.getElementById("popup-delete").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }

        </script>

    </body>
</html>
