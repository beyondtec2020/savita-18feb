<?php
/**
 * Created by Bit14.
 * User: Ishraq
 * Date: 4/17/2019
 * Time: 1:30 PM
 */



class WPBakeryShortCode_Bit14_Info_Banner extends WPBakeryShortCode {
    function __construct(){
       // add_action( 'admin_init', array( $this, 'mapping' ) );
        add_action( 'wp_loaded', array( $this, 'mapping' ) );
        add_shortcode('info_banner',array($this,'shortcode_html'));
    }

    function mapping(){

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name'          => __('Info Banner', 'bit14'),
                'base'          => 'info_banner',
                'description'   => __('Info Banner', 'bit14'),
                'category'      => __('PB Addons', 'bit14'),
                'icon'          => plugin_dir_url(__DIR__) . 'assets/images/info-banner.png',
                'params'        => array(

                    array(
                        'type'          => 'textfield',
                        'heading'       => __( 'Element ID', 'bit14' ),
                        'param_name'    => 'id',
                        'description'   => __( 'Element ID', 'bit14' ),
                    ),

                    array(
                        'type'          => 'textfield',
                        'heading'       => __( 'Extra Class Name', 'bit14' ),
                        'param_name'    => 'class',
                        'description'   => __( 'Extra Class Name', 'bit14' ),
                    ),

                    array(
                        'type'          => 'dropdown',
                        'heading'       => __( 'List item(s) in a row', 'bit14' ),
                        'param_name'    => 'cols',
                        'description'   => __( 'Number of list item(s) to be displayed in one row', 'bit14' ),
                        'value'         => array(
                            "One"     =>  'one',
                            "Two"     =>  'two',
                            "Three"   =>  'three',
                        )
                    ),

                     array(
                        'type'          => 'colorpicker',
                        'heading'       => __( 'Text Color', 'bit14' ),
                        'param_name'    => 'txt_color',
                        'description'   => __( 'Select Text color for all', 'bit14' ),
                        
                    ),

                    array(
                        'type'          => 'colorpicker',
                        'heading'       => __( 'Button Background Hover Color', 'bit14' ),
                        'param_name'    => 'btn_bg_color',
                        'description'   => __( 'Select Button Background color', 'bit14' ),
                        
                    ),
                     array(
                        'type'          => 'colorpicker',
                        'heading'       => __( 'Button Text Color', 'bit14' ),
                        'param_name'    => 'btn_text_color',
                        'description'   => __( 'Select text color for button', 'bit14' ),
                        
                    ),

                     array(
                        'type'          => 'checkbox',
                        'heading'       => __( 'Hover Box', 'bit14' ),
                        'param_name'    => 'is_hover',
                        'description'   => __( 'Select checkbox for hover', 'bit14' ),
                        'value'         =>  '1',
                        'dependency'    => array(
                                'element'       => 'cols',
                                'value'         => 'three',
                        ),
                    ),

                    array(
                        'type'          => 'param_group',
                        'param_name'    => 'info-banner',
                        'description'   => __( 'Enter details for info banners', 'bit14' ),
                        'value'         => '',
                        'params'        => array(

                            array(
                                'type'          =>  'attach_image',
                                'heading'       =>  __( 'Attach Image', 'bit14' ),
                                'description'   =>  'Attached Image will be added to the banner',
                                'param_name'    =>  'image',
                            ),
                            array(
                                'type'          => 'textfield',
                                'heading'       => __( 'Title', 'bit14' ),
                                'param_name'    => 'title',
                                'description'   => __( 'Enter Title For Banner.', 'bit14' ),
                                'admin_label'   => true,
                                
                            ),
                            array(
                                "type"          => "textarea",
                                "class"         => "",
                                "heading"       => __( "Content", "Bit14" ),
                                "param_name"    => "content",
                               
                            ),
                            array(
                                'heading'       => __('Button','bit14'),
                                'param_name'    => 'btn',
                                'group'         => 'General',
                                'type'          => 'dropdown',
                                'value'         => array(
                                    'Yes'   => 'Yes',
                                    'No'    => 'No',
                                ),
                            ),
                            array(
                                'type'          => 'textfield',
                                'heading'       => __( 'Button Text', 'bit14' ),
                                'param_name'    => 'btn_txt',
                                'description'   => __( 'Enter Text For Button.', 'bit14' ),
                                'admin_label'   => true,
                                'value'         => '',
                                'dependency'    => array('element' => 'btn','value'=>'Yes'),
                            ),
                            array(
                                'type'          => 'textfield',
                                'heading'       => __( 'Button Link', 'bit14' ),
                                'param_name'    => 'btn_link',
                                'description'   => __( 'Enter Link For Button.', 'bit14' ),
                                'admin_label'   => true,
                                'value'         => '',
                                'dependency'    => array('element' => 'btn','value'=>'Yes'),
                            ),
                        ),
                    ),
                ),
            )
        );
    }

    function shortcode_html($atts, $content = null){
        
        $items = vc_param_group_parse_atts( $atts['info-banner'] );

        extract( shortcode_atts( array(
            'id'                => '',
            'class'             => '',
            'cols'              => '',
            'is_hover'          => '',
            'btn_bg_color'      => '',
            'txt_color'         => '',
            'btn_text_color'    => '',

        ), $atts ) );

        $id                 = ( $id    != '' )              ? '' . esc_attr( $id ) . '"'    : '';
        $class              = ( $class != '' )              ? 'info-banner ' . esc_attr( $class ) : 'info-banner';
        $cols    = ( $cols != '' )    ? $cols                  : 'one';
        
        $is_hover    = ( $is_hover != '' )    ? 'hover-box'                  : '';

        $btn_bg_color               = ( $btn_bg_color != '' )           ? $btn_bg_color                                     : '#ffffff';

        $txt_color               = ( $txt_color != '' )           ? $txt_color                                     : '#ffffff';

        $btn_text_color          = ( $btn_text_color != '' )           ? $btn_text_color                                     : '#ffffff';

        $output  = '<div '.esc_attr($id).' class="bit-banner-container '.esc_attr($class).' '.esc_attr($is_hover).'">';
            $output .= '<div id="" class="row bit14-banners" >';

                foreach ($items as $item) {

                    $image =
                            ( isset($item['image'])  && $item['image'] != '' ) ?
                                wp_get_attachment_image_src($item["image"], "large") :
                                '';   

                    $title                      = ( isset($item['title']) && $item['title'] != '' ) ? esc_attr($item['title']) : '';  

                     $content                      = ( isset($item['content']) && $item['content'] != '' ) ? esc_attr($item['content']) : '';  
                

                     $btn_txt                      = ( isset($item['btn_txt']) && $item['btn_txt'] != '' ) ? esc_attr($item['btn_txt']) : '';  

                     $btn_link                      = ( isset($item['btn_link']) && $item['btn_link'] != '' ) ? esc_attr($item['btn_link']) : '';  


                    $output .= '<div class="bit-banner column-'.esc_attr($cols).'" data-btn-bgcolor="'. esc_attr($btn_bg_color) .'">';

                    $output .= '<div class="bit-col-wrapper" style="background-image: url('.$image[0].');">';


                    $output .= '<h2 class="bit-banner-title" style="color:'.esc_attr($txt_color).'">'.$title.'</h2>';
                    $output .= '<div class="bit-banner-content"><p style="color:'.esc_attr($txt_color).'">'.$content.'</p></div>';


                   if( $item['btn'] == 'Yes' ){
                        $output .= '<div class="btn">';
                        $output .= '<a href="'.$btn_link.'" style="color:'.esc_attr($btn_text_color).'">'.$btn_txt.'</a>';
                        $output .= '</div>';
                    }

                    $output .= '</div>';
                    $output .= '</div>';


                }

            $output .= '</div>';

        $output .= '</div>';
        $output .= wp_enqueue_style( 'pro-bit14-vc-addons-info-banner', assets_url.'css/info-banner.css', false );
        $output .= wp_enqueue_script( 'pb-info-banner', assets_url.'js/info-banner-script.js', array('jquery'), false );

        return $output;
    }

}

new WPBakeryShortCode_Bit14_Info_Banner;