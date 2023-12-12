
<html lang = "en">
    <head>
        <title>Login Page</title>
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

        <!--Login Page Content Section-->
		<div class="formbg">
            <div class="formsidedesc">
                <div><img src="../Images/EcoEstateImages/EcoEstateLogoWhite.svg" width="380" height ="100"></div>
                <div class="formsidedesctext">A platform to find your dream home while protecting the planet.</div>
            </div>
            <div class="formborder">
                <div>
                    <div class="formborderdesc">Welcome Back</div>
                    <div class="formborderdesc">To</div>
                    <div><img src="../Images/EcoEstateImages/EcoEstateLogo.svg" width="200" height ="36" class="formborderlogo"></div>
                </div>
                <div>
                    <form action="login.php" method="post">
                        <div class="formques">Username</div>
                        <div><input class="formquesbox" type="text" name="username" size="20" maxlength="40" /></div>
                        <div class="formques">Password</div>
                        <div><input class="formquesbox" type="password" name="pass" size="20" maxlength="40" /></div>
                        <div><button type="submit" class="formsubmitbutton">Login</button></div>
                    </form>
                </div>
                <div class="formlink">No account yet? <a href="register_script.php" class="formlinkad">Click Here</a></div>
                <?php
                // Print any error messages, if they exist:
                if (isset($errors) && !empty($errors)) {
                    echo '<p class="errorclass">The following error(s) occurred:<br />';
                    foreach ($errors as $msg) {
                        echo " - $msg<br />\n";
                    }
                    echo '</p><p class="errorclass">Please try again.</p>';
                }
                // Display the form:
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
                if(isset($_GET['!login'])){
                    echo 'alert("You are not logged in, in order to access that page, please log in");';
                }
            }
        ?>
        </script>

    </body>

</html>
