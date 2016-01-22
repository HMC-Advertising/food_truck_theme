<?php get_header(); ?>

<div id="content" class="df_container-fluid col-full">

    <div id="main-sidebar-container">
        <div class="df-main col-full">
            <?php
            global $post;
            $page_id = get_the_id();


            $Content_area = get_post_meta($page_id, 'df_metabox_blog_content_area', true);
            if ($Content_area == 'top' && $post->post_content!="") {
                echo " <div class='df-container-template-blog-content1'>";
                $post = get_page($page_id);
                $content = apply_filters('the_content', $post->post_content);
                echo wp_kses_post($content);
                echo "</div><div class='clear'></div>";
            }
            ?>
            <?php df_get_template('grand', 'loop-blog'); ?>
            <?php
            if ($Content_area == 'bottom' && $post->post_content!="") {
                echo "<div class='clear'></div><div class='df-container-template-blog-content2'>";
                $post = get_page($page_id);
                $content = apply_filters('the_content', $post->post_content);
                echo wp_kses_post($content);
                echo "</div>";
            }
            ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>