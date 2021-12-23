<form id="contact_form" method="post">
    <div class="container">
        <div class="form_item fadeInUp">
            <input id="contact_name" name="name" type="text" required="">
            <label for="contact_name"><?php echo (array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR") ? "Ονοματεπώνυμο" : "Full Name"?></label>
        </div>
        <div class="form_item fadeInUp">
            <input id="contact_email" name="email" type="email" required="">
            <label for="contact_email">Email</label>
        </div>
        <div class="form_item fadeInUp">
            <input type="tel" id="phone_contact" name="phone_contact" autocomplete="off" required="">
            <label for="phone_contact"><?php echo (array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR") ? "Τηλέφωνο" : "Phone Number" ?></label>
        </div>
        <div class="form_item textarea fadeInUp">
            <textarea id="contact_msg" name="body" required=""></textarea>
            <label for="contact_msg"><?php echo (array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR") ? "Μήνυμα" : "Message" ?></label>
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
        <input type="hidden" id="country_code_contact" name="country_code" value="+357">
        <input type="hidden" id="country_initials_contact" name="country_initials" value="cy">
        <input type="hidden" name="mail_submitted" value="true">
        <input type="hidden" name="contact_submitted" value="">
        <button class="sliding_bg sliding_bg-small fadeInUp" id="send_button" data-callback="onSubmit"><?php echo (array_key_exists('language', $_SESSION) && $_SESSION["language"] === "GR") ? "Αποστολή" : "Send" ?></button>
    </div>
</form>