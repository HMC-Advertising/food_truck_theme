<?php 
$site_title = get_bloginfo('name');
$site_description = get_bloginfo( 'description' );
$df_logo = esc_url(df_options('logo'));

 ?>
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

 <div class="<?php df_navibar_class(); ?>">
 	<div class="df-navibar-inner">
		<div class="site-branding">
			<h1 class="site-title hide">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php df_sitename_class(); ?>" rel="home"><?php $site_title ; ?></a>
			</h1>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php df_sitename_class(); ?>" rel="home"> <?php echo ( $df_logo == '' ) ? $site_title : '<img src="' . $df_logo . '" alt="' . $site_description . '">'; ?></a>
		</div>

		<?php df_mobile_menu_header(); ?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<!-- <h1 class="menu-toggle"><?php _e( 'Menu', 'dahztheme' ); ?></h1> -->
                <?php 
                df_navbar_menu( array(
                    'menu_wraper'       => '<ul id="classic-main-nav" class="df-navi">%MENU_ITEMS%' . "\n" . '</ul>',
                    'menu_items'        =>  "\n" . '<li class="%ITEM_CLASS%"><a href="%ITEM_HREF%"%ESC_ITEM_TITLE%>%ICON%<span>%ITEM_TITLE%%SPAN_DESCRIPTION%</span></a>%SUBMENU%</li> ',
                    'submenu'           => '<ul class="sub-nav df_row-fluid">%ITEM%</ul>',
                    'params'            => array( 'act_class' => 'act', 'please_be_mega_menu' => true ),
                ) ); 
                ?>
		</nav><!-- #site-navigation -->

	    <div class="site-module">
			<a class="top-search default-top-search" href="#"><i class="fa fa-search"></i></a>

      <?php
            // WooCommerce Topbar // mod-woocommerce/wc-mini-cart.php 
            if(is_woocommerce_activated()){ echo df_woocommerce_add_nav_cart_link(); }
            ?>

		</div> 

	</div>
</div><!-- .df-navibar -->
