<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class WPBakeryShortCode_mvc_advanced_button extends WPBakeryShortCode {

	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'btn_animation' => 'hvr-fade',
			'align' => 'left',
			'padding_top' => '10',
			'padding_left' => '25',
			'btn_block' => '',
			'btn_radius' => '',
			'btn_next' => '',
			'btn_url' => '',
			'btn_text' => 'Click Me!',
			'btn_text2' => '',
			'btn_size' => '18',
			'btn_icon' => '',
			'btn_border' => '',
			'border_width' => '0',
			'btn_clr' => '#000',
			'btn_bg' => '#1e73be',
			'btn_hvrclr' => '#fff',
			'btn_hvrbg' => '',
		), $atts ) );
		$some_id = rand(5, 500);
		$btn_url = vc_build_link($btn_url);
		wp_enqueue_style( 'advanced-button-css', plugins_url( '../css/advanced-buttons.css' , __FILE__ ));
		$content = wpb_js_remove_wpautop($content, true);
		ob_start(); ?>
		
		<div style="justify-content: <?php echo $align; ?>; display: flex;">
			<?php if ($btn_animation == 'button--winona' || $btn_animation == 'hvr-fade') { ?>
				<a href="<?php echo esc_url($btn_url['url']); ?>" target="<?php echo $btn_url['target']; ?>" title="<?php echo esc_html($btn_url['title']); ?>" class="mega-uae-btn mega-uae-btn-<?php echo $some_id; ?> <?php echo $btn_animation; ?> <?php echo $btn_block; ?>" style="color: <?php echo $btn_clr; ?>;background: <?php echo $btn_bg; ?> ; border: <?php echo $border_width; ?>px solid <?php echo $btn_border ?>; border-radius: <?php echo $btn_radius; ?>px; font-size: <?php echo $btn_size; ?>px; padding: <?php echo $padding_top; ?>px <?php echo $padding_left; ?>px;" data-text=""> 
					<span><i style="padding-right: 5px;" class="<?php echo $btn_icon; ?>"> </i> <?php echo $btn_text; ?></span>			
					<span style="background: <?php echo $btn_hvrbg; ?>; padding: <?php echo $padding_top; ?>px 0; color: <?php echo $btn_hvrclr; ?>;" class="advanced-btn-after"><?php echo $btn_text2; ?></span>
				</a>
				<div style="clear: both;"></div>
			<?php } ?>

			<?php if ($btn_animation == 'button--rayen' || $btn_animation == 'button--moema' || $btn_animation == 'button--ujarak' || $btn_animation == 'button--wayra' || $btn_animation == 'button--isi' || $btn_animation == 'button--wapasha') { ?>
				<a href="<?php echo esc_url($btn_url['url']); ?>" target="<?php echo $btn_url['target']; ?>" title="<?php echo esc_html($btn_url['title']); ?>" class="mega-uae-btn mega-uae-btn-<?php echo $some_id; ?> <?php echo $btn_animation; ?> <?php echo $btn_block; ?>" style="color: <?php echo $btn_clr; ?>;background: <?php echo $btn_bg; ?> ; border: <?php echo $border_width; ?>px solid <?php echo $btn_border ?>; border-radius: <?php echo $btn_radius; ?>px; font-size: <?php echo $btn_size; ?>px; padding: <?php echo $padding_top; ?>px <?php echo $padding_left; ?>px;" data-text=""> 
					<span style="background: <?php echo $btn_hvrbg; ?>; padding: <?php echo $padding_top; ?>px 0; color: <?php echo $btn_hvrclr; ?>;" class="advanced-btn-before"><?php echo $btn_text2; ?></span>
					<span><i style="padding-right: 5px;" class="<?php echo $btn_icon; ?>"> </i> <?php echo $btn_text; ?></span>			
				</a>
				<div style="clear: both;"></div>
			<?php } ?>

			<?php if ($btn_animation == 'button--pipaluk' || $btn_animation == 'button--aylen' || $btn_animation == 'button--nuka' || $btn_animation == 'button--antiman' || $btn_animation == 'button--shikoba' || $btn_animation == 'button--itzel') { ?>
				<a href="<?php echo esc_url($btn_url['url']); ?>" target="<?php echo $btn_url['target']; ?>" title="<?php echo esc_html($btn_url['title']); ?>" class="mega-uae-btn mega-uae-btn-<?php echo $some_id; ?> <?php echo $btn_animation; ?> <?php echo $btn_block; ?>" style="color: <?php echo $btn_clr; ?>; border-radius: <?php echo $btn_radius; ?>px; font-size: <?php echo $btn_size; ?>px; padding: <?php echo $padding_top; ?>px <?php echo $padding_left; ?>px;" data-text="">
					<i style="padding-right: 5px;" class="<?php echo $btn_icon; ?> button__icon"> </i>
					<span><?php echo $btn_text; ?></span>
				</a>
				<div style="clear: both;"></div>
			<?php } ?>

			<?php if ($btn_animation == 'button--tamaya') { ?>
				<a href="<?php echo esc_url($btn_url['url']); ?>" target="<?php echo $btn_url['target']; ?>" title="<?php echo esc_html($btn_url['title']); ?>" class="mega-uae-btn mega-uae-btn-<?php echo $some_id; ?> <?php echo $btn_animation; ?> <?php echo $btn_block; ?>" style="color: <?php echo $btn_clr; ?>; border: <?php echo $border_width; ?>px solid <?php echo $btn_border ?>; border-radius: <?php echo $btn_radius; ?>px; font-size: <?php echo $btn_size; ?>px; padding: <?php echo $padding_top; ?>px <?php echo $padding_left; ?>px;" data-text="<?php echo $btn_text ?>">					
					<span><?php echo $btn_text2; ?></span>
				</a>
				<div style="clear: both;"></div>
			<?php } ?>
		</div>
		<style> 
			.mega-uae-btn-<?php echo $some_id; ?>.button--wapasha:hover, 
			.mega-uae-btn-<?php echo $some_id; ?>.hvr-fade:hover, 
			.mega-uae-btn-<?php echo $some_id; ?>.button--moema:hover {
				background: <?php echo $btn_hvrbg; ?> !important;
				color: <?php echo $btn_hvrclr; ?> !important;
			}
			.mega-uae-btn-<?php echo $some_id; ?>.button--antiman:hover,
			.mega-uae-btn-<?php echo $some_id; ?>.button--nuka:hover,
			.mega-uae-btn-<?php echo $some_id; ?>.button--aylen:hover,
			.mega-uae-btn-<?php echo $some_id; ?>.button--isi:hover,
			.mega-uae-btn-<?php echo $some_id; ?>.button--pipaluk:hover,
			.mega-uae-btn-<?php echo $some_id; ?>.button--ujarak:hover,
			.mega-uae-btn-<?php echo $some_id; ?>.button--wayra:hover {
				color: <?php echo $btn_hvrclr; ?> !important;
			}
			.mega-uae-btn-<?php echo $some_id; ?>.button--isi::before{
				background: <?php echo $btn_hvrbg; ?> !important;
			}
			.mega-uae-btn-<?php echo $some_id; ?>.button--pipaluk::before,
			.mega-uae-btn-<?php echo $some_id; ?>.button--wapasha::before{
				border-color: <?php echo $btn_border ?> !important;
			}
			.mega-uae-btn-<?php echo $some_id; ?>.button--pipaluk::after{
				background: <?php echo $btn_bg; ?> !important;
				color: <?php echo $btn_clr; ?> !important;
			}
			.mega-uae-btn-<?php echo $some_id; ?>.button--pipaluk:hover::after {
				background: <?php echo $btn_hvrbg; ?> !important;
			}
			.mega-uae-btn-<?php echo $some_id; ?>.button--aylen{
				background: <?php echo $btn_bg; ?> !important;
				color: <?php echo $btn_clr; ?> !important;
			}
			.mega-uae-btn-<?php echo $some_id; ?>.button--aylen::before,
			.mega-uae-btn-<?php echo $some_id; ?>.button--aylen::after{
				background: <?php echo $btn_hvrbg; ?> !important;
			}

			/*Nuka Style CSS*/
			<?php if ($btn_animation == 'button--nuka'): ?>
				.mega-uae-btn-<?php echo $some_id; ?>.button--nuka::before{
					background: <?php echo $btn_border; ?> !important;
				}
				.mega-uae-btn-<?php echo $some_id; ?>.button--nuka::after{
					background: <?php echo $btn_bg; ?> !important;
					color: <?php echo $btn_clr; ?> !important;
				}
				.mega-uae-btn-<?php echo $some_id; ?>.button--nuka:hover::after{
					background: <?php echo $btn_hvrbg; ?> !important;
				}
			<?php endif ?>

			/*Antiman Style CSS*/
			<?php if ($btn_animation == 'button--antiman'): ?>
				.mega-uae-btn-<?php echo $some_id; ?>.button--antiman::after {
					background: <?php echo $btn_bg; ?> !important;
				}
				.mega-uae-btn-<?php echo $some_id; ?>.button--antiman::before {
					background: <?php echo $btn_hvrbg; ?> !important;
					border: 2px solid <?php echo $btn_border ?> !important;
				}
			<?php endif ?>

			/*Shikoba Style CSS*/
			<?php if ($btn_animation == 'button--shikoba'): ?>
				.mega-uae-btn-<?php echo $some_id; ?>.button--shikoba {
					background: <?php echo $btn_bg; ?> !important;
					border: 2px solid <?php echo $btn_border ?> !important;
				}
				.mega-uae-btn-<?php echo $some_id; ?>.button--shikoba:hover {
					background: <?php echo $btn_hvrbg; ?> !important;
				}
				.mega-uae-btn-<?php echo $some_id; ?>.button--shikoba i {
					padding-top: <?php echo $padding_top; ?>px !important;
				}
			<?php endif ?>

			/*Tamaya Style CSS*/
			<?php if ($btn_animation == 'button--tamaya'): ?>
				.mega-uae-btn-<?php echo $some_id; ?>.button--tamaya {
					text-align: center;
				}
				.mega-uae-btn-<?php echo $some_id; ?>.button--tamaya::before {
					padding-top: <?php echo $padding_top; ?>px !important;
				}
				.mega-uae-btn-<?php echo $some_id; ?>.button--tamaya::after, .mega-uae-btn-<?php echo $some_id; ?>.button--tamaya::before {
					background: <?php echo $btn_bg; ?> !important;
				}
				.mega-uae-btn-<?php echo $some_id; ?>.button--tamaya:hover {
					background: <?php echo $btn_hvrbg; ?> !important;
				}
			}
			<?php endif ?>
		</style>

		<?php
		return ob_get_clean();
	}
}


vc_map( array(
	"name" 			=> __( 'Advanced Button', 'button' ),
	"base" 			=> "mvc_advanced_button",
	"category" 		=> __('Mega Addons'),
	"description" 	=> __('Animated style buttons', 'button'),
	"icon" => plugin_dir_url( __FILE__ ).'../icons/hoverbutton.png',
	'params' => array(
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Button Effects', 'button' ),
			"param_name" 	=> 	"btn_animation",
			"description" 	=> __( 'Choose button style <a href="http://addons.topdigitaltrends.net/advanced-button/">See Demo</a>', 'button' ),
			"group" 		=> 	'General',
			"value"			=>	array(
				"Fade"				=>	"hvr-fade",
				"Winona"			=>	"button--winona",
				"Rayen"				=>	"button--rayen",
				"Ujarak"			=>	"button--ujarak",
				"Wayra"				=>	"button--wayra",
				"Pipaluk"			=>	"button--pipaluk",
				"Isi"				=>	"button--isi",
				"Aylen"				=>	"button--aylen",
				"Wapasha"			=>	"button--wapasha",
				"Nuka"				=>	"button--nuka",
				"Antiman"			=>	"button--antiman",
				// "Itzel"				=>	"button--itzel",
				// "Naira"				=>	"button--naira",
				// "Quidel"			=>	"button--quidel",
				"Shikoba"			=>	"button--shikoba",
			)
		),
		array(
			"type" 			=> 	"dropdown",
			"heading" 		=> 	__( 'Button Align', 'button' ),
			"param_name" 	=> 	"align",
			"group" 		=> 	'General',
			"value"			=>	array(
				"Left"			=>	"left",
				"Center"		=>	"center",
			)
		),
		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Padding [Top Bottom]', 'button' ),
			"param_name" 	=> "padding_top",
			"description" 	=> __( 'It will increase height of button e.g 10', 'button' ),
			"value"			=>	"10",
			"suffix" 		=> 'px',
			"group" 		=> 'General',
		),
		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Padding [Left Right]', 'button' ),
			"param_name" 	=> "padding_left",
			"description" 	=> __( 'It will increase width of button e.g 20', 'button' ),
			"value"			=>	"25",
			"suffix" 		=> 'px',
			"group" 		=> 'General',
		),
		array(
			"type" 			=> 	"checkbox",
			"heading" 		=> 	__( 'Set Full Width Button?', 'button' ),
			"param_name" 	=> 	"btn_block",
			"group" 		=> 	'General',
			"value" 		=> array(
				"Enable"		=> "btn_block",
			)
		),
		array(
			"type" 			=> "vc_link",
			"heading" 		=> __( 'Button URL', 'button' ),
			"param_name" 	=> "btn_url",
			"description" 	=> __( 'Write button url as link', 'button' ),
			"group" 		=> 'General',
		),
		array(
			"type" 			=> "vc_links",
			"param_name" 	=> "caption_url",
			"class"			=>	"ult_param_heading",
			"description" 	=> __( '<span style="Background: #ddd;padding: 10px; display: block; color: #0073aa;font-weight:600;"><a href="https://1.envato.market/02aNL" target="_blank" style="text-decoration: none;">Get the Pro version for more stunning elements and customization options.</a></span>', 'ihover' ),
			"group" 		=> 'General',
		),
		array(
			"type" 			=> "iconpicker",
			"heading" 		=> __( 'Select icon', 'button' ),
			"param_name" 	=> "btn_icon",
			"description" 	=> __( 'it will be show within text', 'button' ),
			"group" 		=> 'Text',
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( 'Button text', 'button' ),
			"param_name" 	=> "btn_text",
			"description" 	=> __( 'Write button text', 'button' ),
			"group" 		=> 'Text',
		),
		array(
			"type" 			=> "textfield",
			"heading" 		=> __( 'Button text 2', 'button' ),
			"param_name" 	=> "btn_text2",
			"description" 	=> 	__( 'it will show on hover', 'modal_popup' ),
			"dependency" => array('element' => "btn_animation", 'value' => array('button--winona', 'button--rayen', 'button--tamaya')),
			"group" 		=> 'Text',
		),
		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Text font size', 'button' ),
			"param_name" 	=> "btn_size",
			"description" 	=> __( 'Set font size in pixel e.g 18', 'button' ),
			"value"			=>	"18",
			"suffix" 		=> 'px',
			"group" 		=> 'Text',
		),

		/** border **/

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Border color', 'button' ),
			"param_name" 	=> "btn_border",
			"description" 	=> __( 'Set color of border e.g #269CE9', 'button' ),
			"group" 		=> 'Border',
		),
		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Border width', 'button' ),
			"param_name" 	=> "border_width",
			"description" 	=> __( 'Set width of border in pixel e.g 1', 'button' ),
			"value"			=>	"0",
			"suffix" 		=> 'px',
			"group" 		=> 'Border',
		),
		array(
			"type" 			=> "vc_number",
			"heading" 		=> __( 'Radius', 'button' ),
			"param_name" 	=> "btn_radius",
			"description" 	=> __( 'set button radius e.g 5', 'button' ),
			"suffix" 		=> 'px',
			"group" 		=> 'Border',
		),


		/** color **/

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Text color', 'button' ),
			"param_name" 	=> "btn_clr",
			"description" 	=> __( 'Set color of text e.g #ffff', 'button' ),
			"group" 		=> 'Color',
		),

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Background color', 'button' ),
			"param_name" 	=> "btn_bg",
			"description" 	=> __( 'Set color of background e.g #269CE9', 'button' ),
			"group" 		=> 'Color',
		),

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Hover Text color', 'button' ),
			"param_name" 	=> "btn_hvrclr",
			"description" 	=> __( 'Set color of text on hover e.g #ffff', 'button' ),
			"group" 		=> 'Color',
		),

		array(
			"type" 			=> "colorpicker",
			"heading" 		=> __( 'Background color', 'button' ),
			"param_name" 	=> "btn_hvrbg",
			"description" 	=> __( 'Set color of background on hover e.g #269CE9', 'button' ),
			"group" 		=> 'Color',
		),
	),
) );

