jQuery(document).ready(function ($) {

    $('#publish').on('click', function (event) {
        if ($('#set-post-thumbnail img').length == 0) {
            event.preventDefault();
            alert(featured_image_data.message);
        }
    });

});
