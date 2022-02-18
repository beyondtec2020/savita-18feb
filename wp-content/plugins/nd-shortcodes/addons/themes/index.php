<?php


if ( get_option('nicdark_theme_author') != 1 ){

  add_action('admin_menu', 'nd_options_create_themes_menu');
  function nd_options_create_themes_menu() {
    
    /*1*/
    add_menu_page( __('WP Themes','nd-shortcodes'), __('WP Themes','nd-shortcodes'), 'manage_options', 'nd-shortcodes-themes', 'nd_options_themes_menu_page', 'dashicons-cart' );

  }


  //START add custom css
  function nd_options_admin_style_for_theme_page() {
    
    wp_enqueue_style( 'nd_options_style_theme_page', esc_url( plugins_url( 'admin-style.css', __FILE__ ) ), array(), false, false );
    
  }
  add_action( 'admin_enqueue_scripts', 'nd_options_admin_style_for_theme_page' );
  //END add custom css




  /*1 - page*/
  function nd_options_themes_menu_page() {
  ?>


    
    <div class="wrap">
      
      <h1 class="nd_options_margin_bottom_15_important">
        <?php _e('Themes','nd-shortcodes'); ?>
        <span class="nd_options_margin_left_10 title-count theme-count">10</span>
      </h1>

      <div class="theme-browser rendered">
        <div class="themes wp-clearfix">


          <!--theme-->
          <div class="theme">

            <div class="theme-screenshot">
              <img src="<?php echo esc_url(plugins_url('img/ristorante.jpg', __FILE__ )); ?>" alt="">
            </div>

            <span class="more-details"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-shortcodes">Theme Details</a></span>
          
            <div class="theme-author">By Nicdark </div>

            <div class="theme-id-container">
              
              <h2 class="theme-name">Restaurant</h2>

              <div class="theme-actions">
                <a target="_blank" class="button activate" href="http://www.nicdarkthemes.com/themes/restaurant/wp/demo/intro/?action=nd-shortcodes">Demo</a>
                <a target="_blank" class="button button-primary" href="https://themeforest.net/item/ristorante-restaurant-wordpress-theme/23195638?ref=nicdark">Purchase</a>
              </div>
          
            </div>
          
          </div>
          <!--theme-->




          <!--theme-->
          <div class="theme">

            <div class="theme-screenshot">
              <img src="<?php echo esc_url(plugins_url('img/hotel-booking.jpg', __FILE__ )); ?>" alt="">
            </div>

            <span class="more-details"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://www.nicdarkthemes.com/themes/hotel/wp/demo/intro/?action=nd-shortcodes">Theme Details</a></span>
          
            <div class="theme-author">By Nicdark </div>

            <div class="theme-id-container">
              
              <h2 class="theme-name">Hotel Booking</h2>

              <div class="theme-actions">
                <a target="_blank" class="button activate" href="http://www.nicdarkthemes.com/themes/hotel/wp/demo/intro/?action=nd-shortcodes">Demo</a>
                <a target="_blank" class="button button-primary" href="https://themeforest.net/item/hotel-booking-hotel-wordpress-theme/20522335?ref=nicdark">Purchase</a>
              </div>
          
            </div>
          
          </div>
          <!--theme-->



          <!--theme-->
          <div class="theme">

            <div class="theme-screenshot">
              <img src="<?php echo esc_url(plugins_url('img/charity-foundation.jpg', __FILE__ )); ?>" alt="">
            </div>

            <span class="more-details"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://www.nicdarkthemes.com/themes/charity/wp/demo/intro/?action=nd-shortcodes">Theme Details</a></span>
          
            <div class="theme-author">By Nicdark </div>

            <div class="theme-id-container">
              
              <h2 class="theme-name">Charity Foundation</h2>

              <div class="theme-actions">
                <a target="_blank" class="button activate" href="http://www.nicdarkthemes.com/themes/charity/wp/demo/intro/?action=nd-shortcodes">Demo</a>
                <a target="_blank" class="button button-primary" href="https://themeforest.net/item/charity-foundation-charity-hub-wp-theme/19763204?ref=nicdark">Purchase</a>
              </div>
          
            </div>
          
          </div>
          <!--theme-->



          <!--theme-->
          <div class="theme">

            <div class="theme-screenshot">
              <img src="<?php echo esc_url(plugins_url('img/beauty-pack.jpg', __FILE__ )); ?>" alt="">
            </div>

            <span class="more-details"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://www.nicdarkthemes.com/themes/beauty/wp/demo/intro/?action=nd-shortcodes">Theme Details</a></span>
          
            <div class="theme-author">By Nicdark </div>

            <div class="theme-id-container">
              
              <h2 class="theme-name">Beauty Pack</h2>

              <div class="theme-actions">
                <a target="_blank" class="button activate" href="http://www.nicdarkthemes.com/themes/beauty/wp/demo/intro/?action=nd-shortcodes">Demo</a>
                <a target="_blank" class="button button-primary" href="https://themeforest.net/item/health-beauty-wp-theme-for-beauty-business/18150388?ref=nicdark">Purchase</a>
              </div>
          
            </div>
          
          </div>
          <!--theme-->



          <!--theme-->
          <div class="theme">

            <div class="theme-screenshot">
              <img src="<?php echo esc_url(plugins_url('img/education-pack.jpg', __FILE__ )); ?>" alt="">
            </div>

            <span class="more-details"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://www.nicdarkthemes.com/themes/education/wp/demo/intro/?action=nd-shortcodes">Theme Details</a></span>
          
            <div class="theme-author">By Nicdark </div>

            <div class="theme-id-container">
              
              <h2 class="theme-name">Education Pack</h2>

              <div class="theme-actions">
                <a target="_blank" class="button activate" href="http://www.nicdarkthemes.com/themes/education/wp/demo/intro/?action=nd-shortcodes">Demo</a>
                <a target="_blank" class="button button-primary" href="https://themeforest.net/item/education-pack-education-learning-theme-wp/16649896?ref=nicdark">Purchase</a>
              </div>
          
            </div>
          
          </div>
          <!--theme-->



          <!--theme-->
          <div class="theme">

            <div class="theme-screenshot">
              <img src="<?php echo esc_url(plugins_url('img/camping-village.jpg', __FILE__ )); ?>" alt="">
            </div>

            <span class="more-details"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://www.nicdarkthemes.com/themes/camping/wp/demo/?action=nd-shortcodes">Theme Details</a></span>
          
            <div class="theme-author">By Nicdark </div>

            <div class="theme-id-container">
              
              <h2 class="theme-name">Camping Village</h2>

              <div class="theme-actions">
                <a target="_blank" class="button activate" href="http://www.nicdarkthemes.com/themes/camping/wp/demo/?action=nd-shortcodes">Demo</a>
                <a target="_blank" class="button button-primary" href="https://themeforest.net/item/camping-village-campground-caravan-hiking-tent-accommodation-wp/14950641?ref=nicdark">Purchase</a>
              </div>
          
            </div>
          
          </div>
          <!--theme-->



          <!--theme-->
          <div class="theme">

            <div class="theme-screenshot">
              <img src="<?php echo esc_url(plugins_url('img/wedding-industry.jpg', __FILE__ )); ?>" alt="">
            </div>

            <span class="more-details"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://www.nicdarkthemes.com/themes/wedding/wp/demo/intro/?action=nd-shortcodes">Theme Details</a></span>
          
            <div class="theme-author">By Nicdark </div>

            <div class="theme-id-container">
              
              <h2 class="theme-name">Wedding Industry</h2>

              <div class="theme-actions">
                <a target="_blank" class="button activate" href="http://www.nicdarkthemes.com/themes/wedding/wp/demo/intro/?action=nd-shortcodes">Demo</a>
                <a target="_blank" class="button button-primary" href="https://themeforest.net/item/wedding-industry-wedding-multipurpose-couple-wp/12744555?ref=nicdark">Purchase</a>
              </div>
          
            </div>
          
          </div>
          <!--theme-->



          <!--theme-->
          <div class="theme">

            <div class="theme-screenshot">
              <img src="<?php echo esc_url(plugins_url('img/baby-kids.jpg', __FILE__ )); ?>" alt="">
            </div>

            <span class="more-details"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://www.nicdarkthemes.com/themes/children/wp/demo/?action=nd-shortcodes">Theme Details</a></span>
          
            <div class="theme-author">By Nicdark </div>

            <div class="theme-id-container">
              
              <h2 class="theme-name">Baby Kids</h2>

              <div class="theme-actions">
                <a target="_blank" class="button activate" href="http://www.nicdarkthemes.com/themes/children/wp/demo/?action=nd-shortcodes">Demo</a>
                <a target="_blank" class="button button-primary" href="https://themeforest.net/item/baby-kids-education-primary-school-for-children/10240657?ref=nicdark">Purchase</a>
              </div>
          
            </div>
          
          </div>
          <!--theme-->



          <!--theme-->
          <div class="theme">

            <div class="theme-screenshot">
              <img src="<?php echo esc_url(plugins_url('img/sweet-cake.jpg', __FILE__ )); ?>" alt="">
            </div>

            <span class="more-details"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://www.nicdarkthemes.com/themes/food/wp/demo/sweet-cake/?action=nd-shortcodes">Theme Details</a></span>
          
            <div class="theme-author">By Nicdark </div>

            <div class="theme-id-container">
              
              <h2 class="theme-name">Sweet Cake</h2>

              <div class="theme-actions">
                <a target="_blank" class="button activate" href="http://www.nicdarkthemes.com/themes/food/wp/demo/sweet-cake/?action=nd-shortcodes">Demo</a>
                <a target="_blank" class="button button-primary" href="https://themeforest.net/item/sweet-cake-wp-theme-for-bakery-yogurt-chocolate-coffee-shop/5514731?ref=nicdark">Purchase</a>
              </div>
          
            </div>
          
          </div>
          <!--theme-->



          <!--theme-->
          <div class="theme">

            <div class="theme-screenshot">
              <img src="<?php echo esc_url(plugins_url('img/love-travel.jpg', __FILE__ )); ?>" alt="">
            </div>

            <span class="more-details"><a style="color:#fff; text-decoration:none;" target="_blank" href="http://www.nicdarkthemes.com/themes/travel/wp/demo/intro/?action=nd-shortcodes">Theme Details</a></span>
          
            <div class="theme-author">By Nicdark </div>

            <div class="theme-id-container">
              
              <h2 class="theme-name">Love Travel</h2>

              <div class="theme-actions">
                <a target="_blank" class="button activate" href="http://www.nicdarkthemes.com/themes/travel/wp/demo/intro/?action=nd-shortcodes">Demo</a>
                <a target="_blank" class="button button-primary" href="https://themeforest.net/item/love-travel-creative-travel-agency-wordpress/7704831?ref=nicdark">Purchase</a>
              </div>
          
            </div>
          
          </div>
          <!--theme-->


          

        </div>
      </div>

    </div>


  <?php } 
  /*END 1*/

}
