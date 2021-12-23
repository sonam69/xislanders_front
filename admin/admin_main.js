$(document).ready(function() // execute when the DOM is fully loaded
{
    var current_page;

    var content_table = document.getElementById("content_table");

    //Initiate datable
    var content_datatable = $(content_table).DataTable({
        destroy: true,
        responsive: true,
        lengthChange: false,
        info: false,
        pageLength: 20
    });

    // Add on click event on table rows

    var chosen_page;

     update_table = function(select) {
         chosen_page = select;
        var page_id = select.options[select.selectedIndex].value;
        $.ajax({
            url:"../appscripts/admin/fetch_pageContent.php",
            method:"POST",
            data:{page_id:page_id},
            dataType:"JSON",
            success:function(data)
            {
                if(data instanceof Array && data.length > 0)
                {
                    current_page = page;
                    document.getElementById("page").classList.add("hasValue");
                    console.log("Successfully fetched pages");
                    clear_content_table();
                    populate_content_table(data);
                }
                else
                {
                    clear_content_table();
                    document.getElementById("page").classList.add("noContent");
                    $("#error_message").text(data);
                }
            },
            error: function(ts)
            {
                console.log("an error occured");
                $("#error_message").text(ts.responseText);
            }
        });

         // Show form_wrapper
         document.getElementById('form_wrapper').classList.add('is-visible');
         document.getElementById('page_name').innerHTML = " " + select.options[select.selectedIndex].innerHTML + " ";
         // Update hidden form inputs with name page_id
         $('input[name="page_id"]').val(page_id);
    };

     clear_content_table = function() {
         document.querySelector('.dataTables_paginate ').classList.remove('is-visible');
         content_datatable.clear().draw();
     };

    populate_content_table = function(content) {
        if(content.length > 10) {
            document.querySelector('.dataTables_paginate ').classList.add('is-visible');
        }

        for(var i = 0; i < content.length; i++) {
            // content_datatable.row.add({
            //     "date": content[i]["date"],
            //     "title": content[i]["title"],
            //     "type":  content[i]["type"],
            //     "order": content[i]["order"]
            // }).draw();
            content_datatable.row.add(
                [
                    content[i]["id"],
                    content[i]["date"],
                    content[i]["title"],
                    content[i]["type"],
                    content[i]["order"]
                ]
            ).draw();
        }

        // Add on click events on rows
        $('#content_table tbody tr').click( function () {
            choose_row(this);
        });
    };

    /****Choose row****/
    choose_row = function(row) {
        let row_id = parseInt(row.firstElementChild.innerHTML);
        let row_content_type = row.children[3].innerHTML;

        var prev = row.parentElement.querySelector('.selected');
        if(prev)  {
            prev.classList.remove('selected');
            let prev_row_content_type = prev.children[3].innerHTML;
            let target_form = document.getElementById('form_' + prev_row_content_type);
            target_form.classList.remove('is-visible');
            target_form.querySelector('.header span').innerHTML = "Adding new content of type ";
            target_form.querySelector('input[name="content_id"]').value = "";
            //document.getElementById('form_' + prev_row_content_type).classList.remove('is-visible');

        }
        if(prev != row) { //it wasn't the same clean input
            clear_all();
            let row_content_type = row.children[3].innerHTML;
            row.classList.add('selected');
            let target_form =  document.getElementById('form_' + row_content_type);
            target_form.classList.add('is-visible');
            target_form.querySelector('.header span').innerHTML = "Updating content of type ";
            target_form.querySelector('input[name="content_id"]').value = row_id;
            document.getElementById('add_new_content').classList.add('is-hidden');
            $('.dangerous').addClass('is-visible');


            // HERE it must fetch from db the content and fill the inputs;
            fetch_contentValues(row_id, target_form);

        } else {
            clear_all();
            //document.getElementById('add_new_content').classList.remove('is-hidden');
        }
    };

    fetch_contentValues = function (content_id, target_form) {
        $.ajax({
            url:"../appscripts/admin/fetch_contentValues.php",
            method:"POST",
            data:{content_id:content_id},
            dataType:"JSON",
            success:function(data)
            {
                // Update input
                for (var k in data){
                    if (data.hasOwnProperty(k)) {
                        if(data[k]["datatype"] == "file") {
                            target_form.querySelector('[name="' + k + '"]').nextElementSibling.setAttribute('src', data[k]["value"]);
                        }else if(data[k]["datatype"] == "radio" || data[k]["datatype"] == "checkbox") {
                            target_form
                                .querySelector('[type="radio"]')
                                .parentElement
                                .querySelector('[type="radio"][value="' + data[k]["value"] + '"]')
                                .checked = true;
                        }else {
                            var cur_target = target_form.querySelector('[name="' + k + '"]');
                            if (cur_target) {
                              cur_target.value = data[k]["value"];
                            }
                            // target_form.querySelector('[name="' + k + '"]').value = data[k]["value"];
                        }
                    }
                }

            },
            error: function(ts)
            {
                console.log("an error occured");
                $("#error_message").text(ts.responseText);
            }
        });
    };


    /****Form show-hide***/
    var visible_form = false;

    show_content_form = function(element) {
        clear_all();
        var select = element.parentElement.querySelector('select');
        //var selected_value = select.options[select.selectedIndex].value;
        var selected_text = select.options[select.selectedIndex].innerHTML;
        var form_id = "form_" + selected_text;
        if(visible_form) {
            document.getElementById(visible_form).classList.remove('is-visible');
        }
        document.getElementById(form_id).classList.add('is-visible');
        visible_form = form_id;
    };

    /******Content type form submition*****/
    $(".content_type_form").submit(function(e)
    {
        e.preventDefault();
        debugger;

        // let formData = FormDataToJSON(this);
        // // let formData = new FormData(this);

        $.ajax({
            url:"../appscripts/admin/set_content.php",
            method: "POST",
            data: new FormData(this), // our form...
            processData: false,
            contentType: false,
            dataType:"JSON",
            success: function(data) {
                debugger;
                // ... do something with the data...
                update_table(chosen_page);
                clear_all();
            },
            error: function(ts)
            {
                debugger;
                console.log("an error occured");
                $("#error_message").text(ts.responseText);
            }
        });
    });

    delete_row = function(element) {
        var confirmation = confirm("If you press ok the section will be delete");
        if (confirmation == true) {
            let content_id = element.parentElement.parentElement.querySelector('[name="content_id"]').value;
            $.ajax({
                url:"../appscripts/admin/delete_content.php",
                method:"POST",
                data:{content_id:content_id},
                dataType:"JSON",
                success:function(data)
                {
                    update_table(chosen_page);
                    clear_all();
                },
                error: function(ts)
                {
                    console.log("an error occured");
                    $("#error_message").text(ts.responseText);
                }
            });
        }
    };

    clear_all = function() {
        visible_form = false;
        $('form').removeClass('is-visible');
        $('input').not('[name="page_id"], [name="content_type"], [type="radio"], [type="checkbox"]').val('');
        $('input[type="radio"]').each( function() {
            this.parentElement
                .querySelector('[type="radio"]')//query selector gets the first element
                .checked = true;
        });
        $('img').removeAttr('src');
        $('#add_new_content').removeClass('is-hidden');
        $('.dangerous').removeClass('is-visible');
    }

});