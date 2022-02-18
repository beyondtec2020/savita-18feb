<?php

class WPBakeryShortCode_Bit14_Newsletter_Subscriber extends WPBakeryShortCode {
	
	function __construct(){
		add_action( 'admin_init', array( $this, 'mapping' ) );
		add_shortcode('newsletter-subscriber',array($this,'shortcode_html'));
	}

	function mapping(){

		// Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Newsletter Subscriber', 'bit14-'),
                'base' => 'newsletter-subscriber',
                'description' => __('Newsletter subscriber form', 'bit14-'), 
                'category' => __('PB Addons', 'bit14-'),
                'icon' => plugin_dir_url(__DIR__) . 'assets/images/newsletter-subscriber.png',           
                'params' => array(
                    array(
                        'type'          =>  'textfield',
                        'class'         =>  'newslettersubscriber_title',
                        'heading'       =>  __( 'Title', 'bit14-' ),
                        'description'   =>  'Title of your form',
                        'param_name'    =>  'title',
                    ),
                    array(
                        'type'          =>  'textarea',
                        'class'         =>  'newslettersubscriber_description',
                        'heading'       =>  __( 'Description', 'bit14-' ),
                        'description'   =>  'Description of your form',
                        'param_name'    =>  'description',
                    ),
                    array(
                        'type'          =>  'colorpicker',
                        'class'         =>  'newslettersubscriber_theme',
                        'heading'       =>  __( 'Colour Theme', 'bit14-' ),
                        'description'   =>  'Colour theme of your form',
                        'param_name'    =>  'theme',
                        'value'         =>  '#ffffff'
                    ),
                )
            )
        );
	}

	function shortcode_html($atts, $content = null){

        extract( shortcode_atts( array(
            'title'             =>  '',
            'name'              =>  '',
            'description'       =>  '',
            'group_name'        =>  '',
            'theme'             =>  ''
        ), $atts ) );

        
        $title          =   ( $title != '' )        ?   $title : '';
        $description    =   ( $description != '' )  ?   $description : '';
        $theme          =   ( $theme != '' )        ?   esc_attr( $theme ) : '#ffffff';
    
        
        $output = '<div class="newsletter_subscriber" style="color:'. $theme .'" data-theme="'. $theme .'">';
            $output .= '<h2>' . $title . '</h2>';
            $output .= '<p>' . $description . '</p>';
            $output .= do_shortcode( '[newsletter]' );
        $output .= '</div>';
        
        return $output;
    }
}

if ( is_plugin_active( 'newsletter/plugin.php' ) ) {


    new WPBakeryShortCode_Bit14_Newsletter_Subscriber;

}