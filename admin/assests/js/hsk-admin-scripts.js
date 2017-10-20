(function( $ ) {
    "use strict";
    /* Start here */
    $.noConflict();
    // Enable / Disable talent options group info and required fields also
    var valuesArray = $("#talents_meta_category option").map(function(){
    return this.value;
  }).get();
    //alert(valuesArray);
        $('#talents_meta_category').on('change', function(){
      //alert();
        $.each(valuesArray, function(id, option) { 
        $('#'+option).hide();
        $('#'+option + ' .required' ).find('input').removeAttr('required');
      });
      var $talent_cat = $(this).find('option:selected').val();
      $('#'+$talent_cat).show();
      $('#'+$talent_cat + ' .required' ).find('input').attr('required','true');


    }).change();
    // Option panel add accordion panels
     $(".hsk-talent-options-wrapper form").accordion({ header: "h3", autoHeight: true, heightStyle: "content" });


       function ct_media_upload(button_class) {
         var _custom_media = true,
         _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function (props, attachment) {
if (_custom_media) {
$('#hsk-talent-cat-img-id').val(attachment.id);
//$('#hsk-talent-cat-image-wrapper').html('');
$('#hsk-talent-cat-image-wrapper .custom_media_image').attr('src', attachment.sizes.thumbnail.url).css('display', 'block');
} else {
return _orig_send_attachment.apply(button_id, [props, attachment]);
}
}
         wp.media.editor.open(button);
         return false;
       });
     }
     ct_media_upload('.hsk_talent_cat_media_button.button'); 
     $('body').on('click','.hsk_talent_cat_media_remove',function(){
       $('#hsk-talent-cat-img-id').val('');
       $('#hsk-talent-cat-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });
     $(document).ajaxComplete(function(event, xhr, settings) {
       var queryStringArr = settings.data.split('&');
       if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
         var xml = xhr.responseXML;
         $response = $(xml).find('term_id').text();
         if($response!=""){
           // Clear the thumb image
           $('#hsk-talent-cat-image-wrapper').html('');
         }
       }
   });
// End Jquery    
})(jQuery);

jQuery( document ).ready( function( $ ) {
  var file_frame;
  $( document.body ).on( 'click', '.custom_media_upload', function( event ) {
    var $el = $( this );

    var file_target_input   = $el.parent().find( '.custom_media_input' );
    var file_target_preview = $el.parent().find( '.custom_media_preview' );

    event.preventDefault();

    // Create the media frame.
    file_frame = wp.media.frames.media_file = wp.media({
      // Set the title of the modal.
      title: $el.data( 'choose' ),
      button: {
        text: $el.data( 'update' )
      },
      states: [
        new wp.media.controller.Library({
          title: $el.data( 'choose' ),
          library: wp.media.query({ type: 'image' })
        })
      ]
    });

    // When an image is selected, run a callback.
    file_frame.on( 'select', function() {
      // Get the attachment from the modal frame.
      var attachment = file_frame.state().get( 'selection' ).first().toJSON();

      // Initialize input and preview change.
      file_target_input.val( attachment.url );
      file_target_preview.css({ display: 'none' }).find( 'img' ).remove();
      file_target_preview.css({ display: 'block' }).append( '<img src="' + attachment.url + '" style="max-width:100%">' );
    });

    // Finally, open the modal.
    file_frame.open();
  });

  // Media Uploader Preview
  $( 'input.custom_media_input' ).each( function() {
    var preview_image  = $( this ).val(),
      preview_target = $( this ).siblings( '.custom_media_preview' );

    // Initialize image previews.
    if ( preview_image !== '' ) {
      preview_target.find( 'img.custom_media_preview_default' ).remove();
      preview_target.css({ display: 'block' }).append( '<img src="' + preview_image + '" style="max-width:100%">' );
    }
  });
});