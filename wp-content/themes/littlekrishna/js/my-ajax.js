jQuery(document).ready(function($) {
    // Trigger your AJAX call (you can call this on page load or dropdown click)
    $.ajax({
        url: my_ajax_obj.ajax_url,
        method: 'POST',
        data: {
            action: 'fetch_nakshatra_data'
        },
        success: function(response) {
            if (response.success) {
                var data = response.data;
                var dropdown = $('#nakshatra-dropdown'); // Replace with your dropdown ID

                dropdown.empty(); // Clear existing options

                // Assuming data is an array of objects, e.g. [{name: 'Ashwini'}, {name: 'Bharani'}, ...]
                $.each(data, function(index, item) {
                    // Adjust according to your JSON structure
                    var option = $('<option></option>').attr('value', item.name).text(item.name);
                    dropdown.append(option);
                });
            } else {
                console.error('Error:', response.data);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
});
//generate names
jQuery(document).ready(function ($) {
    $.ajax({
        url: baby_ajax.ajaxurl,
        type: "POST",
        data: { action: "get_baby_names" },
        success: function (response) {
            console.log("AJAX success:", response);
        },
        error: function (xhr, status, error) {
            console.log("AJAX error:", xhr.responseText);
        }
    });
});