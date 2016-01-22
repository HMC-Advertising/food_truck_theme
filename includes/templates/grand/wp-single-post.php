<?php get_header(); ?>

<div id="content" class="df_container-fluid col-full">
    <div id="main-sidebar-container">
        <div class="df-main">
            <?php
            while (have_posts()) : the_post();
                $post_format = get_post_format();
                if ($post_format == '') {
                    $post_format = 'post';
                }
                df_get_template('grand', 'content', $post_format);
                // dahz_post_nav();
                // title and post format is in content-$postformats.php
                echo "<div class='post-content-single-blog'>";
                the_content();
                echo "</div>";
                df_blog_tags();
                df_single_blog_share();
                df_single_blog_author();
                df_single_blog_postnav();
                df_single_blog_related_post();

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
<?php
df_single_blog_postnav_wr_thumb();
df_single_blog_postnav_wl_thumb();
get_footer();
?>