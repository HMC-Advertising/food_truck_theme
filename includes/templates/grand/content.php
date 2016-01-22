<?php
// File Security Check
if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die('You do not have sufficient permissions to access this page!');
}
// ==========================================================================================================
// content for post standar grand
// ==========================================================================================================
$blog_big_post_grid = get_post_meta($post->ID, 'df_metabox_enable_big_post_grid', true);
$big_post_class = '';
if ($blog_big_post_grid == '1') {
$big_post_class = 'big-post-grid';
} /* end big post grid */
?>
<article <?php post_class($big_post_class); ?>> 
<?php
    $title_before = '<h2 class="df-post-title">';
    $title_after = '</h2>';
    if (!is_single()) {
        $title_before = $title_before . '<a href="' . esc_url(get_permalink(get_the_ID())) . '" rel="bookmark" title="' . the_title_attribute(array('echo' => 0)) . '">';
        $title_after = '</a>' . $title_after;
    }
    ?>
    <div class="entry"> 
        <?php
        df_image_post_format();
        ?>
        <div class='df-post-content'>
        <?php 
        df_category_blog();
        the_title($title_before, $title_after);
        df_grand_post_meta();

        if (!is_single()) {
            df_blog_excerpt();
            df_extra_button_post();
        }
        ?>
    </div><!-- /.df-post-content -->
</div><!-- /.entry -->
</article> <!--end post class -->