<?php
ini_set('log_errors', 1); //in order to log the errors to a file.
ini_set('error_log', dirname(__FILE__) . '/classified/log.txt'); //the path of the file to log the errors to.
error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/header.php");
sessionStart();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/admin/fetch_initial-main.php");
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
        <script type="text/javascript" src="admin/admin.js"></script>

    </head>
    <body class="adminpage">

    <div id="page-wrapper">
        <div id="page">
            <header>
                <a href="admin_header.php">Header</a>
                <a href="admin_main.php">Main</a>
                <a class="active" href="admin_footer.php">Footer</a>
            </header>
            <div class="overlay"></div>
            <main>
            <pre>
            <?php
            ?>
                </pre>
                <h1>Administration Page</h1>
                <span id="error_message"></span>
                <select id="page_select" onchange="update_table(this)">
                    <option value="" disabled="disabled" selected="selected" style="color: gray;">Select Page</option>
                    <?php
                    foreach($all_tables["page"] as $item) {
                        ?>
                        <option value="<?php echo $item["id"]; ?>"><?php echo $item["name"]; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <div class="content_wrapper container">
                    <table id="content_table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Order</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                    <div id="form_wrapper">

                        <div id="add_new_content" class="content_type">
                            <select onchange="this.nextElementSibling.classList.add('is-active');">
                                <option value="" disabled="disabled" selected="selected" style="color: gray;">Select Type</option>
                                <?php
                                foreach($content_types as $item) {
                                    ?>
                                    <option value="<?php echo $item["id"]; ?>"><?php echo $item["name"]; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <a herf="#" onclick="show_content_form(this)">Add new content for<span id="page_name"></span>page</a>
                        </div>

                        <?php
                        foreach($content_types as $item) {
                            ?>
                            <form id="<?php echo 'form_' . $item["name"] ?>" class="content_type_form">
                                <div class="dangerous">
                                    <a herf="#" onclick="delete_row(this)">Delete chosen section</a>
                                </div>
                                <div class="header"><span>Adding new content of type </span><?php echo $item["name"]; ?></div>
                                <span class="language_form">Greek</span>
                                <input data-type="int" type="hidden" name="page_id" value="">
                                <input data-type="int" type="hidden" name="content_id" value="">
                                <input data-type="int" type="hidden" name="content_type" value="<?php echo $item["id"]; ?>">
                                <div class="form_item">
                                    <label>Order</label>
                                    <input data-type="int" class="small" type="number" name="order" required>
                                </div>
                                <?php foreach ($item["fields"] as $field) {
                                    if ($field["datatype"] == "file") {
                                        ?>
                                        <div class="form_item">
                                            <label><?php echo $field["name"]; ?></label>
                                            <input data-type="file" data-fieldId="<?php echo $field["id"]; ?>" type="file" name="<?php echo $field["name"]; ?>"  onchange="this.nextElementSibling.src = window.URL.createObjectURL(this.files[0])" >
                                            <img style="height: 100px; width: 100px; border: 1px dotted black;">
                                        </div>
                                        <?php
                                    }
                                } ?>
                                <?php
                                foreach($item["fields"] as $field) {
                                    ?>
                                    <div class="form_item">
                                        <?php if ($field["datatype"] == "textarea") { ?>
                                            <label><?php echo $field["name"]; ?></label>
                                            <textarea data-type="textarea" data-fieldId="<?php echo $field["id"]; ?>" name="<?php echo $field["name"]; ?>" ></textarea>
                                        <?php } else if ($field["datatype"] != "file") { ?>
                                            <label><?php echo $field["name"]; ?></label>
                                            <input data-type="<?php echo $field["datatype"]; ?>" data-fieldId="<?php echo $field["id"]; ?>" type="<?php echo $field["datatype"]; ?>" name="<?php echo $field["name"]; ?>" >
                                        <?php } ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <span class="language_form">English</span>
                                <?php
                                foreach($item["fields"] as $field) {
                                    ?>
                                    <div class="form_item">
                                        <?php if ($field["datatype"] == "textarea") { ?>
                                            <label><?php echo $field["name"]; ?></label>
                                            <textarea data-type="textarea" data-fieldId="<?php echo $field["id"]; ?>" name="<?php echo $field["name"] . '_en'; ?>" ></textarea>
                                        <?php } else if ($field["datatype"] != "file") { ?>
                                            <label><?php echo $field["name"]; ?></label>
                                            <input data-type="<?php echo $field["datatype"]; ?>" data-fieldId="<?php echo $field["id"]; ?>" type="<?php echo $field["datatype"]; ?>" name="<?php echo $field["name"] . '_en'; ?>" >
                                        <?php } ?>
                                    </div>
                                    <?php
                                }
                                ?>
                                <button>Submit</button>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </body>
    </html>
    <?php
} else {
    header('Location: ' . MY_DOMAIN);
    exit();
}
?>