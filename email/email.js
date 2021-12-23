// Check if input has value
var form_item_input = document.querySelectorAll('#contact_form .form_item input');
for( var i = 0; i < form_item_input.length; i++) {
    form_item_input[i].addEventListener('change', function() {
        if(this.value) this.classList.add('hasValue');
        else this.classList.remove('hasValue');
    });
}

var form_item_textarea = document.querySelector('#contact_form .form_item textarea');
form_item_textarea.addEventListener('change', function() {
    if(this.value) this.classList.add('hasValue');
    else this.classList.remove('hasValue');
});

function onSubmit()
{
    document.getElementById('send_button').disabled=true;
    $("#contact_form").submit();
}


$(document).ready(function() // execute when the DOM is fully loaded
{
    $("#contact_form").submit(function(e)
    {
        e.preventDefault();
        $("#contact_form button").attr("disabled", true);
        if(!phone_number_check($('#phone_contact').val())) {
            $('#phone_contact').addClass('error');
            document.getElementById('send_button').disabled=false;
            return;
        }
        $.ajax(
        {
            type: this.method, //By default, Ajax requests are sent using the GET HTTP method,  with this we use POST.
            url: "../appscripts/contact_us_mail.php", //A string containing the URL to which the request is sent. with this we use upload.php
            data: new FormData(this), // our form...
            processData: false, //By setting the processData option to false, the automatic conversion of data to strings is prevented.
            contentType: false, //Default is "application/x-www-form-urlencoded; charset=UTF-8", which is fine for most cases
            dataType: "JSON",
            success: function(data)
            {
                if(data.outcome)
                {
                    console.log("~~~~~~~~~~~~~~~~~~~~~~~~success~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
                    console.log(data.msg);
                    window.location = "confirmation.php";
                    // document.getElementById('send_button').disabled=false;
                }
                else
                {
                    console.log("~~~~~~~~~~~~~~~~~~~~~~~~error~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
                    console.log(data.msg);
                    $("#contact_form button").attr("disabled", false);
                }
            },
            error: function(jqxhr, status, exception) {
                document.getElementById('send_button').disabled=false;
            }
        })
    });

    /********phone number country codes********/
    var current_country = 'cy';

    $('.flag-container').click( function() {
        this.nextElementSibling.classList.add('hasValue');
       $('.country-list').toggleClass('hide');
    });

    $('.country').click( function() {

        $('.selected-flag .iti-flag').removeClass(current_country);
        current_country = $(this).attr('data-country-code');
        $('.selected-flag .iti-flag').addClass($(this).attr('data-country-code'));
        // console.log($(this).attr('data-country-code'));
        $('#country_code_contact').val('+' + $(this).attr('data-dial-code'));
        $('#country_initials_contact').val($(this).attr('data-country-code'));
    });

});

function phone_number_check(phone_number) {
    var number = (phone_number.match(/[0-9]/g)).length;
    if (number > 3 && number < 18) return true;
    return false;
    // var phone_regex = new RegExp("(^ *[0-9][0-9 -\.]*$)");
    // if(phone_regex.test(phone_number)) {
    //     var number = (phone_number.match(/[0-9]/g)).length;
    //     if (number > 3 && number < 18) return true;
    //     return false;
    // }
    // return false;
}

// function seperate_check_number(ar)
// {
//     return true;
//     //Is the phone valid?
//     if($("#phone_contact").intlTelInput("isValidNumber"))
//     {
//         var intlNumber = $("#phone_contact").intlTelInput("getNumber");
//         var countryData = $("#phone_contact").intlTelInput("getSelectedCountryData");
//         var countryCode = countryData.dialCode;
//         countryCode = "+" + countryCode;
//         ar[0] = countryCode;
//         intlNumber = intlNumber.substring(countryCode.length);
//         ar[1] = intlNumber;
//         ar[2] = countryData.iso2;
//         return true;
//     }
//     else
//     {
//         return false;
//     }
// }

// $('#phone_contact').intlTelInput({
//     initialCountry: "auto",
//     geoIpLookup: function(callback){
//         $.get('http://ipinfo.io', function(){}, "jsonp").always(function(resp){
//             var countryCode = (resp && resp.country) ? resp.country : "";
//             callback(countryCode);
//         });
//     },
//     utilsScript: "email/utils.js"
// });

// $('#phone_contact').intlTelInput({});