
<html lang = "en">
    <head>
        <title>Template</title>
        <meta charset = "utf-8">
        <link rel = "stylesheet" type = "text/css" href = "style.css">
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

        <!--T&C Page Content Section-->
        <div class="tcbg">
            <div class="tctitle">Terms and Conditions</div>
            <div class="tccontentborder">
                <strong>Use of the Website</strong><br>
                You agree to use this website only for lawful purposes and by these terms and conditions. You may not use this 
                website to engage in the following activities:
                <ul>
                    <li>Post any defamatory, offensive, threatening, abusive, indecent, obscene, hateful, or otherwise unlawful content.</li>
                    <li>Infringe the intellectual property rights of others.</li>
                    <li>Transmit any viruses or other malware.</li>
                    <li>Collect or store other users&apos; data without their consent.</li>
                </ul>
                <strong>Property Listings</strong><br>
                All property listings on the EcoScore website are subject to the following terms and conditions:
                <ul>
                    <li>All properties listed must be sustainable and environmentally friendly properties.</li>
                    <li>All property listings must be accurate and up to date.</li>
                    <li>All property listings must comply with all applicable laws and regulations.</li>
                    <li>EcoScore reserves the right to remove any property listing that does not comply with these terms and conditions.</li>
                </ul>
                <strong>Disclaimer</strong><br>
                EcoScore does not guarantee the accuracy or completeness of any information on the website. EcoScore accepts no 
                liability for any loss or damage arising from reliance on any information on this website.<br>
                <br>
                <strong>Limitation of Liability</strong><br>
                To the maximum extent permitted by law, EcoScore excludes all liability for any loss or damage arising from your 
                use of this website, including without limitation direct, indirect, special, consequential, or incidental loss 
                or damage.<br>
                <br>
                <strong>Changes to Terms and Conditions</strong><br>
                EcoScore reserves the right to change these Terms and Conditions at any time. Any changes to these Terms and 
                Conditions will be posted on the website and will be effective immediately upon posting.
            </div>
            <div class="tcspace"></div>
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
