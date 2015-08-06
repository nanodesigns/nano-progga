/* JavaScripts for nano-progga powered admin-end Tweaks */
jQuery(document).ready(function($) {

    /* ----------------------------------------------------------- */
    /*  0. Add Logo image using WordPress' media uploader
    /*  @scope: admin/nano-progga-settings.php
    /* ----------------------------------------------------------- */
    var np_logo_uploader;

    $('#site-logo').click( function(e) {
            e.preventDefault();

            //if the uploader object has already been created, reopen the dialog
            if( np_logo_uploader ) {
                np_logo_uploader.open();
                return;
            }

            //extend the wp.media object
            np_logo_uploader = wp.media.frames.file_frame = wp.media( {
                title:"Choose Site Logo",
                button:{
                    text: "Select Logo"
                },
                multiple: false
            } );

            //when a file is selected, grab the URL and set it as the text field's value
            np_logo_uploader.on( 'select', function() {
                attachment = np_logo_uploader.state().get('selection').first().toJSON();
                $('#np-logo').val(attachment.url).attr( 'value', attachment.url );
                $('#logo-preview').attr( 'src', attachment.url );
            });

        //Open the uploader dialog
        np_logo_uploader.open();

    });

    //remove image
    $('.np-close').on('click', function(){
        $('#logo-preview').attr( 'src', np.theme_path +'/images/placeholder.png' );
        $('#np-logo').val('').attr( 'value', '' );
    });


    /* ----------------------------------------------------------- */
    /*  1. ColorPicker by Iris
    /*  @scope: admin/nano-progga-settings.php
    /* ----------------------------------------------------------- */
    var color_selectors_bg = $('#widget-1, #widget-2, #widget-3, #widget-4, #widget-5'),
        color_sel_txt = $('#txt-widget-1, #txt-widget-2, #txt-widget-3, #txt-widget-4, #txt-widget-5');

    color_selectors_bg.minicolors({
        change: function(hex, opacity) {
            var item_id = $(this).attr('id');
            $('#'+item_id +'-preview').css("background-color", hex);
        }
    });
    color_sel_txt.minicolors({
        change: function(hex, opacity) {
            var itm_id = $(this).attr('id');
            $('#'+itm_id +'-preview').css("color", hex);
            $('#'+itm_id +'-preview h4').css("border-bottom-color", hex);
        }
    });
    
});