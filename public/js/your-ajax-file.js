// Here's an example of how your AJAX call should look

$(document).ready(function() {
    $('#your-select-element').select2({
        ajax: {
            url: 'http://localhost:8080/services/fetch',
            type: 'POST',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    name: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response.data
                };
            },
            cache: true
        },
        minimumInputLength: 1,
        placeholder: 'Search for a service...'
    });
});
