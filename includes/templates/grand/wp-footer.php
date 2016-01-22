<?php df_get_template( 'global', '_header', 'widgetbar' ); ?> 
<?php df_get_template( 'global', '_footer', 'scroll-top' ); ?>
<?php df_get_template( 'global', '_footer', 'widgetbar' ); ?>

<?php
	 $df_footer_textbox_left_setting = df_options('footer_textbox_left_setting');
	 $df_footer_textbox_right_setting = df_options('footer_textbox_right_setting');

	 $allowed_html = array(
	    'a' => array(
	            'href' => array(),
	            'class' => array()
	        ),
	    'p' => array()
		);

	$$df_footer_textbox_left_setting = wp_kses( $df_footer_textbox_left_setting, $allowed_html, "http, https, ftp, mailto");
	$df_footer_textbox_right_setting = wp_kses( $df_footer_textbox_right_setting, $allowed_html, "http, https, ftp, mailto");


     if (function_exists('icl_register_string')) {icl_register_string('AZ Footer Content', 'footer text left – ' . $df_footer_textbox_left_setting, $df_footer_textbox_left_setting ); }
     if (function_exists('icl_register_string')) {icl_register_string('AZ Footer Content', 'footer text right – ' . $df_footer_textbox_right_setting, $df_footer_textbox_right_setting ); }  
     $icl_t = function_exists('icl_t'); 
     $footer_text_left = $icl_t ? icl_t('AZ Footer Content', 'footer text left – ' . $df_footer_textbox_left_setting, $df_footer_textbox_left_setting) : $df_footer_textbox_left_setting;
     $footer_text_right = $icl_t ? icl_t('AZ Footer Content', 'footer text right – ' . $df_footer_textbox_right_setting, $df_footer_textbox_right_setting) : $df_footer_textbox_right_setting;
?> 

	<footer id="footer-colophon" class="site-footer" role="contentinfo">
		<div class="df_container-fluid">
			<div class="site-info col-full">
				<div class="col-left">
		<?php if( $df_footer_textbox_left_setting  == '' ) : ?> 		
		 <?php if ( has_nav_menu( 'footer-menu' ) ) :
              wp_nav_menu( array(
                'theme_location' => 'footer-menu',
                'container'      => false,
                'menu_class'     => 'footer-navigation df-navi',
                'depth'          => -1
              ) );
            endif;
            ?>
        <?php else: ?>
				<p><?php echo stripslashes($footer_text_left); ?></p>
          <?php endif; ?>
		     </div>

		     <div class="col-right">
		    <?php if( $df_footer_textbox_right_setting  == '' ) : ?> 
		    <p><?php echo sprintf( '%1$s %4$s %3$s %2$s', __("Copyright &copy; ", 'dahztheme') . date( 'Y' ), get_bloginfo( 'name' ) . '.', __( 'All Rights Reserved.', 'dahztheme' ), 'DAHZ' ); ?></p>
			<?php else: ?>
			<p><?php echo stripslashes($footer_text_right); ?></p>
			<?php endif; ?>
			</div>

			</div><!-- .site-info -->
		</div>
	</footer><!-- #colophon -->

<?php df_get_template( 'global', '_footer' ); ?>