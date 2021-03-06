<?php
$page = "home";
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
    <meta http-equiv="content-language" content="en-us">
    <title>Xislanders</title>
    
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
    <link rel="stylesheet" href="footer/footer.css" />
    <link rel="stylesheet" href="css/hero.css" />
    <link rel="stylesheet" href="css/textWithImage.css" />
    <link rel="stylesheet" href="css/alter.css" />
    <link rel="stylesheet" href="css/basic.css" />
    <link rel="stylesheet" href="css/intro.css" />
    <link rel="stylesheet" href="email/email.css" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="libraries/waypoints/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
</head>
<body class="front">
  <div id="particles-js"></div>
  <div id="page-wrapper">
      <div id="page">
          <?php include_once("../external/templates/page.php"); ?>
      </div>
  </div>
  <script src="libraries/particles/particles.min.js"></script>
  <script>
  particlesJS.load('particles-js', 'libraries/particles/particles.json', function() {
    console.log('callback - particles.js config loaded');
  });
  </script>
  <script type="text/javascript" src="email/email.js"></script>
</body>
</html>