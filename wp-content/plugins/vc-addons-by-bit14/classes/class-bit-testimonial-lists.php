<?php

class WPBakeryShortCode_Bit14_Testimonial_Lists extends WPBakeryShortCode {
    
    function __construct(){

        // add_action( 'admin_init', array( $this, 'mapping' ) );
        add_action( 'wp_loaded', array( $this, 'mapping' ) );
        add_shortcode('testimonial-lists',array($this,'shortcode_html'));

    }

    function mapping(){

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        $testimonial_category = get_terms( array(
            'taxonomy' => 'testimonial_category',
        ) );

        $testimonial_categories = array();
        $testimonial_categories['All'] = 'all';
        foreach ($testimonial_category as $category) {
            $testimonial_categories[$category->name] = $category->slug;
        }
        

        // Map the block with vc_map()
        vc_map( 
            array(
                'name'          => __('Testimonials', 'bit14'),
                'base'          => 'testimonial-lists',
                'description'   => __('Testimonials', 'bit14'), 
                'category'      => __('PB Addons', 'bit14'),
                'icon'          => plugin_dir_url(__DIR__) . 'assets/images/testimonial-lists.png',           
                'params'        => array(

                    array(
                        'type'          => 'textfield',
                        'heading'       => __( 'Element ID', 'bit14' ),
                        'param_name'    => 'id',
                        'description'   => __( 'Element ID', 'bit14' ),
                        'group'         => 'General'
                    ),

                    array(
                        'type'          => 'textfield',
                        'heading'       => __( 'Extra Class Name', 'bit14' ),
                        'param_name'    => 'class',
                        'description'   => __( 'Extra Class Name', 'bit14' ),
                        'group'         => 'General'
                    ),

                    array(
                        'type'          => 'dropdown',
                        'heading'       => __( 'Theme Style', 'bit14' ),
                        'param_name'    => 'theme_style',
                        'group'         => 'General',
                        'value'         => array(
                            'Theme Style 1' => 'testimonial-style-one-pro',
                            'Theme Style 2' => 'testimonial-style-two-pro',
                            'Theme Style 3' => 'testimonial-style-three-pro',
                        ),
                    ),


                    array(
                        'type'          => 'dropdown',
                        'heading'       => __( 'Slider', 'bit14' ),
                        'param_name'    => 'is_slider',
                        'value'         => array('No','Yes'),
                        'group'         => 'General',
                        'dependency'    => array(
                            'element'       =>  'theme_style',
                            'value'         =>  array('testimonial-style-two-pro'),
                        ),
                    ),

                    array(
                        'type'          => 'checkbox',
                        'heading'       => __('Prev/Next Arrows?','bit14'),
                        'param_name'    => 'is_arrows',
                        'value'         => '1',
                        'group'         => 'General',
                        'dependency'    => array('element' => 'is_slider','value'=>'Yes'),
                    ),

                    array(
                        'type'          => 'checkbox',
                        'heading'       => __( 'Dynamic adaptive height', 'bit14' ),
                        'param_name'    => 'adaptive_height',
                        'value'         => '1',
                        'group'         => 'General',
                        'dependency'    => array('element' => 'is_slider','value'=>'Yes'),
                    ),


                    array(
                        'type'          => 'checkbox',
                        'heading'       => __('Autoplay?','bit14'),
                        'param_name'    => 'is_autoplay',
                        'value'         => '1',
                        'group'         => 'General',
                        'dependency'    => array('element' => 'is_slider','value'=>'Yes'),
                    ),

                    array(
                        'type'          => 'dropdown',
                        'heading'       => __('Autoplay Speed?','bit14'),
                        'param_name'    => 'autoplay_speed',
                        'value'         => array('500','1000','1500','2000','2500','3000','4000','5000','6000','7000'),
                        'group'         => 'General',
                        'dependency'    => array('element' => 'is_slider','value'=>'Yes'),
                    ),

                    array(
                        'type'          => 'checkbox',
                        'heading'       => __('Pause on Hover?','bit14'),
                        'param_name'    => 'is_pause_onhover',
                        'value'         => '1',
                        'group'         => 'General',
                        'dependency'    => array('element' => 'is_slider','value'=>'Yes'),
                    ),

                    array(
                        'type'          => 'dropdown',
                        'heading'       => __('Slides in a row','bit14'),
                        'param_name'    => 'desktop_num_slides',
                        'value'         => array(1,2,3,4),
                        'group'         => 'Desktop',
                        'dependency'    => array(
                            'element'       =>  'theme_style',
                            'value'         =>  array('testimonial-style-one-pro')
                        ),
                    ),


                    array(
                        'type'          => 'dropdown',
                        'heading'       => __('Slides in a row','bit14'),
                        'param_name'    => 'tablet_num_slides',
                        'value'         => array(1,2,3,4),
                        'group'         => 'Tablet',
                        'dependency'    => array(
                            'element'       =>  'theme_style',
                            'value'         =>  'testimonial-style-one-pro'
                        ),
                    ),

                    array(
                        'type'          => 'dropdown',
                        'heading'       => __('Slides in a row','bit14'),
                        'param_name'    => 'mobile_num_slides',
                        'value'         => array(1,2,3,4),
                        'group'         => 'Mobile',
                        'dependency'    => array(
                            'element'       =>  'theme_style',
                            'value'         =>  'testimonial-style-one-pro'
                        ),
                    ),

                    array(
                        'type' => 'param_group',
                        'heading' => __( 'Testimonial', 'bit14' ),
                        'param_name' => 'testimonials',
                        'value' => '',
                        'group' => 'Testimonials',
                        'params' => array(
                            array(
                                'type' => 'textfield',
                                'heading' => __( 'Author Name', 'bit14' ),
                                'param_name' => 'author_name',
                                'description' => __( 'Enter Author Name For Testimonial.', 'bit14' ),
                                'admin_label' => true,
                                'value' => '',
                            ),
                            array(
                                'type' => 'attach_image',
                                'heading' => __( 'Author Image', 'bit14' ),
                                'param_name' => 'author_image',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __( 'Author Image Alternate Text', 'bit14' ),
                                'param_name' => 'author_image_alt',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __( 'Author Position', 'bit14' ),
                                'param_name' => 'author_details',
                                'value' => '',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __( 'Author Company', 'bit14' ),
                                'param_name' => 'author_company',
                                'value' => '',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __( 'Author URL', 'bit14' ),
                                'param_name' => 'author_url',
                                'value' => '',
                            ),
                            array(
                                'type' => 'textfield',
                                'heading' => __( 'Rating Stars', 'bit14' ),
                                'param_name' => 'rating_stars',
                                'value' => '',
                            ),
                            array(
                                'type' => 'textarea',
                                'heading' => __( 'Text', 'bit14' ),
                                'param_name' => 'testimonial',
                                'description' => __( 'What your client/customer has to say.', 'bit14' ),
                            ),
                        ),
                    ),
                ),
            )
        );
    }

    function shortcode_html($atts, $content = null){

        $testimonials = vc_param_group_parse_atts( $atts['testimonials'] );



        extract( shortcode_atts( array(
            'id'                        => '',
            'class'                     => '',
            'theme_style'               => '',
            'rating_stars'              => '',
            'is_slider'                 => '',
            'is_arrows'                 => '',
            'is_dots'                   => '',
            'is_autoplay'               => '',
            'autoplay_speed'            => '',
            'is_pause_onhover'          => '',
            'is_fade'                   => '',
            'desktop_num_slides'        => '',
            'desktop_num_slides_move'   => '',
            'tablet_num_slides'         => '',
            'tablet_num_slides_move'    => '',
            'mobile_num_slides'         => '',
            'mobile_num_slides_move'    => '',
            'adaptive_height'           => ''
        ), $atts ) );

        
        $output =   "
        [bit_testimonial
            id                        = '".$id."'
            class                     = '".$class."'
            theme_style               = '".$theme_style."'
            rating_stars              = '".$rating_stars."'
            is_slider                 = '".$is_slider."'
            is_arrows                 = '".$is_arrows."'
            is_dots                   = '".$is_dots."'
            is_autoplay               = '".$is_autoplay."'
            autoplay_speed            = '".$autoplay_speed."'
            is_pause_onhover          = '".$is_pause_onhover."'
            is_fade                   = '".$is_fade."'
            desktop_num_slides        = '".$desktop_num_slides."'
            desktop_num_slides_move   = '".$desktop_num_slides_move."'
            tablet_num_slides         = '".$tablet_num_slides."'
            tablet_num_slides_move    = '".$tablet_num_slides_move."'
            mobile_num_slides         = '".$mobile_num_slides."'
            mobile_num_slides_move    = '".$mobile_num_slides_move."'
            adaptive_height           = '".$adaptive_height."'
        ]";

        $id =
        ( $id    != '' ) ?
        'id="' . esc_attr( $id ) . '"' :
        '';

        $class =
        ( $class != '' ) ?
        'testimonial ' . esc_attr( $class ) :
        'testimonial';

        $theme_style =
        $theme_style != "" ?
        $theme_style :
        'testimonial-style-one-pro';

        $class .=
        $is_slider &&  ($theme_style == 'testimonial-style-two-pro') ?
        ' bit14-slider-pro' :
        '';

        $testimonial_category =
        $testimonial_category != "" && $testimonial_category != "all" ?
        $testimonial_category :
        '';

        $data_attributes =
        $is_arrows || ($theme_style == 'testimonial-style-two-pro') ?
        'data-arrows="true"' :
        'data-arrows="false"';


        $data_attributes .=
        $adaptive_height && ($theme_style == 'testimonial-style-two-pro') ?
        ' data-adaptive-height="true"' :
        ' data-adaptive-height="false"';

        $data_attributes .=
        $is_autoplay  &&  ($theme_style == 'testimonial-style-two-pro') ?
        ' data-autoplay="true"' :
        ' data-autoplay="false"';

        $data_attributes .=
        $autoplay_speed ?
        ' data-autoplay-speed="'.esc_attr($autoplay_speed).'"' :
        ' data-autoplay-speed="3000"';

        $data_attributes .=
        $is_pause_onhover  &&  ($theme_style == 'testimonial-style-two-pro') ?
        ' data-pause-onhover="true"' :
        ' data-pause-onhover="false"';


        if($theme_style == 'testimonial-style-two-pro'){
            $data_attributes .= 'data-display-columns="1"';
        } else if($theme_style == 'testimonial-style-one-pro'){
            $data_attributes .= 'data-display-columns="'.$desktop_num_slides.'"';
        }


        $data_attributes .=
        $tablet_num_slides ?
        ' data-tablet-display-columns="'.esc_attr($tablet_num_slides).'"' :
        ($theme_style == 'testimonial-style-two-pro') ?
            ' data-tablet-display-columns="1"' :
            ' data-tablet-display-columns="2"';


        $data_attributes .=
        $mobile_num_slides ?
        ' data-mobile-display-columns="'.esc_attr($mobile_num_slides).'"' :
        ($theme_style == 'testimonial-style-two-pro') ?
            ' data-mobile-columns="1"' :
            ' data-mobile-display-columns="1"';


        if ( $theme_style == 'testimonial-style-three-pro'){
            $desktop_num_slides = 2;
            $tablet_num_slides = 1;
            $mobile_num_slides = 1;
        }
        
        if(!empty($desktop_num_slides) && !empty($tablet_num_slides) && !empty($mobile_num_slides)){
            $col = 'col-md-'.(12/$desktop_num_slides).' col-sm-'.(12/$tablet_num_slides).' col-xs-'.(12/$mobile_num_slides);
        } else {
            $col = '';
        }


            $output = '<div id="bit-testimonials-pro" class="'.$theme_style.'">';
            $output .= '<div '.$id.' class="'.$class.' row" '.$data_attributes.'>';
            foreach($testimonials as $testimonial){
               
                $title = $testimonial['author_name'];

                 $author_url =
                        "<a target='_blank' href='". $testimonial['author_url'] ."'>" . $testimonial['author_url'] ."</a>";
                
                $author_company = $testimonial['author_company'];
                
                $author_position = $testimonial['author_details'];
                
                $content = $testimonial['testimonial'];
                
                $author_image_arr = wp_get_attachment_image_src($testimonial['author_image'],'medium');

                $author_image_alt = ($testimonial['author_image_alt'] != '') ? $testimonial['author_image_alt'] : 'author_image';

                $media =  '<img src="'.$author_image_arr[0].'" width="'.$author_image_arr[1].'" height="'.$author_image_arr[2].'" alt="'.$author_image_alt.'">';

                $ratings = $testimonial['rating_stars'];

                    $output .= '<div class="bit-testimonial-pro '. esc_attr($col) .'" style="display:inline-block;float:none;vertical-align:top;">';
                    $output .= '<div itemscope itemtype ="http://schema.org/Review" class="bit-testimonial-container-pro">';
                        /*==========
                         Theme One
                        ==========*/
                        if ( $theme_style == 'testimonial-style-one-pro' ){
                            // Content
                            if ( $content ){
                                $output .= ''.$content.'';
                            }
                            // Image
                            if ( $media ){
                                $output .= '<div itemprop="image" class="testimonial-author-image">'.$media.'</div>';
                            }
                            // Author Details
                            $output .= '<div itemscope itemtype ="http://schema.org/Person" class="testimonial-author-meta">';
                            if ( $title ){
                                $output .= '<span itemprop="givenName" class="testimonial-author-name">'.esc_html($title).'</span>';
                            }
                            if ( $author_position || $author_company || $author_url ){
                                $output .= '<span class="testimonial-author-details">';
                                $output .= '<span itemprop="jobTitle">' . $author_position . '</span>';
                                $output .= ($author_position && ($author_company || $author_url)) ? esc_html__( ', ', 'bit14' ) : ' ' ;
                                $output .= '<span itemprop="worksFor">' . $author_company . '</span>';
                                $output .= ($author_url) ? esc_html__( ', ', 'bit14' ) : ' ' ;
                                $output .= $author_url;
                                $output .= '</span>';
                            }
                            $output .= '</div>';

                        }

                        /*==========
                         Theme Two
                        ==========*/
                        elseif ( $theme_style == 'testimonial-style-two-pro' ){
                            // Content
                            if ( $content ){
                                $output .= ''.$content.'';
                            }
                            // Image
                            if ( $media ){
                                $theme_two_media .= '<div itemprop="image" class="testimonial-author-image">'.$media.'</div>';
                                if(!empty($get_description)){//If description is not empty show the div
                                    echo '<div class="featured_caption">' . $get_description . '</div>';
                                }
                            }else {
                                $theme_two_media .= '<div itemprop="image" class="testimonial-author-image"><img src="'.plugin_dir_url(__DIR__) .'assets/images/dummy-person.png" /></div>';
                            }
                            // Author Details
                            $output .= '<div itemscope itemtype ="http://schema.org/Person" class="testimonial-author-meta">';
                            if ( $title ){
                                $output .= '<span itemprop="givenName" class="testimonial-author-name">'.esc_html($title).'</span>';
                            }
                            if ( $author_position || $author_company || $author_url ){
                                $output .= '<span class="testimonial-author-details">';
                                $output .= '<span itemprop="jobTitle">' . $author_position . '</span>';
                                $output .= ($author_position && ($author_company || $author_url)) ? esc_html__( ' , ', 'bit14' ) : ' ' ;
                                $output .= '<span itemprop="worksFor">' . $author_company . '</span>';
                                $output .= ($author_company && $author_url) ? esc_html__( ' , ', 'bit14' ) : ' ' ;
                                $output .= $author_url;
                                $output .= '</span>';
                            }
                            $output .= '</div>';
                        }
                         /*==========
                         Theme Three
                        ==========*/
                        elseif ( $theme_style == 'testimonial-style-three-pro' ){
                            // Content
                            $stars = '';
                            for($i = 0; $i < 5; $i++){
                                if($i < $ratings){
                                    $stars .= '<i class="fa fa-star color"></i>';
                                } else {
                                    $stars .= '<i class="fa fa-star"></i>';
                                }
                            }
                            if ( $content ){
                                $output .= ''.$content.'';
                            }
                            
                            $output .= '<div class="bit-author-details">';

                                $output .= '<div class="author-details-three">';
                                    // Image
                                    if ( $media ){
                                        $output .= '<div itemprop="image" class="testimonial-author-image">'.$media.'</div>';
                                        if(!empty($get_description)){//If description is not empty show the div
                                            echo '<div class="featured_caption">' . $get_description . '</div>';
                                        }
                                    }
                                    // Author Details
                                    $output .= '<div itemscope itemtype ="http://schema.org/Person" class="testimonial-author-meta">';
                                    if ( $title ){
                                        $output .= '<span itemprop="givenName" class="testimonial-author-name">'.esc_html($title).'</span>';
                                    }
                                    if ( $author_position || $author_company || $author_url ){
                                        $output .= '<span class="testimonial-author-details">';
                                        $output .= '<span itemprop="jobTitle">' . $author_position . '</span>';
                                        $output .= ($author_position && ($author_company || $author_url)) ? esc_html__( ' , ', 'bit14' ) : ' ' ;
                                        $output .= '<span itemprop="worksFor">' . $author_company . '</span>';
                                        // $output .= ($author_company && $author_url) ? esc_html__( ' , ', 'bit14' ) : ' ' ;
                                        // $output .= $author_url;
                                        $output .= '</span>';
                                    }
                                    $output .= '</div>';
                                $output .= '</div>';
                                $output .= '<div class="rating-stars-three middle-stars">';
                                    $output .= $stars;
                                $output .= '</div>';
                            $output .= '</div>';
                        }



                     $output .= '</div>';
                $output .= '</div>';

            }
            $output .= "</div>";
            /*==========
             Theme Two Thumbnails
            ==========*/
            if ( $theme_style == 'testimonial-style-two-pro' && $theme_two_media ){
                $output .= '<div class="bit14-thumbnail">';
                    $output .= $theme_two_media;
                $output .= '</div>';
            }
        $output .= "</div>";

       $output .= wp_enqueue_style( 'pro-bit14-vc-addons-team', assets_url.'css/team.css', false );        
        $output .=wp_enqueue_style( 'pro-bit14-vc-addons-testimonial-pro', assets_url.'css/testimonial-pro.css', false );
        $output .= wp_enqueue_script( 'pro-bit14-vc-addons-testimonial', assets_url.'js/script.js', array('jquery'), false, true );
            return $output;
    
    }
}

new WPBakeryShortCode_Bit14_Testimonial_Lists;
