<?php get_header(); ?>

<div id="content" class="df_container-fluid col-full">
    <div id="main-sidebar-container">
        <div class="df-main">
            <?php
            if ( have_posts() ) : while ( have_posts() ) : the_post();

            ?>

            <h1><?php the_title(); ?></h1>

          

            <div class="entry-attachment">
            <?php if ( wp_attachment_is_image( $post->id ) ) : $att_image = wp_get_attachment_image_src( $post->id, "full"); ?>
                                    <p class="attachment"><a href="<?php echo wp_get_attachment_url($post->id); ?>" title="<?php the_title(); ?>" rel="attachment"><img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1];?>" height="<?php echo $att_image[2];?>"  class="attachment-medium" alt="<?php $post->post_excerpt; ?>" /></a>
                                    </p>
            <?php else : ?>
                                    <a href="<?php echo wp_get_attachment_url($post->ID); ?>" title="<?php echo esc_html( get_the_title($post->ID), 1 ) ?>" rel="attachment"><?php echo basename($post->guid) ?></a>
            <?php endif; ?>
                                    </div>

            <?php endwhile; ?>

            <?php endif; ?>

        </div>
        <?php get_sidebar(); ?>
    </div>
</div><!-- .df_container-fluid -->
<?php
 
get_footer();
?>