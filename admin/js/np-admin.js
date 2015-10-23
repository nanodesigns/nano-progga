/* JavaScripts for nano-progga Back-end Common Tweaks */
jQuery(document).ready(function($) {

    var url_field           = $('#series-cover');


    $('#series-cover-btn').on( 'click', function(e) {
            var np_uploader;
            
            e.preventDefault();

            //if the uploader object has already been created, reopen the dialog
            if( np_uploader ) {
                np_uploader.open();
                return;
            }

            //extend the wp.media object
            np_uploader = wp.media.frames.file_frame = wp.media( {
                title:"Choose Series Cover",
                button:{
                    text: "Choose Cover"
                },
                multiple: false
            } );

            //when a file is selected, grab the URL and set it as the text field's value
            np_uploader.on( 'select', function() {
                attachment = np_uploader.state().get('selection').first().toJSON();
                url_field.val(attachment.url).attr( 'value', attachment.url );
                $('#series-cover-preview img').attr( 'src', attachment.url );
                $('#series-cover-preview').css('display', 'inline-block');
            });

        //Open the uploader dialog
        np_uploader.open();

    });

    //initiate the close (x) button on the cover image
    $('#series-cover-preview i').on('click', function() {
        url_field.val('').attr( 'value', '' );
        $('#series-cover-preview').hide();
    });

});