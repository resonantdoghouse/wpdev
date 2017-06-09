jQuery(document).ready(function($) {

    $('select').material_select(); // init select for materializecss


    // WP Media Uploader
    var frame = wp.media({
      title: 'Select or upload logo',
      button: {
        text: 'Use this media'
      },
      multiple: false
    });

    $('#wpdev_inputLogoImgBtn').click(function(e){
      e.preventDefault();
      frame.open();
    });

    frame.on('select', function(){
      var attachment = frame.state().get('selection').first().toJSON();
      $('input[name=wpdev_inputLogoImg]').val(attachment.url);
    });

});
