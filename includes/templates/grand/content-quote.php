<?php
// File Security Check
if (!empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die('You do not have sufficient permissions to access this page!');
}
// ==========================================================================================================
// content for post quote grand
// ==========================================================================================================
$blog_big_post_grid = get_post_meta($post->ID, 'df_metabox_enable_big_post_grid', true);
$big_post_class = '';
if ($blog_big_post_grid == '1') {
$big_post_class = 'big-post-grid';
} /* end big post grid */
?>
<article <?php post_class($big_post_class); ?>> 
 
<div class="entry"> <!-- post class -->
    <?php
    df_quote_post_format();
    df_grand_post_meta();

    if (!is_single()) {
	    df_extra_button_post();
	}
    ?>
</div><!-- /.entry -->
</article> <!--end post class -->