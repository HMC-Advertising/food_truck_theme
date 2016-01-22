<?php
/**
 * The template for displaying Post Format pages
 *
 * Used to display loop-blog pages for posts with a post format.
 */
global $post;
 
?>
<section id="primary" class="content-area">
    <!-- Content -->
    <?php
    df_isotope_category_blog();
    echo '<div class="df-standard-image-top">';
    ?>
    <div class="entry-content">

        <?php
 

        if (have_posts()) :
            ?>
    <div class="grid-sizer"></div>

    <?php 
            while (have_posts()) : the_post();   // main loop  
                $post_format = get_post_format();
                if ($post_format == '') {
                    $post_format = 'post';
                }
                    df_get_template('grand', 'content', $post_format);
            endwhile;
            wp_reset_postdata();
            echo '</div><div class="clear"></div>'; //end blog standar setting top left right

        endif;
        df_pagenav_number();

        ?>

    </div><!-- .entry-content -->
</section><!-- #primary -->

