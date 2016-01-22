<?php
// File Security Check
if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die('You do not have sufficient permissions to access this page!');
}
// ==========================================================================================================
// content for post standar grand
// ==========================================================================================================
?>
<?php
wp_enqueue_style('pphoto');
$article_class = '';
$big_port_class = '';
$category_link = '';
$port_big_grid = get_post_meta(get_the_id(), 'df_metabox_enable_big_port_grid', true);
$preview_style = get_post_meta(get_the_id(), 'df_metabox_portfolio_preview_style', true);
$gallery_portfolio = count(get_post_meta(get_the_id(), 'df_metabox_gallery_portfolio'));

if ($port_big_grid == '1') {
    $big_port_class = 'big_port_class';
} else {
    $big_port_class = 'small_port_class';
}
$terms = get_the_terms($post->ID, 'portfolio-gallery');
if ($terms && !is_wp_error($terms)) :
    $category_links = array();
    foreach ($terms as $term) {
        $category_links[] = $term->slug;
    }
    $category_link = join(" ", $category_links);
endif;
$article_port_class = $category_link . ' ' . $big_port_class;
?>


<article <?php post_class($article_port_class); ?>> <!-- post class -->
    <?php
    $title_before = '<h4 class="df-post-title alignleft">';
    $title_after = '</h4>';
    if (!is_single()) {
        $title_before = $title_before . '<a href="' . esc_url(get_permalink(get_the_ID())) . '" rel="bookmark" title="' . the_title_attribute(array('echo' => 0)) . '">';
    }
    $title_after = '</a>' . $title_after;
    ?>
    <div class="entry df-portfolio-content"> <!-- post class -->
        <?php
        global $page_metabox_image_resize_port, $image_width_port, $image_height_port;
        if (has_post_thumbnail() && $preview_style == "featured") {
            $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            echo "<div class='df-port-image'>";
            echo '<div class="view third-effect">';
            if ($page_metabox_image_resize_port == 'custom') {
                    $img_url = wp_get_attachment_url(get_post_thumbnail_id(), 'full'); //get full URL to image (use "large" or "medium" if the images too big)
                    $image = aq_resize($img_url, $image_width_port, $image_height_port, true); //resize & crop the image
                    echo '<img src="' . $image . '" />';
            } else { 
                the_post_thumbnail('full');
            }
            echo '  <div class="mask">';
            echo '  <div class="mask-table">';        
            echo '  <div class="mask-table-cell">'; 
            echo '            <a href="' . esc_url($large_image_url[0]) . '" class="info"  rel="prettyPhoto"><i class="df-plus-medium"></i></a>
                    </div> ';
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        else if ($gallery_portfolio != 0 && $preview_style == "slider") {
            df_gallery_page_portfolio();
        }
        else  {
            $url_src = esc_url(get_template_directory_uri() . '/includes/images/presets/post-formats/big/');
            echo "<div class='df-port-image'>";
            echo '<a href="' . esc_url(get_permalink(get_the_ID())) . '" rel="bookmark" title="">';
            echo '<img src="' . $url_src . 'portfolio.jpg" class="attachment-thumbnail-single-related wp-post-image" alt="">';
            echo "</div>";
            echo "</a>";
            
        }


        the_title($title_before, $title_after);
        if (function_exists('df_like')) {
            echo "<span class='df-like-port df-grand-link alignright' >";
            df_like();
            echo "</span>";
        }

        echo '<div class="clear"></div>';
        echo '<span class="df-category-portfolio df-grand-link"> ' . get_the_term_list($post->ID, 'portfolio-gallery', '', ', ', '') . '</span>';
        ?>

        <div class="clear"></div>
    </div><!-- /.entry -->
</article> <!--end post class -->




