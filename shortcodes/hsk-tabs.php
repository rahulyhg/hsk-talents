<?php
$tabs_title_counter                 = 0;
$tabs_accordion_counter             = 0;
$tabs_accordion_content_counter     = 0;
$tabs_haccordion_counter            = 0;
$tabs_haccordion_content_counter    = 0;
$tabs_tab_counter                   = -1;
$tabs_tab_content_counter           = 0;
$tabs_current_tab_group             = 0;
$tabs_tabs                          = array();
$tabs_toggle_counter                = 0;
$tabs_toggle_content_counter        = 0;
/**
 * Accordion
 */ 
function talenthub_hsk_tabs_accordions_shortcode( $atts, $content ) {
    global $tabs_title_counter, $tabs_accordion_counter;
    $defaults = array(
        'title' => '',
        'tabs_bg_color' => '#e5e5e5',
        'tabs_color'    =>'#353535',
        'tabs_active_bg_color' => '#f5f5f5',
        'tabs_active_color'  => '#151515',
        'content_bg_color' => '#fff',
        'content_color' => '#757575',
    );
    $atts = wp_parse_args( $atts, $defaults );
    $content = do_shortcode( talenthub_hsk_shortcode_unautop( shortcode_unautop( talenthub_hsk_up_shortcodes( $content ) ) ) );
    $html  = '';
    if (!empty($atts['title'])) {
        $id     = "hsk-tabs-title-$tabs_title_counter";
        $class  = "hsk-tabs-group-title";

        $html .= '<h2 id="'.$id.'" class="'.$class.'">'.$atts['title'].'</h2>';

        $GLOBALS['tabs_title_counter']++;
    }
    echo '<style>#hsk-tabs-accordion-'.$tabs_accordion_counter.' .ui-accordion-header{background-color:'.$atts['tabs_bg_color']. '; } #hsk-tabs-accordion-'.$tabs_accordion_counter.' .ui-accordion-header a{ color:'.$atts['tabs_color'].';}

        #hsk-tabs-accordion-'.$tabs_accordion_counter.' .ui-accordion-header.ui-state-active{background-color:'.$atts['tabs_active_bg_color'].'; } #hsk-tabs-accordion-'.$tabs_accordion_counter.' .ui-accordion-header.ui-state-active a{ color:'.$atts['tabs_active_color'].';}

        #hsk-tabs-accordion-'.$tabs_accordion_counter.' .ui-widget-content{background-color:'.$atts['content_bg_color'].'; color:'.$atts['content_color'].';}

    </style>';
    $data  = '';
    
    $id     = "hsk-tabs-accordion-$tabs_accordion_counter";
    $class  = 'hsk-tabs-accordion hsk-tabs-override';

    $html .= '<div id="'.$id.'" class="'.$class.'" '.$data.'>';
    $html .= $content;
    $html .= '</div>';
    $html .= "\n";

    $tabs_accordion_counter ++;

    return $html;
}
add_shortcode( 'accordions', 'talenthub_hsk_tabs_accordions_shortcode' );

/**
 * Accordion shortcode
 *
 * Attributes:
 *   title      The title shown in the heading of this pane
 */
function talenthub_hsk_tabs_accordion_shortcode( $atts, $content ) {
    global $tabs_accordion_content_counter;

    $defaults = array(
        'title' => ' &nbsp; &nbsp; &nbsp; '
    );
    $atts = wp_parse_args( $atts, $defaults );

    $content = do_shortcode( talenthub_hsk_shortcode_unautop( shortcode_unautop( $content ) ) );

    $html  = '';

    $id = "hsk-tabs-header-$tabs_accordion_content_counter";

    $html .= '<h3 id="'.$id.'">';
    $html .= '<a href="#hsk-tabs-accordion-shortcode-content-'.$tabs_accordion_content_counter.'">';
    $html .= $atts['title'];
    $html .= '</a>';
    $html .= '</h3>';

    $id = "hsk-tabs-accordion-shortcode-content-$tabs_accordion_content_counter";

    $html .= '<div id="'.$id.'" class="hsk-tabs-accordion-shortcode-content hsk-tabs-accordion-shortcode-content-'.$tabs_accordion_content_counter.'">';
    $html .= $content;
    $html .= '</div>';

    $tabs_accordion_content_counter++;

    return $html;
}
add_shortcode( 'accordion', 'talenthub_hsk_tabs_accordion_shortcode' );
function talenthub_hsk_tabs_haccordions_shortcode( $atts, $content ) {
    global $tabs_title_counter, $tabs_haccordion_counter, $tabs_haccordion_content_counter;


    $defaults = array(
        'title'         => '',
    );
    // jQuery-UI theme needs to default to a narrower header width
    if (empty($atts['theme']) || $atts['theme'] == 'jqueryui') {
        $defaults['hwidth'] = 28;
    }

    $atts = wp_parse_args( $atts, $defaults );
    $atts['active'] = $atts['active'] + 1;

    $content = do_shortcode( talenthub_hsk_shortcode_unautop( shortcode_unautop( talenthub_hsk_up_shortcodes( $content ) ) ) );
    $html  = '';

    if (!empty($atts['title'])) {
        $id     = "hsk-tabs-title-$tabs_title_counter";
        $class  = "hsk-tabs-group-title";

        $html .= '<h2 id="'.$id.'" class="'.$class.'">'.$atts['title'].'</h2>';

        $GLOBALS['tabs_title_counter']++;
    }

    $data  = '';

    $id     = "hsk-tabs-haccordion-$tabs_haccordion_counter";
    $class  = 'hsk-tabs-haccordion hsk-tabs-override';

    $html .= '<div id="'.$id.'" class="'.$class.'" '.$data.'>';
    $html .= '<ol>';
    $html .= $content;
    $html .= '</ol>';
    $html .= '</div>';
    $html .= "\n";

    $tabs_haccordion_counter ++;

    return $html;
}
add_shortcode( 'haccordions', 'talenthub_hsk_tabs_haccordions_shortcode' );
function talenthub_hsk_tabs_haccordion_shortcode( $atts, $content ) {
    global $tabs_haccordion_content_counter;

    $defaults = array(
        'title' => ' &nbsp; &nbsp; &nbsp; '
    );
    $atts = wp_parse_args( $atts, $defaults );

    $content = do_shortcode( talenthub_hsk_shortcode_unautop( shortcode_unautop( $content ) ) );
    $html  = '';

    $id = "hsk-tabs-haccordion-$tabs_haccordion_content_counter";

    $html .= '<li>';
    $html .= '<h3 id="'.$id.'" class="hsk-tabs-haccordion-shortcode">';
    $html .= '<span>';
    $html .= $atts['title'];
    $html .= '</span>';
    $html .= '</h3>';

    $html .= '<div>';
    $html .= '<div class="hsk-tabs-haccordion-content">';
    $html .= $content;
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</li>';

    $tabs_haccordion_content_counter++;

    return $html;
}
add_shortcode( 'haccordion', 'talenthub_hsk_tabs_haccordion_shortcode' );

/**
 * Tabs
 */
function talenthub_hsk_tabs_tabs_shortcode( $atts, $content ) {
    global $tabs_title_counter, $tabs_tabs, $tabs_tab_counter, $tabs_current_tab_group;
    $tabs_tab_counter ++;
    // Save current tab group and restore it at the end of the function
    $_ctg = $tabs_current_tab_group;
    $tabs_current_tab_group = $tabs_tab_counter;

    $defaults = array(
        'title'         => '',
        'bgcolor'       => '#e5e5e5',
        'tab_bgcolor'   => '#f6f6f6',
        'tab_content_bg' => '#fff',
        'tab_content_color' => '#333',
        'tab_color'     => '#353535',
        'disabled'      => false,
        'collapsible'   => false,
        'active'        => 0,
        'event'         => 'click'
    );

    $atts = wp_parse_args( $atts, $defaults );

    //if( !empty($atts['tab_bgcolor']) ){
        echo '<style>#hsk-tabs-tab-group-'.$tabs_tab_counter.' ul li{  background-color:'.$atts['tab_bgcolor'].'; } #hsk-tabs-tab-group-'.$tabs_tab_counter.' ul li a{color:'.$atts['tab_color'].' }
            #hsk-tabs-tab-group-'.$tabs_tab_counter.' .ui-tabs-panel, #hsk-tabs-tab-group-'.$tabs_tab_counter.' ul li.ui-tabs-active.ui-state-active,  #hsk-tabs-tab-group-'.$tabs_tab_counter.' ul li.ui-tabs-active.ui-state-active a{  background-color:'.$atts['tab_content_bg'].'; color:'.$atts['tab_content_color'].'; }</style>';
    //}

    $content = do_shortcode( talenthub_hsk_shortcode_unautop( shortcode_unautop( talenthub_hsk_up_shortcodes( $content ) ) ) );
    $html  = '';

    if (!empty($atts['title'])) {
        $id     = "hsk-tabs-title-$tabs_title_counter";
        $class  = "hsk-tabs-group-title";

        $html .= '<h2 id="'.$id.'" class="'.$class.'" >'.$atts['title'].'</h2>';

        $GLOBALS['tabs_title_counter']++;
    }

    $data  = '';

    $data .= 'data-title="'         .$atts['title']         .'" ';
    $data .= 'data-disabled="'     .($atts['disabled']    == "true" ? 'true' : 'false' ).'" ';
    $data .= 'data-collapsible="'  .($atts['collapsible'] == "true" ? 'true' : 'false' ).'" ';
    $data .= 'data-active="'        .$atts['active']        .'" ';
    $data .= 'data-event="'         .$atts['event']         .'"';

    $id     = "hsk-tabs-tab-group-$tabs_tab_counter";
    $class  = 'hsk-tabs-tab-group hsk-tabs-override';
    $tab_bar_bg = !empty($atts['bgcolor']) ? 'style="background-color:'.$atts['bgcolor'].';"' : '';
    $html .= '<div id="'.$id.'" class="'.$class.'" '.$data.'>';
    $html .= '<ul '.$tab_bar_bg.'>';

    // We drop the content and build the tabs from the stored contents of $tabs_tabs

    foreach ($tabs_tabs[$tabs_current_tab_group] as $tab) {
        $html .= $tab['tab'];
    }
    $html .= '</ul>';
    foreach ($tabs_tabs[$tabs_current_tab_group] as $tab) {
        $html .= $tab['content'];
    }

    $html .= '</div>';
    $html .= "\n";

    // Restore current tab group
    $tabs_current_tab_group = $_ctg;

    return $html;
}
add_shortcode( 'tabs', 'talenthub_hsk_tabs_tabs_shortcode' );

function talenthub_hsk_taba_shortcode( $atts, $content, $tag ) {
    global $tabs_current_tab_group, $tabs_tabs, $tabs_tab_content_counter;

    $atts = shortcode_atts( array(
        'title'     => ' &nbsp; &nbsp; &nbsp; ',
        'icon'      => '',
        'iconw'     => '',
        'iconh'     => '',
        'iconalt'   => '',
        'class'     => '',
    ), $atts, $tag );

    $tab_class = trim( 'squelch-taas-tab '.$atts['class'] );
    $content_class = trim( $atts['class'] );

    $content = do_shortcode( talenthub_hsk_shortcode_unautop( shortcode_unautop( $content ) ) );

    $id = "hsk-tabs-header-$tabs_tab_content_counter";

    $tab_arr = array();

    // Build the tab
    $html  = '';
    $html .= '<li class="'.$tab_class.'">';
    $html .= '<a href="#hsk-tabs-tab-content-'.$tabs_current_tab_group.'-'.$tabs_tab_content_counter.'">';

    if (!empty($atts['icon'])) {
        if (empty($atts['iconalt'])) $atts['iconalt'] = $atts['title'];

        $html .= '<img src="'.$atts['icon'].'" alt="'.$atts['iconalt'].'" class="squelch-taas-tab-icon" ';

        if (!empty($atts['iconw'])) $html .= 'width="'.$atts['iconw'].'" ';
        if (!empty($atts['iconh'])) $html .= 'height="'.$atts['iconh'].'" ';

        $html .= '/> &nbsp;';
    }

    $html .= $atts['title'];
    $html .= '</a>';
    $html .= '</li>';
    $tab_arr['tab'] = $html;

    // Build the tab content
    $html  = '';
    $html .= '<div id="hsk-tabs-tab-content-'.$tabs_current_tab_group.'-'.$tabs_tab_content_counter.'" class="'.$content_class.'">';
    $html .= $content;
    $html .= '</div>';
    $tab_arr['content'] = $html;

    // Push onto the tab stack
    $tabs_array = array();
    if (!empty($tabs_tabs[$tabs_current_tab_group])) $tabs_array = $tabs_tabs[$tabs_current_tab_group];
    array_push( $tabs_array, $tab_arr );
    $tabs_tabs[$tabs_current_tab_group] = $tabs_array;

    $tabs_tab_content_counter++;

    // The shortcode REMOVES the content and stores it for the tabs shortcode to use
    return '';
}
add_shortcode( 'tab', 'talenthub_hsk_taba_shortcode' );
/*
 * Toggle
 */

function talenthub_hsk_tabs_toggles_shortcode( $atts, $content ) {
    global $tabs_title_counter, $tabs_toggle_counter;

    $defaults = array(
        'title' => '',
        'tabs_bg_color' => '#000',
        'tabs_color'    =>'#353535',
        'tabs_active_bg_color' => '#f5f5f5',              
        'tabs_active_color'  => '#151515',
        'content_bg_color' => '#fff',
        'content_color' => '#757575',
    );
                                                                                                                                                                                                                                                                                                                  
    $atts = wp_parse_args( $atts, $defaults );
    echo '<style>';
    echo '#hsk-tabs-toggle-'.$tabs_toggle_counter.' .ui-accordion-header{background-color:'.$atts['tabs_bg_color']. '; } #hsk-tabs-toggle-'.$tabs_toggle_counter.' .ui-accordion-header a{ color:'.$atts['tabs_color'].';}

        #hsk-tabs-toggle-'.$tabs_toggle_counter.' .ui-accordion-header.ui-state-active{background-color:'.$atts['tabs_active_bg_color'].'; } #hsk-tabs-toggle-'.$tabs_toggle_counter.' .ui-accordion-header.ui-state-active a{ color:'.$atts['tabs_active_color'].';}

        #hsk-tabs-toggle-'.$tabs_toggle_counter.' .ui-widget-content{background-color:'.$atts['content_bg_color'].'; color:'.$atts['content_color'].';}

    </style>';

    // If shortcode has style set instead of theme then use that value for style
    if (array_key_exists( 'style', $atts )) $atts['theme'] = $atts['style'];

    $content = do_shortcode( talenthub_hsk_shortcode_unautop( shortcode_unautop( talenthub_hsk_up_shortcodes( $content ) ) ) );
    $html  = '';

    if (!empty($atts['title'])) {
        $id     = "hsk-tabs-title-$tabs_title_counter";
        $class  = "hsk_group-title_shortcodes";

        $html .= '<h2 id="'.$id.'" class="'.$class.' title_style">'.$atts['title'].'</h2>';

        $GLOBALS['tabs_title_counter']++;
    }

    $data  = '';

    $id     = "hsk-tabs-toggle-$tabs_toggle_counter";
    $class  = 'hsk-tabs-toggle hsk-tabs-override';

    $html .= '<div id="'.$id.'" class="'.$class.'" '.$data.'>';
    $html .= $content;
    $html .= '</div>';
    $html .= "\n";

    $tabs_toggle_counter ++;

    return $html;
    
}
add_shortcode( 'toggles', 'talenthub_hsk_tabs_toggles_shortcode' );

function talenthub_hsk_tabs_toggle_shortcode( $atts, $content ) {
    global $tabs_toggle_content_counter;

    $defaults = array(
        'title' => ' &nbsp; &nbsp; &nbsp; ',
        'tabs_bg_color' => '#e5e5e5',
        'tabs_color'    =>'#353535',
        'tabs_active_bg_color' => '#f5f5f5',
        'tabs_active_color'  => '#151515',
        'content_bg_color' => '#fff',
        'content_color' => '#757575',
    );
    $atts = wp_parse_args( $atts, $defaults );
    $content = do_shortcode( talenthub_hsk_shortcode_unautop( shortcode_unautop( $content ) ) );
    $html  = '';

    $id = "hsk-tabs-header-$tabs_toggle_content_counter";

    $html .= '<h3 id="'.$id.'" class="hsk-tabs-toggle-shortcode-header">';
    $html .= '<a href="#hsk-tabs-toggle-shortcode-content-'.$tabs_toggle_content_counter.'">';
    $html .= $atts['title'];
    $html .= '</a>';
    $html .= '</h3>';

    $id = "hsk-tabs-toggle-shortcode-content-$tabs_toggle_content_counter";

    $html .= '<div id="'.$id.'" class="hsk-tabs-toggle-shortcode-content hsk-tabs-toggle-shortcode-content-'.$tabs_toggle_content_counter.'">';
    $html .= $content;
    $html .= '</div>';

    $tabs_toggle_content_counter++;

    return $html;
}
add_shortcode( 'toggle', 'talenthub_hsk_tabs_toggle_shortcode' );

if (!function_exists( 'talenthub_hsk_up_shortcodes' )) :
    function talenthub_hsk_up_shortcodes( $content ) {
        $html = trim( $content );
        $html = preg_replace( '/\]<br \/>/i',     ']', $html );
        $html = preg_replace( '/<br \/>\n\[/i',   '[', $html );
        return $html;
    }
endif;

function talenthub_hsk_shortcode_unautop( $content ) {
    $html = trim( $content );
    $html = preg_replace( '/^<\/p>/i',    '', $html );
    $html = preg_replace( '/<p>$/i',      '', $html );
    return $html;
}
?>