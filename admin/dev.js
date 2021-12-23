$(document).ready(function() {
    // Make tables jquery datatables
    var tables = document.querySelectorAll('.datatable');
    for (let i=0; i<tables.length; i++) {
        console.log(tables[i]);
        let datatable = $(tables[i]).DataTable({
            destroy: true,
            responsive: true,
            lengthChange: false,
            info: false,
            pageLength: 10
        });
        if(datatable.rows()[0].length > 10) {
            tables[i].parentElement.querySelector('.dataTables_paginate').style.display = "block";
        }
    }

    choose_row = function(row) {
        var prev = row.parentElement.querySelector('.selected');
        if(prev) {
            prev.classList.remove('selected');
        }
        let form = $(row)
            .closest('.group')[0]
            .querySelector('form');
        let columns = row.children;
        if(prev == row) { //it was the same clean input
            form.querySelector('input[name="id"]').value = "";
            for(let i=1; i<columns.length; i++ ) {
                let column_name = columns[i].getAttribute('data-name');
                let form_input = form.querySelector('input[name="' + column_name + '"]');
                form_input.value = "";
            }
            form.classList.remove('has-selected');
        }
        else {
            let id = false;
            if(columns[0].getAttribute('data-name') == "id") {
                form.querySelector('input[name="id"]').value = columns[0].innerHTML;
            }
            for(let i=1; i<columns.length; i++ ) {
                let column_name = columns[i].getAttribute('data-name');
                let column_value = columns[i].innerHTML;
                let form_input = form.querySelector('input[name="' + column_name + '"]');
                form_input.value = column_value;

            }
            form.classList.add('has-selected');
            row.classList.add('selected');
        }
    };

    delete_row = function(button_element) {
        let form = $(button_element).closest('form')[0];
        console.log(form);
        form.querySelector('input[name="delete"]').value = 1;
        $(form).submit();
    };



    // Catch all form submittions
    $('form').submit(function (e) {
        e.preventDefault();
        //let formData = new FormData(this);
        let formData = FormDataToJSON(this);
        console.log(formData);
        $.ajax({
            url:"../appscripts/dev/update_db.php",
            method: "POST",
            data: formData,
            success: function(data) {
                // ... do something with the data...
                console.log("success");
                console.log(data);
            },
            error: function(ts)
            {
                console.log("an error occured");
                this.querySelector('error_msg').innerHTML = ts.responseText;
                console.log(ts.responseText);
            }
        });
    });

    FormDataToJSON = function(FormElement) {
        console.log("woot");
        var formData = new FormData(FormElement);

        var ConvertedJSON= {};
        for (const [key, value]  of formData.entries())
        {
            //var element = FormElement.querySelector('input[name=' + key + ']');
            var element = FormElement.querySelector('[name=' + key + ']');
            var element_datatype = element.getAttribute('data-type');

            if(element.type === "radio") ConvertedJSON[key] = [element.checked, element_datatype];
            else  ConvertedJSON[key] = [value, element_datatype];
        }
        return ConvertedJSON;
    }

});




function update_table(select) {
    var type = select.options[select.selectedIndex].value;
    console.log(page);
    $.ajax({
        url:"../appscripts/fetch_content.php",
        method:"GET",
        data:{page:page},
        dataType:"JSON",
        success:function(data)
        {
            console.log("it's back");
            if(data === true)
            {
                current_page = page;
                document.getElementById("page").classList.add("hasValue");
                console.log("Succesfully fetched pages");
                console.log(data)
            }
            else
            {
                document.getElementById("page").classList.add("noContent");
                console.log("Failed fetched pages");
                console.log(data);
                $("#error_message").text("No content found");
            }
        },
        error: function(ts)
        {
            console.log("an error occured");
            console.log(ts.responseText);
        }
    })
}