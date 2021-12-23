<?php
ini_set('log_errors', 1); //in order to log the errors to a file.
ini_set('error_log', dirname(__FILE__) . '/classified/log.txt'); //the path of the file to log the errors to.
error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/header.php");
sessionStart();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/admin/fetch_initial-header.php");
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Properties for rent or sale in cyprus">
        <meta name="keywords" content="cyprus, buy, rent, sell, property, properties, apartment, apartments, house">
        <meta name="author" content="Tzelepis Manos">
        <title>Admin</title>
        <link rel="stylesheet" href="css/base.css" />
        <link rel="stylesheet" href="css/global.css" />
        <link rel="stylesheet" href="header/header.css" />
        <link rel="stylesheet" href="admin/admin.css" />
        <link rel="stylesheet" href="admin/dev.css" />
        <link rel="stylesheet" href="footer/footer.css" />

        <link rel="stylesheet" type="text/css" href="plugins/datatable/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="plugins/datatable/responsive.dataTables.min.css">

        <!--    <script src="jquery-3.4.1.min.js"></script>-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <script src="plugins/datatable/jquery.dataTables.min.js"></script>
        <script src="plugins/datatable/dataTables.responsive.min.js"></script>

        <script type="text/javascript" src="js/scripts.js"></script>
        <script type="text/javascript" src="admin/admin_header.js"></script>

    </head>
    <body class="adminpage">

    <div id="page-wrapper">
        <div id="page">
            <header>
                <a class="active" href="admin_header.php">Header</a>
                <a href="admin_main.php">Main</a>
                <a href="admin_footer.php">Footer</a>
            </header>
            <main>
                <div class="container">
                    <form style="display: flex;">
                        <span class="language_form">Greek</span>
                        <div class="form_item">
                            <label>Menu</label>
                            <textarea data-type="textarea" name="value_gr"><?php echo $menu["value_gr"]; ?></textarea>
                        </div>
                        <span class="language_form">English</span>
                        <div class="form_item">
                            <label>Menu</label>
                            <textarea data-type="textarea" name="value_en"><?php echo $menu["value_en"]; ?></textarea>
                        </div>
                        <button>Submit</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <script>
        $("form").submit(function (e) {
            e.preventDefault();
            console.log("aou");
            if ($("#file").val() == '') console.log("Insertion Failed files is Blank....!!");
            else {
                $.ajax({
                    type: "POST", //By default, Ajax requests are sent using the GET HTTP method,  with this we use POST.
                    url: "../appscripts/admin/set_menu.php", //A string containing the URL to which the request is sent. with this we use upload.php
                    data: new FormData(this), // our form...
                    processData: false, //By setting the processData option to false, the automatic conversion of data to strings is prevented.
                    contentType: false, //Default is "application/x-www-form-urlencoded; charset=UTF-8", which is fine for most cases
                    dataType:"JSON",
                    success: function (data) {
                        location.reload();
                    },
                    error: function(jqxhr, status, exception) {
                        console.log(exception);
                    }
                });
            }
        });
    </script>
    </body>
    </html>
    <?php
} else {
    header('Location: ' . MY_DOMAIN);
    exit();
}
?>