<?php
/**
 * Created by Bit14.
 * User: Abdul Qadir
 * Date: 08/28/2019
 */



class WPBakeryShortCode_Bit14_Headings extends WPBakeryShortCode {
    function __construct(){
        // add_action( 'admin_init', array( $this, 'mapping' ) );
        add_action( 'wp_loaded', array( $this, 'mapping' ) );
        add_shortcode('bit_headings',array($this,'shortcode_html'));
    }

    function mapping(){

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name'          => __('Headings', 'bit14'),
                'base'          => 'bit_headings',
                'description'   => __('Headings', 'bit14'),
                'category'      => __('PB Addons', 'bit14'),
                'icon'          => plugin_dir_url(__DIR__) . 'assets/images/Heading.png',
                'params'        => array(

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Element ID', 'bit14' ),
                        'param_name'    =>  'id',
                        'description'   =>  __( 'Element ID', 'bit14' ),
                    ),

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Extra Class Name', 'bit14' ),
                        'param_name'    =>  'class',
                        'description'   =>  __( 'Extra Class Name', 'bit14' ),
                    ),

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Heading Text', 'bit14' ),
                        'param_name'    =>  'heading',
                    ),
                    
                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  __( 'Heading Position', 'bit14' ),
                        'param_name'    =>  'heading_position',
                        'value'         => array(
                            'Left'            =>  'left',
                            'Right'           =>  'right',
                            'Center'          =>  'center',
                        ),
                    ),

                    array(
                        'type'          =>  'colorpicker',
                        'heading'       =>  __( 'Heading Color', 'bit14' ),
                        'param_name'    =>  'heading_color',
                        'value'         => '#000',
                    ),

                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  __( 'Select Heading Style', 'bit14' ),
                        'param_name'    =>  'heading_styles',
                        'value'         => array(
                            'Border Top'              =>  'bdr_top',
                            'Border Bottom'           =>  'bdr_bottom',
                            'Border Top With Icon'    =>  'bdr_top_with_icon',
                            'Border Bottom With Icon' =>  'bdr_bottom_with_icon',
                            'Full Border'             =>  'full_border',
                            'Background Color'        =>  'bg_color',
                        )
                    ),

                    array(
                        'type'          =>  'colorpicker',
                        'heading'       =>  __( 'Border Color', 'bit14' ),
                        'param_name'    =>  'border_color',
                        'value'         => '#000',
                        'dependency'    => array(
                            'element'         => 'heading_styles',
                            'value'           => array('bdr_top', 'bdr_bottom', 'full_border','bdr_top_with_icon','bdr_bottom_with_icon'),
                        ),
                    ),

                    array(
                        'type'          =>  'colorpicker',
                        'heading'       =>  __( 'Background Color', 'bit14' ),
                        'param_name'    =>  'background_color',
                        'value'         => '#000',
                        'dependency'    => array(
                            'element'         => 'heading_styles',
                            'value'           => array('bg_color'),
                        ),
                    ),

                    array(
                        'type'          =>  'iconpicker',
                        'heading'       =>  __( 'Icon', 'bit14' ),
                        'param_name'    =>  'icon_pick',
                        'value'         => 'fa fa-heart',
                        'dependency'    => array(
                            'element'         => 'heading_styles',
                            'value'           => array('bdr_top_with_icon','bdr_bottom_with_icon'),
                        ),
                    ),

                    array(
                        'type'          =>  'colorpicker',
                        'heading'       =>  __( 'Icon Color', 'bit14' ),
                        'param_name'    =>  'icon_color',
                        'value'         => '#000',
                        'dependency'    => array(
                            'element'         => 'heading_styles',
                            'value'           => array('bdr_top_with_icon','bdr_bottom_with_icon'),
                        ),
                    ),

                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  __( 'Icon Position', 'bit14' ),
                        'param_name'    =>  'icon_position',
                        'value'         => array(
                            'Left'            =>  'left',
                            'Right'           =>  'right',
                            'Center'          =>  'center',
                        ),
                        'dependency'    => array(
                            'element'         => 'heading_styles',
                            'value'           => array('bdr_top_with_icon','bdr_bottom_with_icon'),
                        ),
                    ),

                ),
            )
        );
    }

    function shortcode_html($atts, $content = null){
        extract(
            shortcode_atts( array(
                "id"                    =>  "",
                "class"                 =>  "",
                "heading"               =>  "",
                "heading_color"         =>  "",
                "heading_styles"        =>  "",
                "border_color"          =>  "",
                "background_color"      =>  "",
                "icon_pick"             =>  "",
                "icon_color"            =>  "",
                "icon_position"         =>  "",
                "heading_position"      =>  "",
            ), $atts)
        );

        $id               = ( $id != "" )               ?   esc_attr($id)                           :   "" ;
        $class            = ( $class != "" )            ?   esc_attr($class)                        :   "" ;
        $heading          = ( $heading != "" )          ?   esc_attr($heading)                      :   "" ;
        $heading_color    = ( $heading_color != "" )    ?   esc_attr($heading_color)                :   "#000" ;
        $heading_styles   = ( $heading_styles != "" )   ?   esc_attr($heading_styles)               :   "bdr_top" ;
        $border_color     = ( $border_color != "" )     ?   esc_attr($border_color)                 :   "" ;
        $background_color = ( $background_color != "" ) ?   esc_attr($background_color)             :   "" ;
        $icon_pick        = ( $icon_pick != "" )        ?   esc_attr($icon_pick)                    :   "fa fa-heart" ;
        $icon_color       = ( $icon_color != "" )       ?   esc_attr($icon_color)                   :   "#000" ;
        $icon_position    = ( $icon_position != "" )    ?   esc_attr($icon_position)                :   "left" ;
        $heading_position = ( $heading_position != "" ) ?   esc_attr($heading_position)             :   "left" ;
        $rand = rand();
        if($heading_styles == 'bdr_top'){
            $class .= " top-bordered";
        } else if($heading_styles == 'bdr_bottom'){
            $class .= " bottom-bordered";
        } else if($heading_styles == 'full_border'){
            $class .= " full-bordered";
            if($heading_position == 'left'){
                $class .= " left-align";
            } else if($heading_position == 'right'){
                $class .= " right-align";
            }
        } else if($heading_styles == 'bdr_bottom_with_icon'){
            $class .= ' border_bottom_icon';
        } else if($heading_styles == 'bdr_top_with_icon'){
            $class .= ' border_top_icon';
        }

        if($heading_styles == 'bdr_bottom_with_icon' || $heading_styles == 'bdr_top_with_icon'){
            if($icon_position == 'left'){
                $class .= ' left-icon';
            } else if($icon_position == 'right'){
                $class .= ' right-icon';
            } 
        }


        $output = "<div data-id='".$rand."' data-background-color='".$background_color."' data-icon-color='".$icon_color."' data-heading-color='".$heading_color."' data-border-color='".$border_color."' data-icon-position='".$icon_position."' data-heading-position='".$heading_position."' class='bit-pb-heading'>";
            $output .= "<h2 class='".$class."'>";
            if($heading_styles == 'bdr_top_with_icon'){
                $output .= "<span><i class='".$icon_pick." border-icon'></i></span>";
            }        
            $output .= $heading;
            if($heading_styles == 'bdr_bottom_with_icon'){
                $output .= "<span><i class='".$icon_pick." border-icon'></i></span>";
            }
            $output .= "</h2>";
        $output .= "</div>";
        
        if($heading_styles == 'bdr_top_with_icon' || $heading_styles == 'bdr_bottom_with_icon'){
            $output .= '<style>
                            .bit-pb-heading[data-id="'.$rand.'"] span:before{
                                border-color: '.$border_color.';
                            }
                        </style>';
        }
        if($heading_styles == 'full_border'){
             $output .= '<style>
                            .bit-pb-heading[data-id="'.$rand.'"] h2.full-bordered:before,
                            .bit-pb-heading[data-id="'.$rand.'"] h2.full-bordered:after{
                                border-color: '.$border_color.';
                            }
                        </style>';   
        }
        if($heading_styles == 'bdr_bottom_with_icon' || $heading_styles == 'bdr_top_with_icon'){
            $output .= '<style>
                            .bit-pb-heading[data-id="'.$rand.'"] h2.border_bottom_icon span:before, .bit-pb-heading[data-id="'.$rand.'"] h2.border_bottom_icon span:after,
                            .bit-pb-heading[data-id="'.$rand.'"] h2.border_top_icon span:before, .bit-pb-heading[data-id="'.$rand.'"] h2.border_top_icon span:after {
                                border-color: '.$border_color.';
                            }
                        </style>';
        }


        $output .= wp_enqueue_style( 'pro-bit14-vc-addons-heading', assets_url.'css/heading.css', false );
        $output .= wp_enqueue_script( 'pro-bit14-vc-addons-heading', assets_url.'js/heading-script.js', array('jquery'), false, true );
        
        return $output;
    }

}

new WPBakeryShortCode_Bit14_Headings;