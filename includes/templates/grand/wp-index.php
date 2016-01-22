<?php get_header(); ?>

<div id="content" class="df_container-fluid col-full">
	<div id="main-sidebar-container">
		<div class="df-main">
		<?php df_get_template('global', '_index'); ?>
   		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>