<?php
/*
Plugin Name:       Components For WP Bakery Page Builder
Description:       The plugin adds some useful components to the WP Bakery Page Builder Plugin that can be integrated very easily with your own theme.
Version:           6.1
Plugin URI:        https://wordpress.org/
Author:            Endreww
Author URI:        https://wordpress.org/
License:           GPLv2 or later
*/



//translation
function nd_options_load_textdomain()
{
  load_plugin_textdomain("nd-shortcodes", false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'nd_options_load_textdomain');



//START add custom css and js
function nd_options_scripts() {
  
  //basic css plugin
  wp_enqueue_style( 'nd_options_style', esc_url( plugins_url( 'css/style.css', __FILE__ ) ) );

  wp_enqueue_script('jquery');
  
}
add_action( 'wp_enqueue_scripts', 'nd_options_scripts' );
//END add custom css and js




//START notices
function nd_options_notices() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e('Components For WP Bakery Page Builder: To take full advantage of all the features of the plugin we recommend the activation of ','nd-shortcodes'); ?><a target="_blank" href="http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=nicdark"><?php _e('WP Bakery Page Builder','nd-shortcodes'); ?></a><?php _e(' plugin.','nd-shortcodes'); ?></p>
    </div>
    <?php
}

//END notices



//START check if visual Composer is present
if( function_exists('vc_map')){

  //include all shortcodes
  foreach ( glob ( plugin_dir_path( __FILE__ ) . "shortcodes/*/index.php" ) as $file ){
    include_once $file;
  }
  

}else{

  add_action( 'admin_notices', 'nd_options_notices' );

}
//END check if visual Composer is present



//include all addons
foreach ( glob ( plugin_dir_path( __FILE__ ) . "addons/*/index.php" ) as $file ){
  include_once $file;
}


//enable svg media uploader
function nd_options_enable_svg_media_upload( $nd_options_mimes = array() ) {
  $nd_options_mimes['svg']  = 'image/svg+xml';
  $nd_options_mimes['svgz'] = 'image/svg+xml';
  return $nd_options_mimes;
}
add_filter( 'upload_mimes', 'nd_options_enable_svg_media_upload' );


//enable shortcode in the widget text
add_filter('widget_text', 'do_shortcode');


//update theme options
function nd_options_theme_setup_update(){
    update_option( 'nicdark_theme_author', 0 );
}
add_action( 'after_switch_theme' , 'nd_options_theme_setup_update');


//function for get plugin version
function nd_options_get_plugin_version(){

    $nd_options_plugin_data = get_plugin_data( __FILE__ );
    $nd_options_plugin_version = $nd_options_plugin_data['Version'];

    return $nd_options_plugin_version;

}


//include settings
if ( get_option('nicdark_theme_author') == 1 ){
  require_once dirname( __FILE__ ) . '/inc/settings/index.php'; 
}

