<?php

/*
Plugin Name: Page Builder Addons for WPBakery
Plugin URI: http://www.pagebuilderaddons.com
Description: Page Builder Addons for WPBakery (formally visual composer) are a pack of premium quality addons
Version: 1.2.1
Author: Genetech Solutions
Author URI: https://www.genetechsolutions.com/
Text Domain: genetech
*/


define( 'PLUGIN_DIR', 'vc-addons-by-bit14/' );
define('assets_url', plugin_dir_url(__FILE__) . 'assets/');
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if (is_plugin_active('page-builder-addons-premium/bit14-addons.php') ) {
        deactivate_plugins('page-builder-addons-premium/bit14-addons.php');
    }
//Call Before VC Init
add_action('vc_before_init','bit14_before_vc_init');


is_admin() && add_filter( 'gettext', 
    function( $translated_text, $untranslated_text, $domain )
    {
        $old = array(
            "Plugin <strong>activated</strong>.",
            "Selected plugins <strong>activated</strong>." 
        );

        $new = "<strong>Thanks for installing PB Addons!</strong>
<p>We hope you like the plugin. Check plugin Pro Elements from <a href='https://pagebuilderaddons.com/plan-and-pricing/?utm_source=plugin-admindashboard&utm_medium=pluginadmin&utm_campaign=go_pro&utm_content=pbaddonsdoc'>here</a>.</p>
<p>PB Addons offers perpetual licensing - purchase once and use for a lifetime, no hassle or recurring periodic payments. <a href='https://pagebuilderaddons.com/plan-and-pricing/?utm_source=plugin-admindashboard&utm_medium=pluginadmin&utm_campaign=go_pro&utm_content=pbaddonsdoc' target='_blank'>View Pricing</a></p>";

        if ( in_array( $untranslated_text, $old, true ) )
            $translated_text = $new;

        return $translated_text;
     }
, 99, 3 );

function bit14_before_vc_init(){

	$classes = array (
		'bit-counter-lists',
        'bit-iconic-list',
        'bit-headings',
        'bit-progress-bar',
		'bit-newsletter-subscriber',
		'bit-testimonial-lists',
        'bit-info-banner',
        'bit-pricing-table',
    );

	$folder = plugin_dir_path( __FILE__ ) . "classes/";

	foreach ( $classes as $class ) {

		$file = 'class-'.$class.'.php';
		include_once $folder.$file;
	}

}

// Admin Side Menu 
add_action( 'admin_menu', 'admin_menu');
function admin_menu() {
    add_menu_page(
        'Page Builder Addons',
        'Page Builder Addons',
        'manage_options',
        'page_builder_addons_main_menu',
        'addons_list_page' ,
        plugins_url(PLUGIN_DIR.'assets/images/pb_icon.png'),
        60
    );
    
    add_submenu_page(
        'page_builder_addons_main_menu',
        'Addons ',
        'Addons (Pro)',
        'manage_options',
        'page_builder_addons_main_menu',
        'addons_list_page'
    );
    add_submenu_page(
        'page_builder_addons_main_menu',
        'Custom Post Type',
        'Custom Post Type (Pro)',
        'manage_options',
        'page_builder_addons_sub_menu',
        'addons_list_page_cpt'
    );

}

//enqueue styles and scripts
add_action('wp_enqueue_scripts','bit14_vc_enqueue_scripts');

function bit14_vc_enqueue_scripts(){

	$assets_url = plugin_dir_url(__FILE__) . 'assets/';

	if ( !wp_script_is('slick.js','enqueued') && !wp_script_is('slick.min.js','enqueued') ){
		wp_enqueue_style( 'slick-free', $assets_url.'css/slick.css', false );
		wp_enqueue_script( 'slick-free', $assets_url.'js/slick.min.js', array('jquery'), false );
	}

    wp_enqueue_script( 'jquery-ui-min', $assets_url.'js/jquery-ui.min.js', array('jquery'), false );

	wp_enqueue_style( 'bit14-vc-addons-free', $assets_url.'css/style.css', false );
	wp_enqueue_script( 'bit14-vc-addons-free', $assets_url.'js/script.js', array('jquery'), false );

    wp_enqueue_script( 'fontawesome-free', 'https://use.fontawesome.com/b844aaf4ff.js');

	wp_enqueue_style( 'bootstrap-free', $assets_url.'css/bootstrap.min.css' );

	wp_enqueue_style( 'bit14-icomoon-icons-free', $assets_url.'font/style.css' );

}

//enqueue styles and scripts admin
add_action('admin_enqueue_scripts','bit14_vc_admin_enqueue_scripts');
function bit14_vc_admin_enqueue_scripts(){

	$assets_url = plugin_dir_url(__FILE__) . 'assets/';

	wp_enqueue_script( 'bit14-vc-addons-free', $assets_url.'js/admin.js', array('jquery'), false );
	
	wp_enqueue_style( 'bit14-vc-addons-free', $assets_url.'css/admin.css');

	wp_localize_script('bit14-vc-addons-free','assets_url',$assets_url);
}

// Addons List Page Admin Side Menu
function addons_list_page(){
    ?>
    <div id="container"  class="bit14-admin-addons">
        <div class="heading">
            <img src="<?php echo plugins_url(PLUGIN_DIR.'assets/images/pb-logo.png'); ?>" />
            <h1 class="title">PAGE BUILDER ADDONS - <span>PREMIUM</span></h1>
        </div>
        <div class="button-container">
            <a href="https://pagebuilderaddons.com/plan-and-pricing/?utm_source=plugin-admindashboard&utm_medium=pluginadmin&utm_campaign=go_pro&utm_content=pbaddonsdoc" target="_blank" title="Page Builder Addons">Upgrade to Premium</a>
        </div>
             <div class="moneyback-banner">
                <div class="moneyback-container">
                    <div class="moneyback-content">
                        <h3>Upgrade to PRO for $19.99</h3>
                        <p>Run your next WordPress website with WPBakery Page Builder Addons</p>
                        <a href="https://pagebuilderaddons.com/plan-and-pricing/?utm_source=plugin-admindashboard&utm_medium=pluginadmin&utm_campaign=go_pro&utm_content=pbaddonsdoc">Go Pro</a>
                    </div><!-- moneyback-content -->
                    <div class="moneyback-img">
                        <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/images/badge-screen.png'); ?>">
                    </div><!-- moneyback-img -->
                </div><!-- moneyback-container -->
            </div><!-- moneyback-banner -->

            <div class="addons-list only-builder">
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/Accordions.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Accordians</h3>
                            <p>Great way to communicate text-heavy information in an elegant way</p>
                            <a href="https://pagebuilderaddons.com/accordions-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/button.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Buttons</h3>
                            <p>Provides unique and useful buttons designs</p>
                            <a href="https://pagebuilderaddons.com/buttons-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                 <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/count-down.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Countdown</h3>
                            <p>Easy to create countdown timers for Coming soon, Website Maintenance, Limited time offer, Event Announcement and Product launch</p>
                            <a href="https://pagebuilderaddons.com/countdown-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/clients.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Clients</h3>
                            <p>Displays your client’s logo on a page with their social profile links</p>
                            <a href="https://pagebuilderaddons.com/clients-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/com-table.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Compact Pricing Table</h3>
                            <p>Enable you to create a great pricing table with the least amount of effort</p>
                            <a href="https://pagebuilderaddons.com/compact-pricing-table-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/faq.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>FAQ</h3>
                            <p>Lets you create FAQs and publicize your FAQ in no time</p>
                            <a href="https://pagebuilderaddons.com/faq-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                 <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/info-banner.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Info Banner</h3>
                            <p>Create creative and unique Advertisement banner within minutes having an option to add title, description, button and link option</p>
                            <a href="https://pagebuilderaddons.com/info-banner-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                 <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/info-list.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Info List</h3>
                            <p>List company information, Important steps by using info list element</p>
                            <a href="https://pagebuilderaddons.com/info-list-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/iconic-box.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Iconic List</h3>
                            <p>Unleash your creativity with Iconic List</p>
                            <a href="https://pagebuilderaddons.com/iconic-list-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/static-counter.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Opening Hours</h3>
                            <p>Show your business hours, office opening hours table via opening hours element</p>
                            <a href="https://pagebuilderaddons.com/opening-time-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/carousel.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Image Carousel</h3>
                            <p>Easily create beautiful & fancy image carousel just in minutes</p>
                            <a href="https://pagebuilderaddons.com/image-carousel-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/parallax.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Parallax Background</h3>
                            <p>Build attractive landing pages with parallax animations</p>
                            <a href="https://pagebuilderaddons.com/parallax-background-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/post-caroousel.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Post Carousel</h3>
                            <p>Showcase your post content in a nice looking slider</p>
                            <a href="https://pagebuilderaddons.com/post-carousel-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/post-grid.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Post Grid</h3>
                            <p>Beautiful grid and list of posts will make your WordPress site stand out</p>
                            <a href="https://pagebuilderaddons.com/post-grid-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/pic-table.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Pricing Table</h3>
                            <p>Create high converting pricing comparison tables</p>
                            <a href="https://pagebuilderaddons.com/pricing-table-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/services-02.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Services</h3>
                            <p>Show your website services in a creative way</p>
                            <a href="https://pagebuilderaddons.com/services-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/counter.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Statistic Counters</h3>
                            <p>Useful to add numbers like: hours worked, review, download count</p>
                            <a href="https://pagebuilderaddons.com/statistic-counter/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/timeline.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Timeline</h3>
                            <p>Display your company timeline, Historical event, sales steps, and lots other with using elegant simple responsive Timeline element</p>
                            <a href="https://pagebuilderaddons.com/timeline-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/tab-single-02.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Tabs</h3>
                            <p>Easy and lightweight way to show content in tabs format</p>
                            <a href="https://pagebuilderaddons.com/tabs-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/team-members.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Team Members</h3>
                            <p>Display your team members details with their social profile links</p>
                            <a href="https://pagebuilderaddons.com/members-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/testimonials.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Testimonials</h3>
                            <p>Display Unlimited testimonials, reviews or quotes in multiple ways</p>
                            <a href="https://pagebuilderaddons.com/testimonials-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
                <div class="addon-container same-height">
                    <div class="addon-container-bg">
                        <div class="addon-img">
                            <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/addons-img/services-02.png'); ?>"/>
                        </div>
                        <div class="addon-content">
                            <h3>Video Gallery</h3>
                            <p>Easily upload and show videos of different formats (mp4, webM, ogv)</p>
                            <a href="https://pagebuilderaddons.com/video-gallery-demo/" target="_blank" title="View Demo">View Demo</a>
                        </div>
                    </div>
                </div>
            </div>
        <div class="button-container">
            <a href="https://pagebuilderaddons.com/plan-and-pricing/?utm_source=plugin-admindashboard&utm_medium=pluginadmin&utm_campaign=go_pro&utm_content=pbaddonsdoc" target="_blank" title="Page Builder Addons">Upgrade to Premium</a>
        </div>
    </div>
    <?php
}

// Addons List Page Custom Post Type for Admin Side Menu
function addons_list_page_cpt(){
    ?>
    <div id="container"  class="bit14-admin-addons">
        <div class="heading">
            <img src="<?php echo plugins_url(PLUGIN_DIR.'assets/images/pb-logo.png'); ?>" />
            <h1 class="title">PAGE BUILDER ADDONS - <span>PREMIUM</span></h1>
        </div>
        <div class="button-container">
            <a href="https://pagebuilderaddons.com/plan-and-pricing/?utm_source=plugin-admindashboard&utm_medium=pluginadmin&utm_campaign=go_pro&utm_content=pbaddonsdoc" target="_blank" title="Page Builder Addons">Upgrade to Premium</a>
        </div>
        <div class="moneyback-banner cpt">
            <div class="moneyback-container">
                <div class="moneyback-content">
                    <h3>Upgrade to PRO for $19.99</h3>
                    <p>Run your next WordPress website with WPBakery Page Builder Addons</p>
                    <a href="https://pagebuilderaddons.com/plan-and-pricing/?utm_source=plugin-admindashboard&utm_medium=pluginadmin&utm_campaign=go_pro&utm_content=pbaddonsdoc">Go Pro</a>
                </div><!-- moneyback-content -->
                <div class="moneyback-img">
                    <img src="<?php echo plugins_url('vc-addons-by-bit14/assets/images/badge-screen.png'); ?>">
                </div><!-- moneyback-img -->
            </div><!-- moneyback-container -->
        </div><!-- moneyback-banner -->
        <div class="addons-list cpt-list">
            <h1 class="sub-title">Custom Post Type</h1>
            <div class="addon-container">
                <div class="addon-container-bg">
                    <div class="addon-img">
                        <img src="<?php echo plugins_url(PLUGIN_DIR.'assets/addons-img/clients-cpt.jpg'); ?>"/>
                    </div>
                    <div class="addon-content">
                        <h3>Clients</h3>
                        <p>Displays your client’s logo on a page with their social profile links</p>
                    </div>
                </div>
            </div>
            <div class="addon-container">
                <div class="addon-container-bg">
                    <div class="addon-img">
                        <img src="<?php echo plugins_url(PLUGIN_DIR.'assets/addons-img/faq-cpt.jpg'); ?>"/>
                    </div>
                    <div class="addon-content">
                        <h3>FAQ</h3>
                        <p>Lets you create FAQs and publicize your FAQ in no time</p>
                    </div>
                </div>
            </div>
            <div class="addon-container">
                <div class="addon-container-bg">
                    <div class="addon-img">
                        <img src="<?php echo plugins_url(PLUGIN_DIR.'assets/addons-img/members-cpt.jpg'); ?>"/>
                    </div>
                    <div class="addon-content">
                        <h3>Team Members</h3>
                        <p>Display your team members details with their social profile links</p>
                    </div>
                </div>
            </div>
            <div class="addon-container">
                <div class="addon-container-bg">
                    <div class="addon-img">
                        <img src="<?php echo plugins_url(PLUGIN_DIR.'assets/addons-img/services-cpt.jpg'); ?>"/>
                    </div>
                    <div class="addon-content">
                        <h3>Services</h3>
                        <p>Show your website services in a creative way</p>
                    </div>
                </div>
            </div>
            <div class="addon-container">
                <div class="addon-container-bg">
                    <div class="addon-img">
                        <img src="<?php echo plugins_url(PLUGIN_DIR.'assets/addons-img/testimonials-cpt.jpg'); ?>"/>
                    </div>
                    <div class="addon-content">
                        <h3>Testimonials</h3>
                        <p>Display Unlimited testimonials, reviews or quotes in multiple ways</p>
                    </div>
                </div>
            </div>
            <div class="addon-container">
                <div class="addon-container-bg">
                    <div class="addon-img">
                        <img src="<?php echo plugins_url(PLUGIN_DIR.'assets/addons-img/video-cpt.jpg'); ?>"/>
                    </div>
                    <div class="addon-content">
                        <h3>Video Gallery</h3>
                        <p>Easily upload and show videos of different formats (mp4, webM, ogv)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="button-container">
            <a href="https://pagebuilderaddons.com/plan-and-pricing/?utm_source=plugin-admindashboard&utm_medium=pluginadmin&utm_campaign=go_pro&utm_content=pbaddonsdoc" target="_blank" title="Page Builder Addons">Upgrade to Premium</a>
        </div>
    </div>
    <?php
}
