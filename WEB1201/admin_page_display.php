<?php
include_once ("mysqli_connect.php");

//Pagination variables
$resultsPerPage = 3;
$page1 = isset($_GET['page1']) ? intval($_GET['page1']) : 1;
$offset1 = ($page1 - 1) * $resultsPerPage;
$page2 = isset($_GET['page2']) ? intval($_GET['page2']) : 1;
$offset2 = ($page2 - 1) * $resultsPerPage;
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <style>
        div.container-admin {
            display: flex;
            justify-content: space-between;
            padding: 1% 10%;
        }

        div.left-word, div.right-word {
            width: 48%;
            padding: 10px;
            margin: 5px;
            box-sizing: border-box;
        }

        div.left-word{
            text-align: left;
        }

        div.right-word{
            text-align: right;
        }

        section {
            max-width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        section.property{
            max-width: 95%;
            background-color: #F2FDFF;
            box-shadow: none;
            border-radius: none;
        }

        img.profile-pic{
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        #popup, #popup-delete{
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
            echo '<h1>Update Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
            foreach ($errors as $msg) { // Print each error.
                echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br /></p>';
        }
        ?>

        <div class="container-admin">
            <div class="left-word">
                <h1>Admin Page</h1>
            </div>
            <div class="right-word" id = "popup-click" onclick="openPopupForm()">
                <h3 style="font-weight: inherit; color: inherit;"><?php echo $name; ?></h3>
                <p style="font-weight: inherit; color: inherit;">ECOA<?php echo $admin_id?></p>
            </div>
        </div>

        <section>
            <div class="not approved">
                <h2>Pending Approval</h2>
                <?php
                    //Construct the SQL query
                    $q = "SELECT * FROM property INNER JOIN property_approval ON property.property_id = property_approval.property_id 
                    WHERE property_approval.admin_id IS NULL ORDER BY property_approval.assessment_date";
                    $result = @mysqli_query($dbc, $q);
                    $pages = false;

                    //Display the search results
                    if (mysqli_num_rows($result) >= $resultsPerPage) {
                        $q = "SELECT * FROM property INNER JOIN property_approval ON property.property_id = property_approval.property_id 
                        WHERE property_approval.admin_id IS NULL ORDER BY property_approval.assessment_date LIMIT $resultsPerPage OFFSET $offset1 ";
                        $result = @mysqli_query($dbc, $q);
                        $pages = true;
                    }

                    if (mysqli_num_rows($result) != 0) {
                        while ($property = mysqli_fetch_assoc($result)) {
                            $q = "SELECT * FROM user WHERE user_id IN (SELECT user_id FROM property WHERE property_id = " . $property['property_id'] . ");";
                            $r = @mysqli_query($dbc, $q);
                            $user = mysqli_fetch_assoc($r);

                            echo '<section class="property">';
                            echo "<h2>" . $property['address'] . ", " . $property['state'] . "</h2>";
                            echo "<img class='profile-pic' src='" . $user['profile_img_dir'] . "'>";
                            echo "<p>" . $user['username'] . "</p>";
                            echo "<p>ECOR" . $user['user_id'] . "</p>";
                            echo "<p>Type: For " . $property['listing_type'] . "</p>";
                            echo "<p>Upload Date: " . $property['upload_date'] . "</p>";
                            echo "<p>Approved Date: N/A";
                            echo '<br><a href="show_property.php?id=' . $property['property_id'] . '">More Details</a>';
                            echo '</section>';
                        }

                        
                        if($pages){
                            // Add pagination links
                            $q = "SELECT COUNT(*) AS total FROM property INNER JOIN property_approval ON property.property_id = property_approval.property_id 
                            WHERE property_approval.admin_id IS NULL";
                            $result = @mysqli_query($dbc, $q);
                            $row = mysqli_fetch_assoc($result);
                            $totalPages = ceil($row['total'] / $resultsPerPage);
                        
                            echo "<div class='pagination'>";
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo "<a href='?page1=$i&page2=$page2'>$i</a>";
                            }
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No property to approve</p>";
                    }
                ?>
            </div>
            <div class="approved">
                <h2>Approved</h2>
                <?php
                    //Construct the SQL query
                    $q = "SELECT * FROM property INNER JOIN property_approval ON property.property_id = property_approval.property_id 
                    WHERE property_approval.admin_id = $admin_id ORDER BY property_approval.approval_date;";
                    $result = @mysqli_query($dbc, $q);
                    $page = false;

                    //Display the search results
                    if (mysqli_num_rows($result) >= $resultsPerPage) {
                        $q = "SELECT * FROM property INNER JOIN property_approval ON property.property_id = property_approval.property_id 
                        WHERE property_approval.admin_id = $admin_id ORDER BY property_approval.approval_date LIMIT $resultsPerPage OFFSET $offset2;";
                        $result = @mysqli_query($dbc, $q);
                        $pages = true;
                    }

                    if (mysqli_num_rows($result) != 0) {

                        while ($property = mysqli_fetch_assoc($result)) {
                            $q = "SELECT * FROM user WHERE user_id IN (SELECT user_id FROM property WHERE property_id = " . $property['property_id'] . ");";
                            $r = @mysqli_query($dbc, $q);
                            $user = mysqli_fetch_assoc($r);

                            $q = "SELECT approval_date FROM property_approval WHERE property_id = " . $property['property_id'] . " AND admin_id = $admin_id;";
                            $r = @mysqli_query($dbc, $q);
                            $approval = mysqli_fetch_assoc($r);

                            echo '<section class="property">';
                            echo "<h2>" . $property['address'] . ", " . $property['state'] . "</h2>";
                            echo "<img class='profile-pic' src='" . $user['profile_img_dir'] . "'>";
                            echo "<p>" . $user['username'] . "</p>";
                            echo "<p>ECOR" . $user['user_id'] . "</p>";
                            echo "<p>Type: " . $property['listing_type'] . "</p>";
                            echo "<p>Upload Date: " . $property['upload_date'] . "</p>";
                            echo "<p>Approved Date: " . $approval['approval_date'] . "</p>";
                            echo '<br><a href="show_property.php?id=' . $property['property_id'] . '">More Details</a>';
                            echo '</section>';
                        }
                        
                        if($pages){
                            // Add pagination links
                            $q = "SELECT COUNT(*) AS total FROM property INNER JOIN property_approval ON property.property_id = property_approval.property_id 
                            WHERE property_approval.admin_id = $admin_id";
                            $result = @mysqli_query($dbc, $q);
                            $row = mysqli_fetch_assoc($result);
                            $totalPages = ceil($row['total'] / $resultsPerPage);
                        
                            echo "<div class='pagination'>";
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo "<a href='?page1=$page1&page2=$i'>$i</a>";
                            }
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No property has been approved</p>";
                    }
                ?>
            </div>    
        </section>

        <section>
            <h3><a style="font-size: inherit; font-weight:inherit;" href="admin_register.php">Register New Admin</a><h3>
            <h3><a style="font-size: inherit; font-weight:inherit;" href="admin_page.php?logout=true">Logout</a><h3>
            <h3 id="popup-click" onclick="openPopupFormDelete()">Delete Account</h3>
        </section>

        <!-- POPUP EDIT -->
        <div id="overlay" onclick="closePopupForm()"></div>

        <div id="popup">
            <h2>Change Details</h2>
            <form action="admin_page.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>Enter a new username: <input type="text" name="username" size="20" maxlength="40" /></p>
                
                <p>New Password: <input type="password" id="password" name="pass1" required></p>

				<p>Confirm New Password: <input type="password" id="confirm_password" name="pass2" required></p>

                <br><br><button type="submit">Submit</button>
            </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-delete">
            <h2>Delete Account</h2>
            <form action="admin_delete.php" method="post"enctype="multipart/form-data">
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
        function openPopupForm() {
            document.getElementById("popup").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function openPopupFormDelete() {
            document.getElementById("popup-delete").style.display = "block";
            document.getElementById("overlay").style.display = "block";
        }

        function closePopupForm() {
            document.getElementById("popup").style.display = "none";
            document.getElementById("popup-delete").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
        </script>

    </body>
</html>
