<?php df_get_template( 'global', '_header' ); ?>

<?php
$col_extra = ( df_options('header_widget_bar') == '' ) ? 3 : df_options('header_widget_bar');
if ($col_extra != 0) : ?>
	<div class="df-widgetbar-button df-header-top">
        <i class="icon df-plus-medium"><span class="hide"><?php _e('Toggle the Widgetbar', 'dahztheme'); ?></span></i>
    </div>
<?php endif; ?>

 	<header id="masthead" class="site-header col-full" role="banner">
		<?php df_get_template( 'global', '_header-navbar' ); ?>
	</header><!-- #masthead -->

<?php dahztheme_title_controller(); ?>
