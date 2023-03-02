<?php
//WooCommerce support
function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    add_theme_support('post-thumbnails');
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
//Head Enqueue
	function bc_head() {
		wp_enqueue_script( 'google-js', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
    }
    
// Load BC styles
    function bcBlank_styles() {
        wp_register_style('bcBlank', get_template_directory_uri() . '/style.css', array(), null, true);
        wp_enqueue_style('bcBlank'); // Enqueue it!
    }

//Footer Enque
	function bc_footer() {
		wp_enqueue_script( 'custom-scripts', get_template_directory_uri() . '/scripts.js');
    }

// custom logo
function config_custom_logo() {
    add_theme_support( 'custom-logo' );
}
    
// Custom login screen for wp-admin
function admin_login_logo() {
    echo '<style type="text/css">
    h1 a {
        background-size: 75% !important;
        height: 260px !important;
        width: 100% !important; }
    body{
        background: #fff !important;
        color: #fff !important;}
    .login form{
        background: #373a46 !important;
        border: 2px solid;}
    .login #login_error, .login .message, .login .success{
        color: #373a46 !important;}
    .login form label{
            color: #fff;}
    .login #login_error, .login .message, .login .success{
            background-color: transparent;}
    </style>';
}

//Add Actions
add_action( 'get_header', 'bc_head' );
add_action( 'get_footer', 'bc_footer' );
add_action('login_head', 'admin_login_logo');
add_action('wp_enqueue_scripts', 'bcBlank_styles'); // Add Theme Stylesheet
add_action( 'after_setup_theme' , 'config_custom_logo' );
/* =========== Add Widgets ==============*/

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    register_sidebar(array(
        'name' => 'Post / Page Sidebar',
        'id'   => 'post_page_sidebar',
        'before_widget' => '<div class="postWidget %2$s">',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '<i class="fas fa-plus"></i><i class="fas fa-minus"></i></h3>',
        'after_widget'  => '</div>'
    ));
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'bcBlank'),
        'description' => __('Description for this widget-area...', 'bcBlank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="sideBarWidget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sBarWidgetTitle">',
        'after_title' => '<i class="fas fa-plus-circle"></i><i class="fas fa-minus-circle"></i></h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'bcBlank'),
        'description' => __('Description for this widget-area...', 'bcBlank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="sideBarWidget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sBarWidgetTitle">',
        'after_title' => '<i class="fas fa-plus-circle"></i><i class="fas fa-minus-circle"></i></h3>'
    ));
}

/* =========== END Add Widgets ==============*/

/* =========== Navigation ==============*/
// register the nav tab
function register_BC_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'bcBlank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'bcBlank'), // Sidebar Navigation
        'logged-in' => __('Logged in', 'bcBlank'), // Logged in menu
        'logged-out' => __('Logged out', 'bcBlank') //logged out menu
    ));
}
  add_action('init', 'register_BC_menu'); // Add BC Blank Menu

  // custom login
function brandcandy_nav_logged_in(){
    wp_nav_menu(
        array(
            'theme_location'  => 'logged-in',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul>%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
        )
    );
}
// custom logout
function brandcandy_nav_logged_out(){
    wp_nav_menu(
        array(
            'theme_location'  => 'logged-out',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul>%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
        )
    );
}

// BC Theme Options
if( function_exists('acf_add_options_page') ) {
    $option_page = acf_add_options_page(array(
        'page_title' 	=> 'Theme Settings',
        'menu_title' 	=> 'Theme Settings',
        'menu_slug' 	=> 'Theme-settings',
        'capability' 	=> 'edit_posts',
        'icon_url' => 	'dashicons-text-page' ,
        'redirect' 	=> false,
        'position' => 2
    ));
}

// **WOOCOMMERCE**
//Hide out of stock variation prices
add_filter( 'woocommerce_variation_is_active', 'grey_out_variations_when_out_of_stock', 10, 2 );

function grey_out_variations_when_out_of_stock( $grey_out, $variation ) {
  
  ?>
  <script type="text/javascript">
  jQuery( document ).bind( 'woocommerce_update_variation_values', function() {

    jQuery( '.variations select option' ).each( function( index, el ) {
      var sold_out = '<?php _e( 'out of stock', 'woocommerce' ); ?>';
      var re = new RegExp( ' - ' + sold_out + '$' );
      el = jQuery( el );

      if ( el.is( ':disabled' ) ) {
        if ( ! el.html().match( re ) ) el.html( el.html() + ' - ' + sold_out );
      } else {
        if ( el.html().match( re ) ) el.html( el.html().replace( re,'' ) );
      }
    } );

  } );
</script>
   <?php

    if ( ! $variation->is_in_stock() )
        return false;

    return true;
}
//Move Email Field To Top @ Checkout Page
  
add_filter( 'woocommerce_billing_fields', 'bbloomer_move_checkout_email_field' );
 
function bbloomer_move_checkout_email_field( $address_fields ) {
    $address_fields['billing_email']['priority'] = 1;
    return $address_fields;
}


//WALPAPER CALCULATOR CODE
//
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 20 );

// END ENQUEUE PARENT ACTION


add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_excerpt', 5);
add_filter( 'woocommerce_product_related_posts_relate_by_category', 'remove_related_cat_product_filter' );

function remove_related_cat_product_filter( $tax_filter ) {
    $tax_filter = false;
    return $tax_filter;
}

add_filter( 'wc_product_enable_dimensions_display', 'remove_dimensions_filter' );

function remove_dimensions_filter( $dim_filter ) {
    $dim_filter = false;
    return $dim_filter;
}
   /*
     * Display input on single product page
     * @return html
     */
    function wallc_custom_option(){

        global $post;

        $terms = wp_get_post_terms( $post->ID, 'product_cat' );
        $display_flag=false;
        foreach ( $terms as $term ) 
        {       
                $wh_meta_checkbox = get_term_meta($term->term_id, 'wh_meta_checkbox', true);
                if($wh_meta_checkbox == 'on'){
                    $display_flag=true;
                    break;
                }

        }

        // when its display
        if($display_flag){

        // Logic of calling calculator
        $wall_width_value = isset( $_POST['wall_width_value'] ) ? sanitize_text_field( $_POST['wall_width_value'] ) : '';
        $wall_height_value = isset( $_POST['wall_height_value'] ) ? sanitize_text_field( $_POST['wall_height_value'] ) : '';
        printf( '<div class="rollcalculator">');
       ?>
		<h3>Estimate number of rolls required</h3>
       <div class="form-group"><label class="control-label" ></label>
        <input  class="form-control control-label" id="wall_width_value" name="wall_width_value"  placeholder="Wall width (m)"/> x <input  class="form-control control-label"  id="wall_height_value" name="wall_height_value" placeholder="Wall height (m)" />
		
        </div>
        <div class="form-group"> <p><button id="estimateRole" class="btn btn-info btn-block" onclick="myFunction()">Calculate...</button></p></div>
		<label class="form-control" id="totalRole" style="font-weight: bold;"></label>
    <?php
        global $product;

        $dimensions = $product->get_dimensions();
        
        if ( ! empty( $dimensions ) ) {
            // all in cm
        $height = $product->get_height();
        $width  =  $product->get_width();
        $length = $product->get_length();

        //  CONVERT TO METER
        // DEVDEV FIX BELOW - CALCULATOR STR + INT ISSUES WHICH WAS NOT ALLOWING DISPLAY. 
        $pattern_height = intval($height) / 100;
        //$pattern_height= $height/100;
        $pattern_width = intval($width) / 100;
        //$pattern_width= $width/100;
        $pattern_repeat = intval($length) / 100;
        //$pattern_repeat= $length/100;


        echo '<input type="hidden" id="pattern_height" value="'.$pattern_height.'" />';
        echo '<input type="hidden" id="pattern_width" value="'.$pattern_width.'"/>';
        echo '<input type="hidden" id="pattern_repeat" value="'.$pattern_repeat.'"/>';

        //correct
       // $WALL_AREA = ceil(($wall_width_value+$pattern_height) * $wall_height_value);    
    ?>
        <script type="text/javascript">
            function myFunction(){

              // wall input
              wall_width_value=Number(jQuery ("#wall_width_value").val());
              wall_height_value=Number(jQuery ("#wall_height_value").val());

              // Product dimensions

              pattern_height=Number(jQuery ("#pattern_height").val());
              pattern_width=Number(jQuery ("#pattern_width").val());
              pattern_repeat=Number(jQuery ("#pattern_repeat").val());
              WALL_AREA = Math.ceil((wall_width_value+pattern_height) * wall_height_value);  

              wall_width_value_meter=wall_width_value/100;
             pattern_width_meter=pattern_width;

              PATTERN_AREA = (pattern_width * pattern_repeat) ;

              totalRole=Math.ceil(WALL_AREA/PATTERN_AREA);

              jQuery ("#totalRole").text('You will need approximately '+totalRole+' rolls.');
            }
        </script>

        <?php 


        }
    }


    }
//add_action( 'woocommerce_single_product_summary', 'wallc_custom_option', 9 );
add_action( 'woocommerce_product_meta_start', 'wallc_custom_option', 9 );
//    add_action( 'woocommerce_after_single_product', 'wallc_custom_option', 9 );


/***Add checkbox to category***/

add_action('product_cat_add_form_fields', 'wallc_taxonomy_add_new_meta_field', 10, 1);
add_action('product_cat_edit_form_fields', 'wallc_taxonomy_edit_meta_field', 10, 1);
//Product Cat Create page
function wallc_taxonomy_add_new_meta_field() {
    ?>   
    <div class="form-field">
        <label for="wh_meta_checkbox"><?php _e('Is roll calculator enable?', 'wh'); ?></label>
        <input type="checkbox" name="wh_meta_checkbox" id="wh_meta_checkbox" >        
    </div>    
    <?php
}
//Product Cat Edit page
function wallc_taxonomy_edit_meta_field($term) {
    //getting term ID
    $term_id = $term->term_id;
    
    // retrieve the existing value(s) for this meta field.
    $wh_meta_checkbox = get_term_meta($term_id, 'wh_meta_checkbox', true);
    if($wh_meta_checkbox == 'on'){
        $wh_meta_checkbox='checked';
    }
    else{
        $wh_meta_checkbox=' ';
    }
    
    ?>

    <tr class="form-field">
        <th scope="row" valign="top"><label for="wh_meta_checkbox"><?php _e('Is roll calculator enable?', 'wh'); ?></label></th>
        <td>
            <input type="checkbox" name="wh_meta_checkbox" id="wh_meta_checkbox" <?php echo $wh_meta_checkbox; ?>>
        </td>
    </tr>
    
    <?php
}

add_action('edited_product_cat', 'wallc_save_taxonomy_custom_meta', 10, 1);
add_action('create_product_cat', 'wallc_save_taxonomy_custom_meta', 10, 1);
// Save extra taxonomy fields callback function.
function wallc_save_taxonomy_custom_meta($term_id) {
    
    $wh_meta_checkbox = filter_input(INPUT_POST, 'wh_meta_checkbox');
    update_term_meta($term_id, 'wh_meta_checkbox', $wh_meta_checkbox);    
}   return;


//Displaying Additional Columns
add_filter( 'manage_edit-product_cat_columns', 'wallccustomFieldsListTitle' ); //Register Function
add_action( 'manage_product_cat_custom_column', 'wallc_customFieldsListDisplay' , 10, 3); //Populating the Columns
/**
 * Meta Title and Description column added to category admin screen.
 *
 * @param mixed $columns
 * @return array
 */
function wallc_customFieldsListTitle( $columns ) {
    $columns['pro_meta_title'] = __( 'Roll Calculator', 'woocommerce' );    
    return $columns;
}
/**
 * Meta Title and Description column value added to product category admin screen.
 *
 * @param string $columns
 * @param string $column
 * @param int $id term ID
 *
 * @return string
 */
function wallc_customFieldsListDisplay( $columns, $column, $id ) {
    if ( 'pro_meta_title' == $column ) {
        $columns = esc_html( get_term_meta($id, 'wh_meta_checkbox', true) );    
    }
   
    return $columns;
}

/* =========== Wishlist --> Moodboard plugin text changes ==============*/

if ( ! function_exists( 'yith_wcwl_change_in_your_wishlist_label' ) ) {
 function yith_wcwl_change_in_your_wishlist_label() {
  return 'in your moodboard';
 }
 add_filter( 'yith_wcwl_in_your_wishlist_label', 'yith_wcwl_change_in_your_wishlist_label' );
}

if ( ! function_exists( 'yith_wcwl_change_move_to_another_wishlist_title' ) ) {
 function yith_wcwl_change_move_to_another_wishlist_title() {
  return 'Move to another moodboard';
 }
 add_filter( 'yith_wcwl_move_to_another_wishlist_title', 'yith_wcwl_change_move_to_another_wishlist_title', 20 );
 add_filter( 'yith_wcwl_add_to_wishlist_popup_title', 'yith_wcwl_change_move_to_another_wishlist_title', 20 );
}

if ( ! function_exists( 'yith_wcwl_change_new_list_title_text' ) ) {
 function yith_wcwl_change_new_list_title_text() {
  return 'moodboard name';
 }
 add_filter( 'yith_wcwl_new_list_title_text', 'yith_wcwl_change_new_list_title_text' );
}

if ( ! function_exists( 'yith_wcwl_change_yith_wcwl_back_to_all_wishlists_link_text' ) ) {
 function yith_wcwl_change_yith_wcwl_back_to_all_wishlists_link_text() {
  return '< Back to all moodboards';
 }
 add_filter( 'yith_wcwl_back_to_all_wishlists_link_text', 'yith_wcwl_change_yith_wcwl_back_to_all_wishlists_link_text' );
}

if ( ! function_exists( 'yith_wcwl_change_back_to_wishlists_label' ) ) {
    function yith_wcwl_change_back_to_wishlists_label( $label ) {
        $label = __( '&lsaquo; Back to all moodboards', 'yith-woocommerce-wishlist' );

        return $label;
    }

    add_filter( 'yith_wcwl_back_to_all_wishlists_link_text', 'yith_wcwl_change_back_to_wishlists_label' );
}

if ( ! function_exists( 'yith_wcwl_change_wishlist_table_heading' ) ) {
    function yith_wcwl_change_wishlist_table_heading( $label ) {
        $label = __( 'Moodboards', 'yith-woocommerce-wishlist' );

        return $label;
    }

    add_filter( 'yith_wcwl_wishlist_manage_name_heading', 'yith_wcwl_change_wishlist_table_heading' );
}