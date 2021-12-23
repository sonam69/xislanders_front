<div class="container">
    <a href="/" class="logo fadeIn delay2000ms"></a>
        <div id="menu" class="fadeIn delay2500ms" onclick="(toggle_menu(true))">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="menu_nav">
            <button class="close" onclick="(toggle_menu(false))"></button>
            <?php include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/fetchers/fetch_menu.php"); ?>
        </div>
</div>