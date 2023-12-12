
<html lang = "en">
    <head>
        <title>About Us Page</title>
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
                        <a class="titlebolder" href="about_us.php">ABOUT US</a>
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

        <!--About Us Page Content Section-->
		<div class="aboutusbg">
            <div class="aboutustitle">About Us</div>
            <div class="aboutussecbg">
                <div class="aboutussecbox">
                    <div><img src="../Images/EcoEstateImages/EcoEstateLogo.svg" width="280" height ="60"></div>
                    <div class="autext">EcoEstate is an online marketplace that strives to provide sustainable and eco-friendly 
                        properties for people from all classes. Technological developments in recent years have 
                        significantly reduced the cost of environmentally friendly equipment, materials, and construction 
                        methods, making eco-friendly properties available in a wide price range. We aim to dispel the 
                        misconception that eco-friendly properties are often more expensive and encourage more people to 
                        buy, invest, and live in eco-friendly properties.</div>
                </div>
                <div class="ausecboxcontainer">
                    <div class="ausecbox">
                        <div><img src="../Images/EcoEstateImages/aulogo1.svg" width="80" height ="80"></div>
                        <div class="autextbold">VISION</div>
                        <div class="logospace"></div>
                        <div class="autextsmall">To be the leading online platform for sustainable and environmentally friendly properties, 
                            making them accessible to people from all walks of life.</div>
                    </div>
                    <div class="ausecbox">
                        <div><img src="../Images/EcoEstateImages/aulogo2.svg" width="80" height ="80"></div>
                        <div class="autextbold">MISSION</div>
                        <div class="logospace"></div>
                        <div class="autextsmall">To make eco-friendly properties common, accessible, and affordable to everyone.</div>
                    </div>
                    <div class="ausecbox">
                        <div><img src="../Images/EcoEstateImages/aulogo3.svg" width="80" height ="80"></div>
                        <div class="autextbold">VALUES</div>
                        <div class="logospace"></div>
                        <div class="autextsmall">Sustainability<br>To promote sustainable and eco-friendly properties.<br>
                        <br>Accessibility<br>To make sustainable and eco-friendly properties accessible to everyone.</div>
                    </div>
                </div>
            </div>
            <div class="benefitsecbg">
                <div class="autextboldbf">Various Benefits of Sustainable and Environmentally Friendly Properties</div>
                <div class="ausecboxcontainer">
                    <div class="ausecboxbf">
                        <div><img src="../Images/EcoEstateImages/aulogo4.svg" width="80" height ="80"></div>
                        <div class="autextbold">ENVIRONMENTAL</div>
                        <div>
                            <ul class="autextsmall">
                                <li>Conserve natural resources</li>
                                <li>Reduce pollution</li>
                                <li>Reduce greenhouse gas emissions</li>
                            </ul>
                        </div>
                    </div>
                    <div class="ausecboxbf">
                        <div><img src="../Images/EcoEstateImages/aulogo5.svg" width="80" height ="80"></div>
                        <div class="autextbold">FINANCIAL</div>
                        <div>
                            <ul class="autextsmall">
                                <li>Increase property value</li>
                                <li>Lower energy bills</li>
                                <li>Reduce water bills</li>
                            </ul>
                        </div>
                    </div>
                    <div class="ausecboxbf">
                        <div><img src="../Images/EcoEstateImages/aulogo6.svg" width="80" height ="80"></div>
                        <div class="autextbold">HEALTH</div>
                        <div>
                            <ul class="autextsmall">
                                <li>Reduce exposure to toxins</li>
                                <li>Improve indoor air quality</li>
                                <li>Increase comfort</li>
                            </ul>
                        </div>
                    </div>
                </div>
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

    </body>

</html>
