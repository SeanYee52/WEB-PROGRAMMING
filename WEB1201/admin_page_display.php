<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
    <style>

        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        div.container-admin {
            display: flex;
            justify-content: space-between;
            padding: 20px;
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
         if (!empty($error)) {
            echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br />';
            foreach ($error as $msg) { // Print each error.
                echo " - $msg<br />\n";
            }
            echo '</p><p>Please try again.</p><p><br /></p>';
        }
        ?>

        <div class="container-admin">
            <div class="left-word">
                <h1>Admin Page</h1>
            </div>
            <div class="right-word">
                <h3><?php echo $name; ?></h3>
                <p>ECOA<?php echo $admin_id?></p>
            </div>
        </div>

        <section>
            <div class="not approved">
            </div>
            <div class="approved">
            </div>    
        </section>


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
