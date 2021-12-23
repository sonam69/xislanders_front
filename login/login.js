$(document).ready(function() {
    $("#log_in_form").submit(function(e)
    {
        console.log("log in log in log in");
        e.preventDefault();
        var log_in_error = document.getElementById("log_in_error");
        console.log("it's gone");
        $.ajax({
            type: this.method,
            url: "../appscripts/session.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function(data)
            {
                console.log("it's back");
                if(data.result === true)
                {
                    console.log("Succesfully logged in");
                    window.location.href = 'admin_main.php';
                    //location.reload();
                }
                else
                {
                    console.log(data["result"]);
                    $("#error_message").text(data["result"]);
                    log_in_error.style.display = "block";
                }
            },
            error: function(ts)
            {
                console.log("an error occured session2");
                console.log(ts.responseText);
            }
        })
    });
});