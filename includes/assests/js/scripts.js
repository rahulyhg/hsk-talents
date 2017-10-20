(function($){
    "use scripts";


    /**
     * Image box colors
     */
    $('.hsk-img-content-wrapper').each(function(){
        var hover_color = $(this).find('.image-button-text').data('hover');
        var color = $(this).find('.image-button-text a').css('color');
        $(this).find('.image-button-text a').hover(function(){
            $(this).css('color', hover_color);
        }, function(){
            $(this).css('color', color);
        });
    });
    
    var valuesArray = $("#hsk-talent-options-val option").map(function(){
        return this.value;
    }).get();
        $('#hsk-talent-options-val').on('change', function(){
        $.each(valuesArray, function(id, option) { 
        $('.'+option).hide();
        $('.'+option + ' .required' ).find('input').removeAttr('required');
      });
      var $talent_cat = $(this).find('option:selected').val();
      $('.'+$talent_cat).show();
      $('.'+$talent_cat + ' .required' ).find('input').attr('required','true');


    }).change();

    /**
     * Fancy Group
     */
    //$('.fancybox').fancybox();
    $().fancybox({
      selector : '[data-fancybox="images"]',
      thumbs   : false,
      hash     : false,
    });

    /**
     * Single Page Tab
     */ 
    function hsk_talent_single_page_tab() {
    $('.hsk-talent-tabs-content-wrapper').each(function() {
        $(".hsk-single-talent-content").hide(); //Hide all content
        $(".hsk-talent_tabs-wrapper ul li:first").addClass("tab-active").show();
        $(".hsk-single-talent-content:first").stop(true, true).fadeIn(0);
        $(".hsk-talent_tabs-wrapper ul li").click(function() {
            $(".hsk-talent_tabs-wrapper ul li").removeClass("tab-active");
            $(this).addClass("tab-active");
            $(".hsk-single-talent-content").stop(true, true).fadeOut(0);
            var activeTab = $(this).find("a").attr("href");
            $(activeTab).stop(true, true).fadeIn(800);
            return false;
        });
    });
}
hsk_talent_single_page_tab();

// Start user regitration 
$('#hsk_user_reg_submit').on('click', function(event) {
    if (event.preventDefault) {
        event.preventDefault();
    } else {
        event.returnValue = false;
    }
     // Show 'Please wait' loader to user, so she/he knows something is going on
     var has_fields = true;
    // Collect data from inputs
    var reg_nonce = $('#hsk_user_add_nonce').val();
    var hsk_user_role  = $('#hsk_user_role option:selected').val();
    var hsk_user  = $('#hsk_user_name').val();
    var hsk_fname  = $('#hsk_fname').val();
    var hsk_email  = $('#hsk_email').val();
    var hsk_lname  = $('#hsk_lname').val();
    var hsk_phone_number  = $('#hsk_phone_number').val();
    email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
    if( hsk_user == ''){
        $('#hsk_user_name').addClass('hsk-error-field');
        has_fields = false;
    }else{
        $('#hsk_user_name').removeClass('hsk-error-field');
    }
    if( hsk_user_role == ''){
        $('#hsk-user-role').addClass('hsk-error-field');
        has_fields = false;
    }else{
        $('#hsk-user-role').removeClass('hsk-error-field');
    }
    if( hsk_fname == ''){
        $('#hsk_fname').addClass('hsk-error-field');
        has_fields = false;
    }else{
        $('#hsk_fname').removeClass('hsk-error-field');
    }
    if( hsk_lname == ''){
        $('#hsk_lname').addClass('hsk-error-field');
        has_fields = false;
    }else{
        $('#hsk_lname').removeClass('hsk-error-field');
    }
    if( hsk_email == ''){
        $('#hsk_email').addClass('hsk-error-field');
        has_fields = false;
    }else{
        if(!email_regex.test(hsk_email)){
            $('#hsk_email').addClass('hsk-error-field');
            has_fields = false;
        }else{
            $('#hsk_email').removeClass('hsk-error-field');
        }
    }
    if( hsk_phone_number == ''){
        $('#hsk_phone_number').addClass('hsk-error-field');
        has_fields = false;
    }else{
        $('#hsk_phone_number').removeClass('hsk-error-field');
    }
    var ajax_url = hsk_ajax.ajax_url; 
    // Data to send
    data = {
      action: 'hsk_register_user',
      nonce: reg_nonce,
      hsk_user_role: hsk_user_role,
      hsk_user_name: hsk_user,
      hsk_fname: hsk_fname,
      hsk_email: hsk_email,
      hsk_lname: hsk_lname,
      hsk_phone_number: hsk_phone_number,
    };
    if( has_fields ){
        $('.hsk-loading').show();
        $('.hsk-result-message').hide();
        // Do AJAX request
        $.post( ajax_url, data, function(response) { 
          // If we have response
          if( response ) { 
            // Hide 'Please wait' indicator
            $('.hsk-loading').hide(); 
            if( response === '1' ) {
              // If user is created
              $('.hsk-result-message.alert.hsk-success-msg').show(); // Add success message to results div
              $('.hsk-registration-form input:not("#hsk_user_reg_submit")').val('');
            } else {
              $('.hsk-result-message').addClass('alert hsk-error-msg').html( response ); // If there was an error, display it in results div
              $('.hsk-result-message').show(); // Show results div
            }
          }
        });
    }
  });
//End user registration
// User Login
$('#hsk_user_login_btn').on('click', function(e){
    //$('form#login p.status').show().html(ajax_login_object.loadingmessage);
    var data_tst = $('form #user_name').val();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: hsk_ajax.ajax_url,
        data: {
            action: 'hsk_ajax_login', //calls wp_ajax_nopriv_ajaxlogin
            'username': $('form #user_name').val(), 
            'password': $('form #password').val(), 
            'security': $('form #security').val() },
        success: function(data){
            if (data.loggedin == true){
                $('#hsk_login_status').addClass('alert hsk-success-msg').removeClass('hsk-error-msg').html(data.message);
                document.location.href = data.redirect_url;
            }else{
                $('#hsk_login_status').addClass('alert hsk-error-msg').html(data.message);
            }
        }
    });
    e.preventDefault();
});

// Talents Follow buttons
$('.talent-button-info a#hsk-talent-follow').on('click', function(){
    var post_id = $(this).data('post-id');
    var post_author_id = $(this).data('post-author-id');
    var follow_user_id = $(this).data('user-id');
    $('.hsk-talent-follow-success').hide();
    $.ajax({
            url : hsk_ajax.ajax_url,
            type : 'post',
            data : {
                action : 'hsk_follow_talents',
                post_id : post_id,
                post_author_id : post_author_id,
                follow_user_id : follow_user_id
            },
            success : function( response ) {
                $('.hsk-talent-follow-success').show();
                window.location.reload(false);
            }
        });
})
// End User Login
// Rating form 
$('#hsk-user-rating').on('click', function(){
    $('.hsk-rating-form-wrapper').show();
});
$('.hsk-form-close').on('click', function(){
    $('.hsk-rating-form-wrapper').hide();
})
// Ajax Rating system
$('#hsk_talent_submit').click(function(){
    var $user_id = $('#hsk_user_id').val();
    var $post_id = $('#hsk_post_id').val();
    var $rating = $('.hsk_rating:checked').val();
    if( $rating == undefined){
        alert('Please Select Rating');
        return false;
    }
    var $rating_comment = $('#hsk_rating_comment').val();
    $.ajax({
        url : hsk_ajax.ajax_url,
        type : 'post',
        data : {
            action : 'hsk_talent_rating_form',
            user_id : $user_id,
            post_id : $post_id,
            rating : $rating,
            rating_comment : $rating_comment
        },
        success : function( response ) {
            alert(response);
            $('.hsk-rating-form-wrapper').fadeOut(200);
          // window.location.href += "?code=approved";
            window.location.reload();
            $('.hsk-talent-follow-success').show();
            //alert('success fully inserted');
            //window.location.reload(false);
        }
    });
});
// Enquiery form 
$('.hsk-talent-enquiry').on('click', function(){
    $('.hsk-talent-enquiry-form').show();
});
$('.enquiry-form-close').on('click', function(){
    $('.hsk-talent-enquiry-form').hide();
})
$('#hsk_talent_enquiry_submit').click(function(){
    var has_fields = true;
    var $hsk_talent_url = $('input#hsk_talent_url').val();
    var $hsk_enquiery_name = $('#hsk_enquiery_name').val();
    var $hsk_enquiery_email = $('#hsk_enquiery_email').val();
    var $hsk_enquiery_contact_num = $('#hsk_enquiery_contact_num').val();
    var $hsk_enquiery_description = $('#hsk_enquiery_description').val();
    var $hsk_ajax_nonce = $('#hsk_ajax_nonce').val();
    var email = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if( $hsk_enquiery_name == '' ){
        $('#hsk_talent_url').addClass('hsk-error-field');
        has_fields = false;
    }else{
        $('#hsk_talent_url').removeClass('hsk-error-field');
        has_fields = true;
    }
    if( $hsk_enquiery_email == '' ){
        $('#hsk_talent_url').addClass('hsk-error-field');
        has_fields = false;
    }else{
        if (email.test(hsk_enquiery_email)){
            $('#hsk_talent_url').addClass('hsk-error-field');
            has_fields = false;
        }else{
            $('#hsk_talent_url').removeClass('hsk-error-field');
            has_fields = true;
        }
    }
    if( $hsk_enquiery_contact_num == '' ){
        $('#hsk_enquiery_contact_num').addClass('hsk-error-field');
        has_fields = false;
    }else{
        $('#hsk_enquiery_contact_num').removeClass('hsk-error-field');
        has_fields = true;
    }
    if( $hsk_enquiery_description == '' ){
        $('#hsk_enquiery_description').addClass('hsk-error-field');
        has_fields = false;
    }else{
        $('#hsk_enquiery_description').removeClass('hsk-error-field');
        has_fields = true;
    }
    if( has_fields == false ){}
    else{
        $.ajax({
            url : hsk_ajax.ajax_url,
            type : 'post',
            data : {
                action : 'hsk_talent_enquiry',
                hsk_talent_url : $hsk_talent_url,
                name : $hsk_enquiery_name,
                email : $hsk_enquiery_email,
                contact_num : $hsk_enquiery_contact_num,
                description : $hsk_enquiery_description,
                 _ajax_nonce: $hsk_ajax_nonce,
            },
            success : function( response ) {
                $('.hsk-talent-enquiry-msg').html(response);
                return false;
            }
        });
    }
});
/**
 * Talent  Slider
 */
 $('.hsk-talent-content-slider.owl-carousel').each(function(){
    var columns = $(this).data('columns');
    var guttor_enable = $(this).data('guttor');    
    var columns2 = (columns == 1 ) ? '1' : '2';
    var columns3 = ((columns == 1 ) || ( columns == 2 )) ? $columns : '3';
    var guttor = ( guttor_enable == 'on') ? 0 : 20;
     $(this).owlCarousel({
        loop:true,
        margin:guttor,
        items:4,
        autoplayHoverPause:true,
        nav:false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            480:{
                items:columns2,
            },
            768:{
                items:columns3,
            },
            1000:{
                items:columns,
            }
        }
    });
});
 /**
 * Talent Category Slider
 */
 $('.hsk-talents-cat-wrapper.owl-carousel').each(function(){
    var columns = $(this).data('columns');
    var columns2 = (columns == 1 ) ? '1' : '2';
    var columns3 = ((columns == 1 ) || ( columns == 2 )) ? $columns : '3';
     $(this).owlCarousel({
        loop:true,
        margin:0,
        items:4,
        autoplayHoverPause:true,
        nav:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            480:{
                items:columns2,
            },
            768:{
                items:columns3,
            },
            1000:{
                items:columns,
            }
        }
    });
});
 // catgory title show / hide on hover
 /*$('.hsk-talents-cat-wrapper.owl-carousel1').each(function(){
    $(this).find('.talents-cat-content-wrapper1').hover(function(){
       // alert('hover');
       $(this).find('h3').stop(true, true).animate({'opacity':1, 'bottom':0},650);
       $(this).find('.owl-nav .owl-prev').show();
    }, function(){
        $(this).find('h3').stop(true, true).animate({'opacity':0, 'bottom':'-100%'},450);
        $(this).find('.owl-nav .owl-prev').hide();
    });
 }); */
// user message
$('a#hsk-non-user-logged-in').on('click', function(){
    $('.hsk-non-user-logged-in').show(150);
});
/**
 * Talent Single Page Related Slider
 */
 $('#hsk-related-talents.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    items:4,
    autoplay : true,
    autoplayHoverPause:false,
    nav:false,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        480:{
            items:2,
        },
        768:{
            items:3,
        },
        1000:{
            items:4,
        }
    }
})

$(window).load(function(){
    var $container = $('.hsk-talents-filter-content-wrapper');
    $container.isotope({
        filter: '*',
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        }
    });
 
    $('#filter a').click(function(){
        $('#filter .current').removeClass('current');
        $(this).addClass('current');
 
        var selector = $(this).attr('data-filter');
        $container.isotope({
            filter: selector,
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
         });
         return false;
    }); 
});


/**
 * Count Favouritivies Items
 */
function get_total_favourite() {
    var favouritive_items_count = $('.favouritive-items-count');
    $.ajax({
      type: 'POST',
      url: hsk_ajax.ajax_url,
       data : {
        action : 'hsk_favouritive_items_count',
      },
      success: function(data) {
        favouritive_items_count.html(data);
      }
    });
  }
  get_total_favourite();
/**
 * Add items to Favouritives
 */
$('.favourite-item-type, .hsk-talent-add-favarative').on('click', function(e){
    $this = $(this);
    var $fav_item_id = $(this).parent().parent().attr('id');
    var $item_action_type = $(this).data('item-action');
    if( $item_action_type == 'add' ){
        $this.parent().parent().addClass('item_added');
    }
    if( $item_action_type == 'remove' ){
        $this.parent().parent().removeClass('item_added');
    }
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: hsk_ajax.ajax_url,
        data: {
            action: 'hsk_add_items_to_favouritive', //calls wp_ajax_nopriv_ajaxlogin
            'fav_item_id': $fav_item_id,
            'item_action_type' : $item_action_type
        },
        success: function(data){
            //$this.addClass('test');
            get_total_favourite();
            if( $item_action_type == 'add' ){
                $this.parent().parent().addClass('item_added');
            }
            if( $item_action_type == 'remove' ){
                $this.parent().parent().removeClass('item_added');
            }
        }
    });
    e.preventDefault();
});

$('.hsk-talent-favouritive-items .talent-remove-favourite, .hsk-talent-remove-favarative').on('click', function(e){
   $this = $(this);
    var $fav_item_id = $(this).parent().parent().attr('id');
    var $item_action_type = 'remove';
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: hsk_ajax.ajax_url,
        data: {
            action: 'hsk_add_items_to_favouritive', //calls wp_ajax_nopriv_ajaxlogin
            'fav_item_id': $fav_item_id,
            'item_action_type' : $item_action_type
        },
        success: function(data){
            //$this.addClass('test');
            get_total_favourite();
            //$this.parent().parent().remove();
            if( $item_action_type == 'add' ){
                $this.parent().parent().addClass('item_added');
            }
            if( $item_action_type == 'remove' ){
                $this.parent().parent().removeClass('item_added');
            }
        }
    });
    e.preventDefault();
});

/**
 * Favouritive Page Items Remove
 */ 
$('.clear-favouritive-items a').on('click', function(e){
    $this = $(this);
    var $fav_item_id = $(this).parent().parent().attr('id');
    var $item_action_type = 'empty';
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: hsk_ajax.ajax_url,
        data: {
            action: 'hsk_add_items_to_favouritive', //calls wp_ajax_nopriv_ajaxlogin
            //'fav_item_id': $fav_item_id,
            'item_action_type' : $item_action_type
        },
        success: function(data){
            //$this.addClass('test');
            get_total_favourite();
            //alert(get_total_favourite());
            $('ul.hsk-talents-content-wrapper li').fadeOut(function() {
            $(this).remove();
          });
            $('.hsk-favaroutive-item-count').show();
            if( $item_action_type == 'empty' ){
               //$('.hsk-talents-content-wrapper li').remove();
            }
             if( get_total_favourite() == '0' ){
                $('.hsk-favaroutive-item-count').fadeIn('250');
            }
        }
    });
    e.preventDefault();
});

/**
 * Shortlist Enquiery Form
 */
 $('.hsk-share-favouritive').on('click', function(){
    $('.hsk-favourite-enquiry-form').show();
});
$('.enquiry-form-close').on('click', function(){
    $('.hsk-favourite-enquiry-form').hide();
})
// Email Submit Through Ajax
$('#hsk_favouritive_submit').click(function(){
    var $favourite_ids = $('input#favourite_ids').val();
    var $sender_name = $('input#sender_name').val();
    var $sender_email = $('#sender_email').val();
    var $receiver_email = $('#receiver_email').val();
    var $receiver_email_desc = $('#receiver_email_desc').val();
   // var $hsk_ajax_nonce = $('#hsk_ajax_nonce').val();
    var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
    var has_fields = true;
    if( $sender_name == '' ){
        $('#sender_name').addClass('hsk-error-field');
        has_fields = false;
    }else{
        $('#sender_name').removeClass('hsk-error-field');
    }
    if( $sender_email == '' ){
        $('#sender_email').addClass('hsk-error-field');
        has_fields = false;
    }else{
        if(!email_regex.test($sender_email)){
            $('#sender_email').addClass('hsk-error-field');
            has_fields = false;
        }else{
            $('#sender_email').removeClass('hsk-error-field');
        }
    }
    if( $receiver_email == '' ){
        $('#receiver_email').addClass('hsk-error-field');
        has_fields = false;
    }else{        
        if (!email_regex.test($receiver_email)){
            $('#receiver_email').addClass('hsk-error-field');
            has_fields = false;
        }else{
            $('#receiver_email').removeClass('hsk-error-field');
        }
    }
   
    if( has_fields == false ){

    }
    else{ 
    $('#favouritive-submit-loader-img').show();
    $.ajax({
            url : hsk_ajax.ajax_url,
            type : 'post',
            data : {
                action : 'hsk_favouritives_enquiry',
                favourite_ids : $favourite_ids,
                sender_name : $sender_name,
                sender_email : $sender_email,
                receiver_email : $receiver_email,
                receiver_email_desc : $receiver_email_desc,
                // _ajax_nonce: $hsk_ajax_nonce, = w
            },
            success : function( response ) {
                $('#favouritive-submit-loader-img').hide();
                $('.hsk-favourite-enquiry-msg').addClass('hsk-result-message hsk-success-msg alert').html(response);
                return false;
            }
        });
    }
});
/**
 * Talent Single Page Related Slider
 */
 $('.enable-blog-post-slider.owl-carousel').each(function(){
     $(this).owlCarousel({
        loop:true,
        margin:10,
        items:2,
        autoplay : true,
        autoplayHoverPause:false,
        responsiveClass:false,
        nav:false,
        responsive:{
            0:{
                items:1,
                nav:true
            },
            480:{
                items:2,
                nav:false
            },
            768:{
                items:3,
                nav:false
            },
            1024:{
                
            }
        }
    })
});
/**
 * Socila Sharing ICons
 */ 
$('.hsk-talent-share-icons').on('click', function(){
    $('.hsk-talent-social-icons').show();
});

$('span.close-socila-share-icons').on('click', function(){
    $('.hsk-talent-social-icons').hide();  
});

/**
 * Rating & Followers Tab
 */
 $('.hsk-rating-followers-tab .hsk-tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');
    $('.hsk-rating-followers-tab .hsk-tabs li').removeClass('current');
    $('.tab-content-info').removeClass('current');
    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
})

/**
 * Talent  Slider
 */
 $('.hsk-woo-slider-wrapper.owl-carousel').each(function(){
      var columns = $(this).data('columns');
     $(this).owlCarousel({
        loop:true,
        margin:2,
        autoplay : true,
        items:columns,
        autoplayHoverPause:true,
        nav:false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            480:{
                items:1,
            },
            768:{
                items:3,
            },
            1000:{
                items:columns,
            }
        }
    });
});
// Testimonial Slider
/**
 * Talent  Slider
 */
 $('.testimonial-slider-content-wrapper.owl-carousel').each(function(){
    var columns = $(this).data('columns');
     $(this).owlCarousel({
        loop:true,
        margin:20,
        items:2,
        autoplay : true,
        autoplayHoverPause:true,
        nav:false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            480:{
                items:1,
            },
            768:{
                items:1,
            },
            1000:{
                items:columns,
            }
        }
    });
});
// Social Follow Icons
$('.social-media-icons-wrapper').each(function(){
    var $this = $(this).find('ul');
        var $color = $this.data('color');
        var $padding = $this.data('padding');
        var $border_radius = $this.data('borderradius');
        var $bgcolor = $this.data('bgcolor') ? $this.data('bgcolor') : '';
        var $hovercolor = $this.data('hovercolor') ? $this.data('hovercolor') : $color;
        var $hover_bgcolor = $this.data('hoverbgcolor') ? $this.data('hoverbgcolor') : '';
        $this.find('li a').css({'color':$color, 'background':$bgcolor, 'padding':$padding, 'border-radius':$border_radius });
    $(this).find('ul li a').hover(function(){
        $(this).css({'color':$hovercolor, 'background':$hover_bgcolor });
    }, function(){
        $(this).css({'color':$color, 'background':$bgcolor });
    });
});
//tabs

/**
 * Masonary Gallery
 */
$(window).load(function(){
    $( '.hsk-talents-content-wrapper > ul, .hsk-single-talent-gallery > ul, .gallery' ).masonry()
});

// Ajax Post likes
$(document).on('click', '.sl-button', function() {
        var button = $(this);
        var post_id = button.attr('data-post-id');
        var security = button.attr('data-nonce');
        var iscomment = button.attr('data-iscomment');
        var allbuttons;
        if ( iscomment === '1' ) { /* Comments can have same id */
            allbuttons = $('.sl-comment-button-'+post_id);
        } else {
            allbuttons = $('.sl-button-'+post_id);
        }
        var loader = allbuttons.next('#sl-loader');
        if (post_id !== '') {
            $.ajax({
                type: 'POST',
                url: hsk_ajax.ajax_url,
                data : {
                    action : 'hsk_user_post_like',
                    post_id : post_id,
                    nonce : security,
                    is_comment : iscomment,
                },
                beforeSend:function(){
                    loader.html('&nbsp;<div class="loader">Loading...</div>');
                },  
                success: function(response){
                    var icon = response.icon;
                    var count = response.count;
                    allbuttons.html(icon+count);
                    if(response.status === 'unliked') {
                        var like_text = hsk_ajax.like;
                        allbuttons.prop('title', like_text);
                        allbuttons.removeClass('liked');
                    } else {
                        var unlike_text = hsk_ajax.unlike;
                        allbuttons.prop('title', unlike_text);
                        allbuttons.addClass('liked');
                    }
                    loader.empty();                 
                }
            });
            
        }
        return false;
    });
    /**
     * List Style
     */
     jQuery('.list-data-content-wrapper').each(function(){
        var list_color = jQuery(this).find('ul').data('list-color');
        var list_icon_color = jQuery(this).find('ul').data('list-icon-color');
        var list_data_hover_color = jQuery(this).find('ul').data('list-hover-color');
        
        jQuery(this).find('ul li, ul li a').css({'color':list_color });
        jQuery(this).find('ul li a i, ul li i').css({'color': list_icon_color});
        jQuery(this).find('ul li').hover(function(){
            jQuery(this).find('a').css({'color':list_data_hover_color });
            jQuery(this).css({'color':list_data_hover_color });
            jQuery(this).find('a i, i').css({'color': list_data_hover_color});
        }, function(){
            jQuery(this).find('a').css({'color':list_color });
            jQuery(this).css({'color':list_color });
            jQuery(this).find('a i, i').css({'color': list_icon_color});
        });
    });
    // Team Members
    jQuery('.team-member-content-wrapper').each(function(){
          jQuery(this).find('.team-member-image').hover(function(){
              jQuery(this).find('.team-social-follow-icons').stop(true, true).animate({'top':'15px'},500, 'swing');
              var d = 150, factor = d / 3 * 2; // encrement speed by two thirds original speed
              jQuery(this).find("ul li").each(function(){
                 jQuery(this).delay(d = d + factor).stop(true, true).animate({right:'15px'},200);
              }, function(){
                jQuery(this).delay(d = d + factor).stop(true, true).animate({right:'0px'},200);
              });
          }, function(){
            jQuery(this).find('.team-social-follow-icons').stop(true, true).animate({'top':'-100%'},500, 'swing');
             var d = 150, factor = d / 3 * 2; 
              jQuery(this).find("ul li").each(function(){
                 jQuery(this).stop(true, true).delay(d = d + factor).animate({right:'0px'},200);
              });
       });
      });

  /**
   * Counters
   */  
   function isCounterElementVisible($elementToBeChecked) {
        var TopView = jQuery(window).scrollTop();
        var BotView = TopView + jQuery(window).height();
        var TopElement = $elementToBeChecked.offset().top;
        var BotElement = TopElement + $elementToBeChecked.height();
        return ((BotElement <= BotView) && (TopElement >= TopView));
    }

    jQuery(window).scroll(function () {
        jQuery(".hsk-counter").each(function () {
            var isOnView = isCounterElementVisible(jQuery(this));
            if (isOnView && !jQuery(this).hasClass('Starting')) {
                jQuery(this).addClass('Starting');
                jQuery(this).prop('Counter', 0).animate({
                    Counter: jQuery(this).data('counter')
                }, {
                    duration: 5000,
                    easing: 'swing',
                    step: function (now) {
                        jQuery(this).find('span').text(Math.ceil(now));
                    }
                });
            }
        });
    });
    /**
     * Feature boxes
     */
     jQuery('.feature-box-content-wrapper').each(function(){
        jQuery(this).hover(function(){
            jQuery(this).find('.feature-box-hover-details-wrapper').css('display', 'block').animate({'opacity':1, 'right':0}, 250);
        }, function(){
            jQuery(this).find('.feature-box-hover-details-wrapper').animate({'opacity':0, 'right':'100%'}, 250);
        })
    });

})(jQuery);