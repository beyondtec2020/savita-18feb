<?php

class WPBakeryShortCode_Bit14_Pricing_Tables extends WPBakeryShortCodesContainer {

    function __construct(){
         // add_action( 'admin_init', array( $this, 'mapping' ) );
        add_action( 'wp_loaded', array( $this, 'mapping' ) );
        add_shortcode('Bit14_Pricing_Tables',array($this,'shortcode_html'));
    }

    function mapping(){

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                "name"                      =>   __( 'Pricing Tables', 'bit14' ),
                "description"               =>   __( 'Group of Pricing Tables', 'bit14' ),
                "base"                      =>  "Bit14_Pricing_Tables",
                "class"                     =>  "Bit14_Pricing_Tables",
                'category'      => __('PB Addons', 'bit14'),
                "as_parent"                 =>  array('only' => 'Bit_Pricing_Table'),
                "content_element"           =>  true,
                "is_container"              =>  true,
                'icon'                      =>  'icon-bit-table',
                "show_settings_on_create"   =>  true,
                "js_view"                   =>  'VcColumnView',
                'params'                    =>  array(

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
                        'type'          =>  'colorpicker',
                        'heading'       =>  __( 'Primary Color', 'bit14' ),
                        'param_name'    =>  'primary_color',
                        'value'         =>  '#7f7f7f'
                    ),

                    array(
                        'type'          =>  'colorpicker',
                        'heading'       =>  __( 'Alternate Color', 'bit14' ),
                        'param_name'    =>  'alternate_color',
                        'value'         =>  '#ffffff'
                    ),

                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  __( 'Theme', 'bit14' ),
                        'param_name'    =>  'theme',
                        'description'   =>  __( 'Theme style for your table', 'bit14' ),
                        'value'         =>  array(
                            'Theme One'     =>  'theme-one',
                            'Theme Two'     =>  'theme-two',
                            'Theme Three'   =>  'theme-three',
                        )
                    ),

                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  __( 'Tables in a row', 'bit14' ),
                        'param_name'    =>  'columns',
                        'description'   =>  __( 'Number of tables in a row', 'bit14' ),
                        'dependency'    =>  array(
                            'element'       =>  'theme',
                            'value'         =>  array( 'theme-one' , 'theme-two' )
                        ),
                        'value'         => array(
                            "Four"  =>  '4',
                            "Three" =>  '3',
                            "Two"   =>  '2',
                            "One"   =>  '1',
                        )
                    ),

                ),
            )
        );
    }

    function shortcode_html($atts, $content = null){

        extract(
            shortcode_atts( array(
                "id"                =>  "",
                "class"             =>  "",
                "primary_color"     =>  "",
                "alternate_color"   =>  "",
                "theme"             =>  "",
                "columns"           =>  ""
            ), $atts)
        );

        $this->table_id         =   ( $id != "" )               ?   esc_attr($id)               :   "" ;
        $this->table_class      =   ( $class != "" )            ?   esc_attr($class)            :   "" ;
        $this->primary_color    =   ( $primary_color != "" )    ?   esc_attr($primary_color)    :   "#7f7f7f" ;
        $this->alternate_color  =   ( $alternate_color != "" )  ?   esc_attr($alternate_color)  :   "#ffffff" ;
        $this->theme            =   ( $theme != "" )            ?   esc_attr($theme)            :   "theme-one" ;
        $this->columns          =   ( $columns != "" )          ?   12 / $columns               :   "3";

        $this->columns          =   ( $theme == "theme-three" ) ?   "12"                        :   $this->columns;

        return "<div id='".$this->table_id."' class='".$this->table_class.' '.$this->theme." bit_table_group row' data-columns='".$this->columns."' data-primary-color='".$this->primary_color."' data-alternate-color='".$this->alternate_color."' >" . apply_filters('the_content', $content). "</div>";


    }
}

//===================
// Child
//===================

class WPBakeryShortCode_Bit14_Pricing_Table extends WPBakeryShortCode {

    function __construct(){
        // add_action( 'admin_init', array( $this, 'mapping' ) );
        add_action( 'wp_loaded', array( $this, 'mapping' ) );
        add_shortcode('Bit_Pricing_Table',array($this,'shortcode_html'));
    }

    function mapping(){

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                "name"                      =>  __( 'Pricing Table', 'bit14' ),
                "description"               =>  __( 'Pricing Table', 'bit14' ),
                "base"                      =>  "Bit_Pricing_Table",
                "class"                     =>  "Bit_Pricing_Table",
                "as_child"                  =>  array('only' => 'Bit14_Pricing_Tables'),
                "content_element"           =>  true,
                'category'      => __('PB Addons', 'bit14'),
                'icon'                      =>  'icon-bit-table',
                "show_settings_on_create"   =>  true,
                "params"                    =>  array(

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Table ID', 'bit14' ),
                        'param_name'    =>  'id',
                        'description'   =>  __( 'Table Specific ID', 'bit14' ),
                    ),

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Table Class Name', 'bit14' ),
                        'param_name'    =>  'class',
                        'description'   =>  __( 'Extra Class Name', 'bit14' ),
                    ),

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Title', 'bit14' ),
                        'param_name'    =>  'table_title',
                        'description'   =>  __( 'Title of the table', 'bit14' ),
                    ),

                    array(
                        'type'          =>  'checkbox',
                        'heading'       =>  __( 'Featured', 'bit14' ),
                        'param_name'    =>  'is_featured',
                        'description'   =>  __( 'Is this table featured?', 'bit14' ),
                    ),

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Currency', 'bit14' ),
                        'param_name'    =>  'currency',
                        'description'   =>  __( 'Please enter your currency sign here. Example: "$"', 'bit14' )
                    ),

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Price', 'bit14' ),
                        'param_name'    =>  'price',
                        'description'   =>  __( 'Please enter your amount here.', 'bit14' )
                    ),

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Duration', 'bit14' ),
                        'param_name'    =>  'duration',
                        'description'   =>  __( 'Duration of expiry. Example: "Month"', 'bit14' )
                    ),

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Description', 'bit14' ),
                        'param_name'    =>  'description'
                    ),

                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Button Text', 'bit14' ),
                        'param_name'    =>  'button_text',
                        'description'   =>  __( 'Please enter text of button if you want a button at the end of your table.', 'bit14' )
                    ),


                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Button Link', 'bit14' ),
                        'param_name'    =>  'button_link',
                        'description'   =>  __( 'Link where button redirects the user.', 'bit14' )
                    ),

                    array(
                        'type'          =>  'param_group',
                        'heading'       =>  'List of Items',
                        'param_name'    =>  'features',
                        'params'        =>  array(
                            array(
                                'type'          =>  'textfield',
                                'heading'       =>  __( 'Title', 'bit14' ),
                                'description'   =>  'Title of your item',
                                'param_name'    =>  'pricing_table_list_title',
                            ),
                            array(
                                'type'          =>  'iconpicker',
                                'heading'       =>  __( 'Icon', 'bit14' ),
                                'description'   =>  'Icon of the list',
                                'param_name'    =>  'pricing_table_list_icon',
                            ),
                            array(
                                'type'          =>  'textfield',
                                'heading'       =>  __( 'Content', 'bit14' ),
                                'description'   =>  'Content of item if any',
                                'param_name'    =>  'pricing_table_list_content',
                            ),
                        )
                    )

                )
            )
        );
    }

    function shortcode_html($atts, $content = null){

        extract(
            shortcode_atts( array(
                "id"                        =>  "" ,
                "class"                     =>  "" ,
                "table_title"               =>  "" ,
                "is_featured"               =>  "" ,
                "currency"                  =>  "" ,
                "price"                     =>  "" ,
                "duration"                  =>  "" ,
                "description"               =>  "" ,
                "button_text"               =>  "" ,
                "button_link"               =>  "" ,
                "features"                  =>  ""
            ), $atts)
        );

        $id                 = ( $id != "" )                   ?   esc_attr( $id )                 : "" ;
        $class              = ( $class != "" )                ?   esc_attr( $class )              : "" ;
        $table_title        = ( $table_title != "" )          ?   esc_attr( $table_title )        : "" ;
        $is_featured        = ( $is_featured )                ?   "is_featured"                   : "" ;
        $currency           = ( $currency != "" )             ?   esc_attr( $currency )           : "" ;
        $price              = ( $price != "" )                ?   esc_attr( $price )              : "" ;
        $duration           = ( $duration != "" )             ?   esc_attr( $duration )     : "" ;
        $description        = ( $description != "" )          ?   esc_attr( $description )        : "" ;
        $button_text        = ( $button_text != "" )          ?   esc_attr( $button_text )        : "" ;
        $button_link        = ( $button_link != "" )          ?   esc_attr( $button_link )        : "" ;
        $features           = ( $features != "" )             ?   esc_attr( $features )           : "" ;

        $features = ($features != "") ? vc_param_group_parse_atts( $atts['features'] ) : "";


        $html = '<div class="bit_table">';

            $html .=  '<div class="bit_table_table '. $is_featured . '" >';

                $html .=  '<div id="'. $id .'" width="100%" class="bit_table_row ' . $class .'" >';

                    //Title
                    if ( $table_title != "" ) :
                        $html .= '<h2>'. $table_title .'</h2>';
                    endif;


                    $html .= '<div class="bit-price-description">';
                        //Price
                        if ( $price != "" ) :
                            $html .= '<span class="price">'. $currency . ' ' . $price .'<span class="duration"> '. $duration .'</span></span>';
                        endif;
                        //Description
                        if ( $description != "" ) :
                            $html .= '<p class="description">'. $description . '</p>';
                        endif;
                    $html .= '</div>';


                    //List
                    if ( !empty($features) ) :
                        $html .= '<ul class="bit_pricing_table_list">';
                            //loop starts here

                            foreach ($features as $feature) {

                                $pricing_table_list_title =
                                isset($feature['pricing_table_list_title']) ?
                                esc_attr($feature['pricing_table_list_title']) :
                                "";

                                $pricing_table_list_content =
                                isset($feature['pricing_table_list_content']) ?
                                esc_attr($feature['pricing_table_list_content']) :
                                "";

                                $pricing_table_list_icon =
                                isset($feature['pricing_table_list_icon']) ?
                                '<i class="'. esc_attr($feature['pricing_table_list_icon']) .'" ></i>' :
                                "";

                                $pricing_table_list_content =
                                isset($feature['pricing_table_list_content']) ?
                                esc_attr($feature['pricing_table_list_content']) :
                                "";

                                if( !empty($pricing_table_list_title) ) {
                                    $html .= '<li>';
                                        $html .= '<span class="pricing_table_list_title">'. $pricing_table_list_title .'</span>';
                                        $html .= '<span class="pricing_table_list_content">'. $pricing_table_list_content .'</span>';
                                        $html .= $pricing_table_list_icon;
                                    $html .= '</li>';
                                }

                            };

                            //loop ends here
                        $html .= '</ul>';
                    endif;


                    //Button
                    if ( $button_link != "" && $button_link != "" ) :
                        $html .= '<span class="pricing_table_list_button"><a href="'. $button_link .'" class="btn btn-default">'. $button_text .'</a><span>';
                    endif;

                $html .= '</div>';

            $html .= '</div>';

        $html .= '</div>';//Col-sm- div which was opened in previous function

        $html .= wp_enqueue_style( 'pro-bit14-vc-addons-pricing-table', assets_url.'css/pricing-table.css', false );
        $html .=wp_enqueue_script( 'pro-bit14-vc-addons-pricing-table', assets_url.'js/pricing-table-script.js', array('jquery'), false, true );
        return $html;
    }
}

new WPBakeryShortCode_Bit14_Pricing_Table;
new WPBakeryShortCode_Bit14_Pricing_Tables;

