<div class="container">
    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
        <div class="right_bar">
            <div class="btn" onclick="location.href='admin_main.php'">Admin</div>
            <div class="btn" onclick="location.href='logout.php'">Logout</div>
        </div>
    <?php } ?>
    <div class="footer_logo restrained delay300ms">
        <a href="/" class="logo fadeIn delay300ms"></a>
    </div>
    <div class="footer_content">
        <div class="footer_contact">
            <div class="footer_social">
                <a href="https://www.facebook.com/Evetiria-Consultants-107410997538265" target="_blank" class="fadeIn delay400ms" style="background-image:url('../imgs/facebook_sprite.png')"></a>
                <a href="https://twitter.com/evetiria" target="_blank" class="fadeIn delay400ms" style="background-image:url('../imgs/twitter_sprite.png')"></a>
                <a href="https://www.linkedin.com/company/evetiria-consultants" target="_blank" class="fadeIn delay400ms" style="background-image:url('../imgs/linkedin_sprite.png')"></a>
            </div>
            <div class="footer_contactBtn restrained delay400ms">
                <h3 class="fadeInUp delay500ms"><?php echo (array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR") ? "ΕΠΙΚΟΙΝΩΝΗΣΤΕ ΜΑΖΙ ΜΑΣ" : "Get in touch" ?></h3>
                <a class="sliding_bg fadeIn delay500ms" href="javascript:void(null);" onClick="moveTo('.basic_nobg')"><?php echo (array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR") ? "ΕΠΙΚΟΙΝΩΝΙΑ" : "Contact" ?></a>
            </div>
        </div>
        <ul class="footer_list">
            <li><a class="sliding_underline fadeInUp delay600ms" href="services">Home</a></li>
            <li><a class="sliding_underline fadeInUp delay700ms" href="company">White paper</a></li>
        </ul>
        <ul class="footer_list">
            <li><a class="sliding_underline fadeInUp delay800ms" href="/">Trustline</a></li>
            <li><a class="sliding_underline fadeInUp delay900ms" href="privacy">Discord</a></li>

        </ul>
        <p class="footer_copyright">© <?php echo date('Y'); ?></p>
    </div>
</div>