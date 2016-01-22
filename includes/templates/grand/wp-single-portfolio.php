<?php get_header(); ?>

<div id="content" class="df_container-fluid col-full">
    <div id="main-sidebar-container">
        <div class="df-main">
            <?php
            while (have_posts()) : the_post();
                $portfolio_layout = get_post_meta(get_the_id(), 'df_metabox_portfolio_custom_layout', true);
                $single_portfolio = get_post_meta(get_the_id(), 'df_metabox_portfolio_std', true);
                if ($single_portfolio == 'left' && $portfolio_layout == 'standard') {
                    echo '<div class="df-single-portfolio-left-layout alignleft">';
                    df_single_left_image_grand();
                    echo "</div>";
                    echo '<div class="clear"></div>';
                } else if ($single_portfolio == 'right' && $portfolio_layout == 'standard') {
                    echo '<div class="df-single-portfolio-right-layout alignleft">';
                    df_single_right_image_grand();
                    echo "</div>";
                    echo '<div class="clear"></div>';
                } else if ($single_portfolio == 'top' && $portfolio_layout == 'standard') {
                    echo '<div class="df-single-portfolio-top-layout alignleft">';
                    df_single_top_image_grand();
                    echo "</div>";
                    echo '<div class="clear"></div>';
                } else if ($single_portfolio == 'bottom' && $portfolio_layout == 'standard') {
                    echo '<div class="df-single-portfolio-top-layout alignleft">';
                    df_single_bottom_image_grand();
                    echo "</div>";
                    echo '<div class="clear"></div>';
                } else {

                    the_content();
                }
                echo '<div class="df-single-portfolio-postnav">';
                df_single_portfolio_postnav();
                echo '</div>';
                echo '<div class="df-single-portfolio-related-post">';
                df_single_portfolio_related_post_grand();
                echo '</div>';


                // If comments are open or we have at least one comment, load up the comment template
                if (comments_open() || '0' != get_comments_number()) :
                    comments_template();
                endif;
            endwhile; // end of the loop.    
            ?>
        </div>
        <?php get_sidebar(); ?>
    </div>

</div><!-- .df_container-fluid -->
<?php get_footer(); ?>