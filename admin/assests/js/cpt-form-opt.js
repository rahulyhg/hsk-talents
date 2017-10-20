(function( $ ) {
    "use strict";
    /* Start here */
    $.noConflict();
    $( '.hsk-talents-color-pickr' ).wpColorPicker();
    
     $(document).on('nested:fieldRemoved', function(event) {
            $('[required]', event.field).removeAttr('required');
        });
    // Fields Hide & Show
    $('.generate-tab-new-fields').each(function(){
        $(this).find('.options_fields_group .input-type-select').on('change', function(){
            var option_type = $(this).find('option:selected').val();
            $(this).parent().next().find('.select_field_select_options').parent().removeClass('show_options_data');
            $(this).parent().next().find('.input-type-select-date-format').parent().removeClass('show_options_data');
            $(this).parent().next().next().next().next().find('.talent_option_display_search').parent().removeClass('show_options_data').show(); //
            $(this).parent().next().next().next().next().next().find('.talent_option_search_range').parent().removeClass('show_options_data').show(); //
            $(this).parent().next().next().next().next().next().next().next().next().next().find('ul').removeClass('show_options_data');
            $(this).parent().next().next().next().removeClass('option_hide').show();
            $(this).parent().next().next().next().next().next().removeClass('option_hide').show();
            $(this).parent().next().next().next().next().next().next().removeClass('option_hide').show();
            $(this).parent().next().next().next().next().next().next().next().removeClass('option_hide').show();
            $(this).parent().next().next().next().next().next().next().next().next().removeClass('option_hide').show();
            $(this).parent().next().next().next().next().next().next().next().next().next().removeClass('option_hide').show();
            $(this).parent().next().next().next().next().next().next().next().next().next().next().removeClass('option_hide').show();

            $(this).parent().next().next().next().next().next().next().find('.talent_option_search_range').parent().removeClass('show_options_data').hide();  // Search Range
            
            if((  option_type == 'select' ) || (  option_type == 'checkbox' ) ){
                $(this).parent().next().find('.select_field_select_options').parent().addClass('show_options_data');
                $(this).parent().next().next().next().next().next().next().find('.talent_option_search_range').parent().addClass('show_options_data').show(); 
            }else if( (option_type == 'date') || ( option_type == 'date_cal' ) ){
                //alert(option_type);
                $(this).parent().next().find('.input-type-select-date-format').addClass('show_options_data');
            }else if( (option_type == 'images') || ( option_type == 'videos' ) ){
                $(this).parent().next().find('.talent_options_field_heading').parent().addClass('show_options_data');
                $(this).parent().next().next().next().next().find('.talent_option_display_search').parent().addClass('show_options_data').hide();
                $(this).parent().next().next().next().next().next().find('.talent_option_search_range').parent().addClass('show_options_data1').hide();
                //$(this).parent().parent().find('.hsk-user-roles-limits-info').addClass('show_options_data');
                 $(this).parent().next().next().next().next().next().next().next().next().next().find('ul').addClass('show_options_data');

            }if((  option_type == 'panel_title' )){
                $(this).parent().next().next().next().addClass('option_hide').hide();
                $(this).parent().next().next().next().next().addClass('option_hide').hide();
                $(this).parent().next().next().next().next().next().addClass('option_hide').hide();
                $(this).parent().next().next().next().next().next().next().addClass('option_hide').hide();
                $(this).parent().next().next().next().next().next().next().next().addClass('option_hide').hide();
                $(this).parent().next().next().next().next().next().next().next().next().addClass('option_hide').hide();
                $(this).parent().next().next().next().next().next().next().next().next().next().addClass('option_hide').hide();
            }else {
              $(this).parent().parent().find('.hsk-user-roles-limits-info').removeClass('show_options_data');
            }
        }).change();
    });


      
       $('.hsk_create_opt_fields').each(function(){
          var totla_count = $('.generate-tab-new-fields').length;
            $(this).find('#talent_opt_field_gname').on('click', function(){
                var $totla_count = totla_count++; 
                $(this).parent().parent().find('.generate-tab-new-fields').first().clone(true).addClass('generate-tab-new-fields_'+$totla_count).removeClass('generate-tab-new-fields_0').appendTo('.custom_options_field').find("input, textarea").val("");
                $('.custom_options_field').attr('data-values', $totla_count);
                return false;
            })
        })
    //Generate Unique ID
    $('.generate-tab-new-fields').each(function(){
       var $current = $(this);
        $(this).on('blur', '.field_group_tab_name', function(e){
          //  var $i = $('.options_fields_group').length;
            e.stopPropagation();
            var target = $(this).nextAll('.field_group_tab_uid');
            var str1 = "<br />";
          //  $i++;
            var english = /^[A-Za-z0-9]+/g;
            if (!english.test($(this).val())){
                if(target.val()=='' || ( $('.field_group_tab_uid').val().match("<br />") && str1.match("<br />") ) ){
                     target.val('tab_'+Math.round(new Date().getTime() + (Math.random() * 100)));
                 }
            }
            if(  $('.field_group_tab_uid').val().match("<br />") && str1.match("<br />") || target.val()=='' ){
             var field_uid = target.val('tab_'+Math.round(new Date().getTime() + (Math.random() * 100)));
             $(this).parent().find('.options_fields_group  td .talent_meta_label_name').attr('name', 'talent_opt_data[talent_meta_label_name]['+ target.val() +'][]');
             $(this).parent().find('.options_fields_group  td .talent_meta_label_uid').attr('name', 'talent_opt_data[talent_meta_label_uid]['+ target.val() +'][]');
             $(this).parent().find('.options_fields_group  td .talent_option_rquired ').attr('name', 'talent_opt_data[talent_option_rquired]['+ target.val() +'][]');
             $(this).parent().find('.options_fields_group  td .talent_option_display_search  ').attr('name', 'talent_opt_data[talent_option_display_search]['+ target.val() +'][]');
             $(this).parent().find('.options_fields_group  td .talent_option_visibility ').attr('name', 'talent_opt_data[talent_option_visibility]['+ target.val() +'][]');
             $(this).parent().find('.options_fields_group  td .talent_option_search_range ').attr('name', 'talent_opt_data[talent_option_search_range]['+ target.val() +'][]');
             $(this).parent().find('.options_fields_group  td .talent_option_dsiplay_compcard ').attr('name', 'talent_opt_data[talent_option_dsiplay_compcard]['+ target.val() +'][]');
             $(this).parent().find('.options_fields_group  td .talent_option_dsiplay_on_img ').attr('name', 'talent_opt_data[talent_option_dsiplay_on_img]['+ target.val() +'][]');
             $(this).parent().find('.options_fields_group  td .talent_options_field_heading ').attr('name', 'talent_opt_data[talent_options_field_heading]['+ target.val() +'][]');
             $(this).parent().find('.options_fields_group  td .talent_meta_field_name ').attr('name', 'talent_opt_data[talent_meta_field_name]['+ target.val() +'][]');

            $(this).parent().find('.options_fields_group  td .talent_meta_field_options ').attr('name', 'talent_opt_data[talent_meta_field_options]['+ target.val() +'][]');
            $(this).parent().find('.options_fields_group  td .pf_meta_field_name ').attr('name', 'talent_opt_data[pf_meta_field_name]['+ target.val() +'][]');
            $(this).parent().find('.options_fields_group  td .talent_meta_field_date_format ').attr('name', 'talent_opt_data[talent_meta_field_date_format]['+ target.val() +'][]');

            }
            if(target.val()=='' || ( $('.field_group_tab_uid').val().match("<br />") && str1.match("<br />") ) ){
              // target.val(kaya_string_to_key($(this).val()));
                $current.find('.options_fields_group  td .input_field_label_name').addClass('abc').attr('name', 'test');
            }
        });
    });

    $('.generate-tab-new-fields').each(function(i){
        var current_position = $(this);
        $(this).find('#delete_options_group').on('click', function(){
            $(this).parent().parent().remove();
            return false;
        });
   });
    //Delete Options
     $('.generate-tab-new-fields').each(function(i){
      var current_options = $(this);
        $(this).find('#create_option').on("click", function(){
        $(this).parent().parent().find('.table tbody tr:first').clone(true).appendTo( $(this).parent().parent().find('.table tbody') ).find('td .hsk-options-group-fields').show().find("input, textarea").val("").find('td .hsk-options-group-fields').show().find('td').text('');
        //$(this).parent().parent().find('.table tbody tr:first').clone(true).appendTo( $(this).parent().parent().find('.table tbody') ).find("input, textarea").val("").find('td .hsk-options-group-fields').show().find('td').text('');
        $(this).parent().parent().addClass('clicking');
        return false;
        });

        $(this).find('.options_fields_group .hsk-options-group-fields .talent_meta_field_name').change(function() {
            $(this).parent().parent().parent().prev().html($(this).val());

        });
        $(this).find('.options_fields_group .hsk-options-group-fields .talent_meta_label_uid').blur(function() {
            $(this).parent().parent().parent().next().html($(this).val());

        });
        $(this).find('.options_fields_group .hsk-options-group-fields .talent_meta_label_name').keyup(function() {
            $(this).parent().parent().parent().find('span').attr('names', $(this).val()).text($(this).val());

        });
    });
    // Dele Fields 
    $('.fields_options_delete').each(function(){
        $(this).on("click", ".delete", function(){
        var label_name = $(this).parents('.options_fields_group').find('td input.input_field_label_name').val(); 
            $(this).parent().parent().remove();
            return false;
        });
    })
    //Generate Unique ID
    $('.hsk-meta-options-form-group').each(function(){
        $(this).find('.options_fields_group').on('blur', '.input_field_label_name', function(e){
            var $i = $('.options_fields_group').length;
            e.stopPropagation();
            var target = $(this).parent().next().find('.input_field_uid_name');
            //alert(target);
            var str1 = "<br />";
            $i++;
            var english = /^[A-Za-z0-9]+/g;
            if (!english.test($(this).val())){
                if(target.val()=='' || ( $('.input_field_uid_name').val().match("<br />") && str1.match("<br />") ) ){
                     target.val('id_'+Math.round(new Date().getTime() + (Math.random() * 100)));
                 }
            }
            if(  $('.input_field_uid_name').val().match("<br />") && str1.match("<br />") ){
               target.val('id_'+Math.round(new Date().getTime() + (Math.random() * 100)));
            }
            if(target.val()=='' || ( $('.input_field_uid_name').val().match("<br />") && str1.match("<br />") ) ){
                target.val('id_'+Math.round(new Date().getTime() + (Math.random() * 100)));
            }
        });
    });
    // Validate Options Data
    $('.form-opt-save').on('click', function(){
       var validate;
       $('.options_fields_group:not(:first) .input_field_label_name').each(function(){
        var label_val = $(this).val();
        if( label_val != '' ){
            $(this).removeClass('validate-field-error');
            validate = true;
        }else{
          $(this).addClass('validate-field-error');
          $('html, body').animate({
                scrollTop: $(".validate-field-error").offset().top - 50
            }, 800);
          validate = false;
        }
        return validate;
      });
        return validate;
    });

    /*** Format string to be a good uid ***/
    function kaya_string_to_key(string){
        string = string+'';
        string = string.toLowerCase();
        string = string.replace(/[^a-z0-9]+/g, '_').replace(/[_]+$/g, '');/*** Replace non alphanumeric with underscores. Remove last underscore ***/
        return string;
    }

    //

    $('.fields_options_edit').each(function(){
      $(this).on('click', 'a', function(){
          $(this).parent().prev().prev().find('.hsk-options-group-fields').slideToggle();
          return false;
      });
    });
    
    $('.hsk-button-add').each(function(){
      $(this).on('click', function(){
          $(this).parent().slideToggle();
          return false;
      });
    });

    // Ui Draggables Slider
    $(".generate-tab-new-fields .table #hsk-options-sortable").sortable();
    //
// End Jquery    
})(jQuery);