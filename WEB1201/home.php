
<html lang = "en">
    <head>
        <title>Template</title>
        <meta charset = "utf-8">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
        <style>

            div.top-section{
                width: 100%;
            }

            div.properties{
                display: flex;
                width: 80%;
                flex-wrap: wrap;
            }

            div.property{
                width: 33%; /* Each column takes up 50% of the container */
                padding: 10px;
                box-sizing: border-box;
            }

            img.property-pic{
                width: 300px;
                height: 300px;
                object-fit: cover;
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

        <!--Home Page Content Section-->
		<div class="homebg">
            <div class="top-section">
                <div class="homedesctitle">Sustainable and Affordable Property</div>
                <div class="homedesc">We serve as a platform dedicated to connecting home buyers, tenants, 
                    property developers, and real estate agents interested in 
                    sustainable housing development.</div>
            </div>
            <div class="properties">
                <?php

                    //Database
                    include("mysqli_connect.php");

                    //Construct the SQL query
                    $q = "SELECT * FROM property 
                    WHERE property_id IN (SELECT property_id FROM property_approval WHERE admin_id IS NOT NULL AND approval_date IS NOT NULL)
                    ORDER BY upload_date DESC LIMIT 3";
                    $result = @mysqli_query($dbc, $q);

                    if (mysqli_num_rows($result) != 0) {
                        while ($property = mysqli_fetch_assoc($result)) {

                            echo '<div class="property">';
                        
                            $q = "SELECT * FROM property_image WHERE property_id = " . $property['property_id'] . " LIMIT 1;";
                            $r = @mysqli_query($dbc, $q);
                            $image = mysqli_fetch_assoc($r);

                            echo "<img class='property-pic' src='" . $image['img_dir'] . "'>";
                            echo "<h3>" . $property['address'] . ", " . $property['city'] . "</h3>";
                            echo "<p>" . $property['state'] . "</p>";
                            echo '<br><a href="show_property.php?id=' . $property['property_id'] . '">Learn More</a>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
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
        <?php
            if(isset($_GET['redirect'])){
                if(isset($_GET['timeout'])){
                    echo 'alert("Session has timeout, please log in again");';
                }
                elseif(isset($_GET['logout'])){
                    echo 'alert("You have successfully logged out");';
                }
                elseif(isset($_GET['delete'])){
                    echo 'alert("You have successfully deleted this account");';
                }
                elseif(isset($_GET['!property'])){
                    echo 'alert("Property does not exist");';
                }
                elseif(isset($_GET['delete_property'])){
                    echo 'alert("Property has been deleted");';
                }
            }
        ?>
        </script>

    </body>

</html>
