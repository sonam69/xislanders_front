<?php
ini_set('log_errors', 1); //in order to log the errors to a file.
ini_set('error_log', dirname(__FILE__) . '/classified/log.txt'); //the path of the file to log the errors to.
error_reporting(E_ALL);

include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/header.php");
sessionStart();
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && $_SESSION['privilege'] > 0) {

    $con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $tables = ["page", "field", "content_type", "content_type__fields"];

    foreach($tables as $table) {
        $sql = "SELECT * FROM " . $table;
        $stmt = $con->prepare( $sql );
        $stmt->execute();
        $all_tables[$table]["values"] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = " . "'" . $table . "'";
        $stmt = $con->prepare( $sql );
        $stmt->execute();
        $all_tables[$table]["types"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Properties for rent or sale in cyprus">
        <meta name="keywords" content="cyprus, buy, rent, sell, property, properties, apartment, apartments, house">
        <meta name="author" content="Tzelepis Manos">
        <title>Dev</title>
        <link rel="stylesheet" href="css/base.css" />
        <link rel="stylesheet" href="css/global.css" />
        <link rel="stylesheet" href="admin/dev.css" />
        <link rel="stylesheet" type="text/css" href="plugins/datatable/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="plugins/datatable/responsive.dataTables.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
        <script src="plugins/datatable/jquery.dataTables.min.js"></script>
        <script src="plugins/datatable/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="admin/dev.js"></script>
    </head>
    <body class="adminpage">
    <div id="page-wrapper">
        <div id="page">
            <main>
                <h1>Developer Page</h1>
                <span id="error_message"></span>
                <div class="content_wrapper container">
                    <?php
                    foreach($all_tables as $table_name => $table_content)
                    {
                        $table_values = $table_content["values"];
                        ?>
                        <div class="group">
                            <h2><?php echo $table_name; ?></h2>
                            <table class="datatable" width="100%">
                                <thead>
                                <tr>
                                    <?php
                                    foreach($table_values[0] as $key => $whatever) {

                                        ?>
                                        <th><?php echo $key; ?></th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($table_values as $row) {
                                    ?>
                                    <tr onclick="choose_row(this)">
                                        <?php foreach($row as $key => $value)  {?>
                                            <td data-name="<?php echo $key; ?>"><?php echo $value; ?></td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <form method="post">
                                <span style="color: red;" class="error_msg"></span>
                                <input data-type="text" type="hidden" name="table" value="<?php echo $table_name; ?>">
                                <input data-type="int" type="hidden" name="id" value="">
                                <input data-type="int" type="hidden" name="delete" value="">
                                <?php
                                $i = 0;
                                foreach($table_values[0] as $key => $whatever) {
                                    if($key !== "id"){
                                    ?>
                                        <div class="form_item">
                                            <label><?php echo $key; ?></label>
                                            <input type="text" name="<?php echo $key; ?>" data-type="<?php echo $table_content["types"][$i]["COLUMN_TYPE"];  ?>">
                                        </div>
                                <?php }
                                $i++;
                                } ?>
                                <div class="form_buttons">
                                    <button>Submit</button>
                                    <div class="btn_delete" onclick="delete_row(this);">Delete</div>
                                </div>
                                <small>If something is selected it will try to update it</small>
                            </form>
                        </div>
                    <?php
                    }
                    ?>
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