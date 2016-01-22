<?php
global $post, $archive_author_layout;

$author_ids = get_the_author_meta('ID');
$archive_author_layout = df_options('archive_author_layout');
$archive_author_grid_layout = df_options('archive_author_grid_layout');
$archive_author_list_layout = df_options('archive_author_list_layout');
?>

<?php get_header(); ?>

<div id="content" class="df_container-fluid col-full">
    <div id="main-sidebar-container">
        <div class="df-main">
            <?php
            df_single_blog_author();

            if ($archive_author_layout == 'list') {
                if ($archive_author_list_layout == 'standard_image_top') {
                    echo '<div class="df-standard-image-top">';
                } elseif ($archive_author_list_layout == 'standard_image_left') {
                    echo '<div class="df-standard-image-left">';
                } elseif ($archive_author_list_layout == 'standard_image_right') {
                    echo '<div class="df-standard-image-right">';
                }
            } elseif ($archive_author_layout == 'grid') {
                df_arc_author_grid_js();
                echo '<div class="df-blog-grid-standard ' . $archive_author_grid_layout . '">';
            }
            ?>
            <div class="entry-content" >
                <?php
                if (get_query_var('paged')) {
                    $paged = get_query_var('paged');
                } elseif (get_query_var('page')) {
                    $paged = get_query_var('page');
                } else {
                    $paged = 1;
                }
                $blog_args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'author' => $author_ids,
                    'paged' => $paged,
                );
                query_posts($blog_args);

                if (have_posts()) :
                    ?>
    <div class="grid-sizer"></div>

    <?php 
                    while (have_posts()) : the_post();   // main loop  
                        $post_format = get_post_format();
                        if ($post_format == '') {
                            $post_format = 'post';
                        } 
                        
                           
                            df_get_template(df_get_composer(), 'content', $post_format);
                              
                    endwhile;
                    wp_reset_postdata();
                    echo '</div><div class="clear"></div>'; //end blog standar setting top left right

                endif;
                ?>
            </div><!-- .entry-content -->

        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>