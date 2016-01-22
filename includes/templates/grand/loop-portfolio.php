<?php
/**
 * The template for displaying Post Format pages
 *
 * Used to display loop-porto pages for posts with a post format.
 */
global $post, $page_metabox_image_resize_port, $image_width_port, $image_height_port;
$page_metabox_image_resize_port = get_post_meta(get_the_ID(), 'df_metabox_persevere_image_size_port', true);
$image_width_port = esc_attr(get_post_meta(get_the_ID(), 'df_metabox_image_width_port', true));
$image_height_port = esc_attr(get_post_meta(get_the_ID(), 'df_metabox_image_height_port', true));



$port_grid = get_post_meta($post->ID, 'df_metabox_portofolio_grid', true);
$port_style_grid = get_post_meta($post->ID, 'df_metabox_portofolio_style_grid', true);
$number_of_posts = esc_attr(get_post_meta($post->ID, 'df_metabox_number_post_porto', true));
$order_of_posts = get_post_meta($post->ID, 'df_metabox_select_order_post_porto', true);
$orderby_of_posts = get_post_meta($post->ID, 'df_metabox_select_orderby_post_porto', true);
$category_include = get_post_meta($post->ID, 'df_metabox_select_category_include_porto');
$category_exclude = get_post_meta($post->ID, 'df_metabox_select_category_exclude_porto');
$pagination_style = get_post_meta($post->ID, 'df_metabox_pagination_style_porto', true);

df_portfolio_no_margin();

$cat_inc = '';
$cat_count_inc = count($category_include);
if ($cat_count_inc = 1) {
    $temp_catinc = array();
    foreach ($category_include as $catinc) {
        $temp_catinc[] = $catinc;
    }
    $cat_inc = implode(', ', $temp_catinc);
} else if ($cat_count_inc > 1) {
    $cat_inc = $category_include;
}

$cat_ex = '';
$cat_count_ex = count($category_exclude);
if ($cat_count_ex = 1) {
    $temp_catex = array();

    foreach ($category_exclude as $catex) {
        $temp_catex[] = $catex;
    }
    $cat_ex = implode(', ', $temp_catex);
} else if ($cat_count_ex > 1) {
    $cat_ex = $category_exclude;
}

$like = '';
if ($orderby_of_posts == 'meta_value_num') {
    $like = '_df-like';
}
?>
<section id="primary" class="content-area">
    <!-- Content -->
    <?php
    if ($port_style_grid == '1') {
        $style_class = 'df-porto-style1';
    } else {
        $style_class = 'df-porto-style2';
    }
    ?>
    <?php
    echo '<div class="' . $style_class . ' ' . $port_grid . '" >';


    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }
    $port_args = array(
        'post_type' => 'portfolio',
        'post_status' => 'publish',
        'paged' => $paged,
        'posts_per_page' => $number_of_posts,
        'order' => $order_of_posts,
        'orderby' => $orderby_of_posts,
//        'category_name' => $cat_inc,
        'meta_key' => $like
//        'category__not_in' => $cat_ex
    );
    if (!empty($cat_inc)) {
        $port_args['tax_query'] = array(
            array(
                'taxonomy' => 'portfolio-gallery',
                'field' => 'slug',
                'terms' => $category_include
            )
        );
    }

    if (!empty($cat_ex)) {
        $port_args['tax_query'] = array(
            array(
                'taxonomy' => 'portfolio-gallery',
                'field' => 'slug',
                'terms' => $category_exclude,
                'operator' => 'NOT IN'
            )
        );
    }
    query_posts($port_args);
    if (have_posts()) :
        df_isotope_category_port();


// ======================================================================================
// while loop
// ======================================================================================
        echo "<div class='df-portfolio-isotope entry-content '>";
        ?>
    <div class="grid-sizer"></div>

    <?php 
        if ($port_style_grid == '1') {
            while (have_posts()) : the_post();   // main loop  
                df_get_template(df_get_composer(), 'content', 'portfolio-style1');
            endwhile;
        }
        else {
            while (have_posts()) : the_post();   // main loop  
                df_get_template(df_get_composer(), 'content', 'portfolio-style2');
            endwhile;
        }

        echo "</div><div class='clear'></div>";
        wp_reset_postdata();
    endif;
    ?>

</div><!-- .entry-content -->

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