<?php get_header(); ?>

<div id="content" class="df_container-fluid col-full">
	<div id="main-sidebar-container">
		<div class="df-main">
			<?php while ( have_posts() ) : the_post(); ?>

						<?php df_get_template( 'grand', 'content', 'page' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) :
							comments_template();
						endif;
					?>

					<?php endwhile; // end of the loop. ?>
		</div>
	<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>