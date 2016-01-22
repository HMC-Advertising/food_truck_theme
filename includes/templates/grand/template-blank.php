<?php if ( ! defined( 'ABSPATH' ) ) { exit; } 


df_get_template( 'global', '_header' ); ?>

<div id="content" class="df_container-fluid col-full">
	<div id="main-sidebar-container">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						 <div class="entry-content">

							<?php the_content(); ?>

						</div>

					</article>

					<?php endwhile; // end of the loop. ?>

					<?php else : ?>

					<article class="post">
						<p><?php echo apply_filters( 'df_noposts_message', __( 'Sorry, no posts matched your criteria.', 'dahztheme' ) ); ?></p>
					</article><!-- /.post -->

			<?php endif;?>


	</div>
</div>

<?php df_get_template( 'global', '_footer' ); ?>