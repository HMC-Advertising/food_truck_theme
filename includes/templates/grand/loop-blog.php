<?php
/**
 * The template for displaying Post Format pages
 *
 * Used to display loop-blog pages for posts with a post format.
 */
global $post, $page_metabox_image_resize, $image_width, $image_height;
 
$page_metabox_image_resize = get_post_meta(get_the_ID(), 'df_metabox_persevere_image_size', true);
$image_width = esc_attr(get_post_meta(get_the_ID(), 'df_metabox_image_width', true));
$image_height = esc_attr(get_post_meta(get_the_ID(), 'df_metabox_image_height', true));
$blog_stan_img_sett = get_post_meta($post->ID, 'df_metabox_blog_image_stan', true);
$number_of_posts    = esc_attr(get_post_meta($post->ID, 'df_metabox_number_blog_post', true));
$order_of_posts     = get_post_meta($post->ID, 'df_metabox_select_order_post', true);
$orderby_of_posts   = get_post_meta($post->ID, 'df_metabox_select_orderby_post', true);
$category_include   = get_post_meta($post->ID, 'df_metabox_select_category_include');
$category_exclude   = get_post_meta($post->ID, 'df_metabox_select_category_exclude');
$pagination_style   = get_post_meta($post->ID, 'df_metabox_pagination_style', true);
$blog_layout        = get_post_meta($post->ID, 'df_metabox_blog_layout', true);
$blog_layout_grid   = get_post_meta($post->ID, 'df_metabox_blog_grid', true);

//category include
$cat_inc = '';
$cat_count_inc = count($category_include);
if ($cat_count_inc > 0) {
    foreach ($category_include as $catinc) {
        $temp_catinc[] = $catinc;
    }
    $cat_inc = implode(',', $temp_catinc);
}

//category exclude
$temp_catex = '';
$cat_count_ex = count($category_exclude);
if ($cat_count_ex > 0) {
    foreach ($category_exclude as $catex) {
        foreach (get_categories() as $category) {
            if ($category->slug == $catex) {
                $THE_ID = $category->cat_ID;
                $THE_ID = (int) $THE_ID;
            }
        }
        $temp_catex[] = $THE_ID;
    }
}

$like = '';
if ($orderby_of_posts == 'meta_value_num') {
    $like = '_df-like';
}
?>
<section id="primary" class="content-area">
    <!-- Content -->
    <?php
    df_isotope_category_blog();

    // blog standar setting image top left right
    if ($blog_layout == 'list') {
        if ($blog_stan_img_sett == 'standard_image_top') {
            echo '<div class="df-standard-image-top">';
        } elseif ($blog_stan_img_sett == 'standard_image_left') {
            echo '<div class="df-standard-image-left">';
        } elseif ($blog_stan_img_sett == 'standard_image_right') {
            echo '<div class="df-standard-image-right">';
        }
    } elseif ($blog_layout == 'grid') {
        echo '<div class="df-blog-grid-standard ' . $blog_layout_grid . '">';
    }
      else{
        echo '<div class="df-standard-image-top">';
        
    } 
    // end blog standar setting top left right
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
            'paged' => $paged,
            'posts_per_page' => $number_of_posts,
            'order' => $order_of_posts,
            'orderby' => $orderby_of_posts,
            'category_name' => $cat_inc,
            'meta_key' => $like,
            'category__not_in' => $temp_catex,
        );
        query_posts($blog_args);

        if (have_posts()) :?>
            <div class="grid-sizer"></div>
            <?php   
            while (have_posts()) : the_post();   // main loop  
                    df_get_template('grand', 'content', get_post_format());
            endwhile;
            wp_reset_postdata();

        endif;
            echo '</div>'; //end blog standar setting top left right
        ?>

    </div>
    <!-- .entry-content -->

    <?php
    if ($pagination_style == "number") {
        df_pagenav_number();
    } elseif ($pagination_style == "infinite") {
        df_pagenav_infinite_scroll();
    } elseif ($pagination_style == "infinite_button") {
        df_pagenav_infinite_scroll_button();
    } elseif ($pagination_style == "infinite_button_count") {
        df_pagenav_infinite_scroll_button_count();
    } else {
        df_pagenav();
    }
    ?>

</section><!-- #primary -->

