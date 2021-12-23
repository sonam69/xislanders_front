<?php
include_once("../external/header.php");
sessionStart();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Properties for rent or sale in cyprus">
    <meta name="keywords" content="cyprus, buy, rent, sell, property, properties, apartment, apartments, house">
    <meta name="author" content="Tzelepis Manos">
    <title>Contact us</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,500,700&display=swap&subset=greek" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="header/header.css" />
    <link rel="stylesheet" href="hero/hero.css" />
    <link rel="stylesheet" href="footer/footer.css" />
    <link rel="stylesheet" href="login/login.css" />

    <!--    <script src="jquery-3.4.1.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="login/login.js"></script>
</head>
<body>

<div id="page-wrapper">
    <div id="page">
        <header>
            <?php include 'header/header.php'?>
        </header>
        <div class="overlay"></div>
        <main>
            <?php include 'hero/hero.php'?>
            <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true)  {?>
                <button class="btn" onclick="location.href='logout.php'">Logout</button>
            <?php } else { ?>
            <form id="log_in_form" method="POST">
                <span id="error_message"></span>
                <input type="email" placeholder="Email" name="email" id="login_email" required/>
                <input type="password" placeholder="Password" name="password" id="login_password" required/>
                <input type="submit" value="Log In" class="button buttonHover" id="log_in_button"/>
                <input type="hidden" name="login_a" value="true">
                <input type="hidden" name="login_b" value="">
            </form>
            <?php } ?>
        </main>
        <footer>
            <?php include 'footer/footer.php'?>
        </footer>
    </div>
</div>
</body>
</html>