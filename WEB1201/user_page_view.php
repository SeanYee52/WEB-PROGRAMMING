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
                    <img id="popup" class="profile-pic" src="<?php echo $profile_img; ?>" alt="User Profile Picture">
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

        <section>
            <h2>Account Settings</h2>
            <h3>Change Password</h3>
            <h3 id="popup" onclick="openPopupFormDelete()">Delete Account</h3>
        </section>

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
