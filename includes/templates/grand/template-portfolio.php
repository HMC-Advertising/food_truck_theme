<?php get_header(); ?>

<div id="content" class="df_container-fluid col-full">

    <div id="main-sidebar-container">
        <div class="df-main">
        	<?php
            global $post;
            $page_id = get_the_id();


            $Content_area = get_post_meta($page_id, 'df_metabox_port_content_area', true);

            if ($Content_area == 'top' && $post->post_content!="") {
                echo " <div class='df-container-template-blog-content1'>";
                $post = get_page($page_id);
                $content = apply_filters('the_content', $post->post_content);
                echo wp_kses_post($content);
                echo "</div><div class='clear'></div>";
            }
            ?>
            <?php df_get_template('grand', 'loop-portfolio'); ?>
 
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>