<?php 
$site_title = get_bloginfo('name');
$site_description = get_bloginfo( 'description' );
$df_logo = esc_url(df_options('logo'));
$df_logo_mobile = esc_url(df_options('mobile_logo'));
$header_navbar_position = df_options('header_navbar_position');
?>

<?php
if( $header_navbar_position == 'classic-left' || $header_navbar_position == 'classic-right'  ) : 

 df_get_template( 'global', '_header-navbar-classic' ); 

 else :

 	$page_landing = is_page_template('template-landing.php') ;
if($page_landing){
	$df_logo_target_link = get_post_meta( $post->ID, 'df_metabox_logo_link', true );
} else {
	$df_logo_target_link = home_url( '/' );
}
 ?>
<?php df_get_template( 'global', '_header-topbar' ); ?>  

 <div class="<?php df_navibar_class(); ?>">
 	<div class="df-navibar-inner df_container-fluid">
		<div class="site-branding">
			<h1 class="site-title hide">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php df_sitename_class(); ?>" rel="home"><?php $site_title ; ?></a>
			</h1>
			<?php if(is_front_page()): ?>
			<a href="<?php echo esc_url( $df_logo_target_link ); ?>" class="<?php df_sitename_class(); ?>" rel="home"> <?php echo ( $df_logo == '' ) ? $site_title : '<img src="http://goodfoodtruckvt.org/wp/wp-content/uploads/2015/06/GFT_logo_KO.png" alt="' . $site_description . '">'; ?></a>
			<a href="<?php echo esc_url( $df_logo_target_link ); ?>" class="<?php df_sitename_class(); ?> mobile-logo" rel="home"> <?php echo ( $df_logo_mobile == '' ) ? $site_title : '<img src="http://goodfoodtruckvt.org/wp/wp-content/uploads/2015/06/GFT_logo_KO.png" alt="' . $site_description . '">'; ?></a>
		<?php else: ?>
			<a href="<?php echo esc_url( $df_logo_target_link ); ?>" class="<?php df_sitename_class(); ?>" rel="home"> <?php echo ( $df_logo == '' ) ? $site_title : '<img src="' . esc_url($df_logo) . '" alt="' . $site_description . '">'; ?></a>
			<a href="<?php echo esc_url( $df_logo_target_link ); ?>" class="<?php df_sitename_class(); ?> mobile-logo" rel="home"> <?php echo ( $df_logo_mobile == '' ) ? $site_title : '<img src="' . esc_url($df_logo_mobile) . '" alt="' . $site_description . '">'; ?></a>
		<?php endif; ?>
		</div>
 	
		<?php df_mobile_menu_header(); ?>
		<nav id="site-navigation" class="main-navigation" role="navigation">
		    <?php 
		    df_navbar_menu( array(
				'menu_wraper' 		=> '<ul id="main-nav" class="df-navi">%MENU_ITEMS%' . "\n" . '</ul>',
				'menu_items'		=>  "\n" . '<li class="%ITEM_CLASS%"><a href="%ITEM_HREF%"%ESC_ITEM_TITLE%>%ICON%<span>%ITEM_TITLE%%SPAN_DESCRIPTION%</span></a>%SUBMENU%</li> ',
				'submenu' 			=> '<ul class="sub-nav df_row-fluid">%ITEM%</ul>',
				//'parent_clicable'	=> of_get_option( 'header-submenu_parent_clickable', true ),
				'params'			=> array( 'act_class' => 'act', 'please_be_mega_menu' => true ),
			) ); 
			?>
			<?php
			// if( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' )){
			//  wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'df-navi' ) );
			// } else {
			// echo sprintf('<ul class="df-navi"><li><a href="%swp-admin/nav-menus.php">Assign a Menu</a></li></ul>', esc_url( home_url( '/' ) ));
			// }
			  ?>
		</nav><!-- #site-navigation -->

	</div>
</div><!-- .df-navibar -->

<?php endif; ?>