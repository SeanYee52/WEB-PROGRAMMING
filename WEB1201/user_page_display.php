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
            cursor: pointer;
        }

        img.profile-pic:hover, #popup:hover{
            filter: brightness(50%);
            color: #777777;
            font-weight: bolder;
        }

        #popup-image, #popup-name, #popup-about, #popup-contact {
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

        #popup{
            cursor: pointer;
            transition: color 2s, font-weight 2s;
        }

    </style>
</head>
<body>
    <!--HEADER, BEGINNING OF CODE (DO NOT EDIT)-->
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

        <section>
            <section class="banner">
                <section style="max-width: 30%; margin: 20px auto 20px 20px">
                    <img id="popup" class="profile-pic" src="<?php echo $profile_img; ?>" alt="User Profile Picture" onclick="openPopupFormImage()">
                    <h1 id="popup" style="font-size: 32px;" onclick="openPopupFormName()"><?php echo $username; ?></h1>
                    <p><strong>Join Date:</strong> <?php echo $join_date;?></p>
                    <p><strong>User ID:</strong> ECOR<?php echo $user_id;?></p>
                </section>
            </section>
            <p id="popup" onclick="openPopupFormAbout()"><strong>About Me:</strong><?php echo $about_me;?></p>
            <!-- User Page Banner -->

            <!-- Contact Information -->
            <div id="popup" class="contact-info" onclick="openPopupFormContact()">
                <h2>Contact Information</h2>
                <p><strong>Email:</strong> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                <p><strong>Phone Number:</strong> <a href="tel:<?php echo $phone_no; ?>"><?php echo $phone_no; ?></a></p>
            </div>
        </section>

        <!-- Popup Edit -->
        <div id="overlay" onclick="closePopupForm()"></div>

        <div id="popup-image">
            <h2>Change Profile Picture</h2>
            <form action="user_page.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>Select one image to upload as your profile image</p>
                <input type="file" id="photos" name="photos[]" accept="image/*">

                <br><br><button type="submit">Submit</button>
            </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-name">
            <h2>Change Username</h2>
            <form action="user_page.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>Enter a new username</p>
                <input type="text" name="username" size="20" maxlength="40" />

                <br><br><button type="submit">Submit</button>
            </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-about">
            <h2>Change About Me</h2>
            <form action="user_page.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>Describe Yourself:</p>
                <textarea id="description" name="description" rows="1" required></textarea>

                <br><br><button type="submit">Submit</button>
            </form>
            <button onclick="closePopupForm()">Close</button>
        </div>

        <div id="popup-contact">
            <h2>Change Contact</h2>
            <form action="user_page.php" method="post"enctype="multipart/form-data">
                <!-- Your form fields go here -->
                <p>New Email Address: <input type="email" id="email" name="email" required></p>

				<p>New Phone Number: <input type="tel" id="phone" name="phone" required></p>

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

        function closePopupForm() {
            document.getElementById("popup-image").style.display = "none";
            document.getElementById("popup-name").style.display = "none";
            document.getElementById("popup-about").style.display = "none";
            document.getElementById("popup-contact").style.display = "none";
            document.getElementById("overlay").style.display = "none";
        }
        </script>

    </body>
</html>