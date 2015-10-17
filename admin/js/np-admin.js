/* JavaScripts for nano-progga Back-end Common Tweaks */
jQuery(document).ready(function($) {

    var img_holder          = $('#series-cover-preview, .img-holder'),
        url_field           = $('#series-cover'),
        series_cover_btn    = $('#series-cover-btn');

    var grm_uploader;

    series_cover_btn.click( function(e) {
            e.preventDefault();

            //if the uploader object has already been created, reopen the dialog
            if( grm_uploader ) {
                grm_uploader.open();
                return;
            }

            //extend the wp.media object
            grm_uploader = wp.media.frames.file_frame = wp.media( {
                title:"Choose Series Cover",
                button:{
                    text: "Choose Cover"
                },
                multiple: false
            } );

            //when a file is selected, grab the URL and set it as the text field's value
            grm_uploader.on( 'select', function() {
                attachment = grm_uploader.state().get('selection').first().toJSON();
                url_field.val(attachment.url).attr( 'value', attachment.url );
                $('#series-cover-preview img').attr( 'src', attachment.url );
                $('#series-cover-preview').css('display', 'inline-block');
            });

        //Open the uploader dialog
        grm_uploader.open();

    });

    //initiate the close (x) button on the cover image
    $('#series-cover-preview i').on('click', function() {
        url_field.val('').attr( 'value', '' );
        $('#series-cover-preview').hide();
    });

});