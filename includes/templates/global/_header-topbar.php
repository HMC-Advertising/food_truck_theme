<?php /*topbar*/ ?>
<div class="universe-search">
  <div class="universe-search-close ent-text"></div>
  <div class="df_container-fluid col-full">
    <div class="universe-search-form">
 
        <input type="text" id="searchfrm" name="search" class="universe-search-input" placeholder="<?php _e('Start typing to get your search on...', 'dahztheme'); ?>" value="" style="background-color: transparent; background-position: initial initial; background-repeat: initial initial;" autocomplete="off" spellcheck="false" dir="ltr"> 
 
    </div>
      <div id="jp-container-search" class="jp-container-search">
          <div class="universe-search-results"></div>
      </div>
  </div>
</div>
<?php if( df_options('header_topbar') == 1): ?>
<?php 
   if (class_exists('UberMenu')) {
      echo "<div class='uber-topbar-active'><i class='fa fa-navicon'></i></div>";
   }
?>


<div class="df-topbar">
	<div class="df_container-fluid">
	  <div class="col-left">
        <div class="df-topbar-left">
          <div class="ubermenu-mobile-active">
             <?php 
            if (class_exists('UberMenu')) {
                if(is_woocommerce_activated()){ 
                  echo df_woocommerce_add_nav_cart_link(); 
                }
                ?>
            <?php } ?>
          <div class="clear"></div>
          </div>
      	  <?php df_social_connect(); ?>
      	  <?php
           $df_topbar_content = esc_attr(df_options( 'header_topbar_content' ));
           if (function_exists('icl_register_string')) {icl_register_string('AZ Topbar Content', 'topbar text – ' . $df_topbar_content, $df_topbar_content ); } 
              $icl_t = function_exists('icl_t'); 
              $topbar_text = $icl_t ? icl_t('AZ Topbar Content', 'topbar text – ' . $df_topbar_content, $df_topbar_content) : $df_topbar_content;
            if ( $df_topbar_content != '' ) : ?>
            <p class="info-description"><?php echo stripslashes($topbar_text); ?></p>
            <?php endif; ?>
        </div>
      </div>

      <div class="col-right">
        <ul class="df-topbar-right">

            <?php

            // top menu
            if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'top-menu' ) ) {
                  echo "<li>";
                  wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'top-navigation', 'theme_location' => 'top-menu' ) );
                  echo "</li>";
            }
             // WooCommerce Topbar // mod-woocommerce/wc-mini-cart.php 

              if(is_woocommerce_activated()){ 
                echo "<li>";
                echo df_woocommerce_add_nav_cart_link(); 
                echo "</li>";
              }
              ?>
                <li>
                   <a class="top-search default-top-search" href="#"><i class="fa fa-search"></i></a>
                </li>
              <?php 
              if (class_exists('UberMenu')) {
                ?>
                  <form role="search" method="get" id="searchform" class="searchform mobile-uber-menu-search" action="<?php esc_url( home_url( '/' ) ); ?>">
                      <div>
                          <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label', 'dahztheme' ); ?></label>
                          <input type="text" value="<?php echo esc_attr(get_search_query()); ?>" name="s" id="s" placeholder="<?php _e('search','dahztheme');?>" />
                      </div>
                  </form>
                <?php 
              }

            // booking top bar
            if (class_exists('Dahzhotelbooking') && df_options('hotel_reservation_top')) {
                  echo "<li class='booking-topbar-desktop'>";
                  echo do_shortcode('[booking_form_top_bar]');
                  echo "</li>";
            }
            if (class_exists('Dahzhotelbooking') && df_options('hotel_reservation_top') && class_exists('UberMenu')) {
                  echo "<li class='menu-uber-li-reservation'>";
                   echo '<a href="'. esc_url(df_options('hotel_link_booking_mobile')).'" class="menu-uber-reservation"><span class=" button">'._x('Reservation', 'dahztheme').'</span></a>';
                  echo "</li>";
            }
            ?>
        </ul>
      </div>	
	</div>
</div>
<?php endif; ?>