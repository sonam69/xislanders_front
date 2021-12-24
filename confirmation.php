<?php
include_once("../external/header.php");
sessionStart();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="NFT GAME">
    <meta name="keywords" content="nft, game, crypto, online game, nft game, xislanders, x islanders">
    <meta name="author" content="Tzelepis Manos">
    <meta http-equiv="content-language" content="<?php echo ( array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR" ) ? 'el-gr'  : 'en-us' ?>">
    <title>Confirmation | Evetiria Consultants</title>
    
    <meta property="og:title" content="Xislanders">
    <meta property="og:url" content="https://xislanders.com/">
    <meta property="og:image" content="https://xislanders.com/imgs/social_image_evetiria.jpg">
    <meta property="og:description" content="NFT GAME">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="Xislanders" />
    <meta name="twitter:url" content="https://xislanders.com/" />
    <meta name="twitter:description" content="NFT GAME" />
    <meta name="twitter:image" content="https://xislanders.com/imgs/social_image_evetiria.jpg"/>
    
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,500,700&display=swap&subset=greek" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="header/header.css" />
    <link rel="stylesheet" href="css/confirmation.css" />
    <link rel="stylesheet" href="footer/footer.css" />

    <!--    <script src="jquery-3.4.1.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="libraries/waypoints/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</head>
<body <?php if ( array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR" ) echo 'lang="el"'; ?> class="confirmation_page">
<div id="particles-js"></div>
<div id="page-wrapper">
    <div id="page">
        <header>
            <?php include 'header/header.php'?>
        </header>
        <div class="overlay"></div>
        <main>
            <h1>Confirmation | Xislanders</h1>
            <div class="confirmation entity entity-paragraphs-item paragraphs-item-confirmation-message" about="" typeof="">
                <div class="content">
                    <span></span>
                    <div class="field field-name-field-info field-type-text-long field-label-hidden"><div class="field-items"><div class="field-item even">
                                <h2><?php echo (array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR") ? "Σας Ευχαριστούμε" : "Thank You" ?></h2>
                                <p><?php echo (array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR") ? "Το μήνυμα σας έχει σταλεί επιτυχώς και θα επικοινωνήσουμε το συντομότερο μαζί σας." : "Your message was submitted successfully and we will respond soon." ?></p>
                            </div></div></div>    <div class="link_wrapper">
                        <a class="circularLink" href="/" title="Home" rel="home"><?php echo (array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR") ? "Αρχική " : "Home" ?></a>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <?php include 'footer/footer.php'?>
        </footer>
    </div>
</div>
<script src="libraries/particles/particles.min.js"></script>
  <script>
  particlesJS.load('particles-js', 'libraries/particles/particles.json', function() {
    console.log('callback - particles.js config loaded');
  });
  </script>
</body>
</html>