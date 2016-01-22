<?php get_header(); ?>

<div id="content" class="df_container-fluid col-full">
    <div id="main-sidebar-container">
        <div class="df-main">
            <?php
            $post_type = get_post_type();

            if ($post_type == 'post') {
                df_get_template(df_get_composer(), 'loop', 'archive-blog');
            } else {
                df_get_template(df_get_composer(), 'loop', 'archive-portfolio');
            }
            ?> 
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>