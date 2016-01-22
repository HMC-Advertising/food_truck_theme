<?php
/**
 * The template for displaying Post Format pages
 *
 * Used to display loop-porto pages for posts with a post format.
 */
global $post;
$queried_object = get_queried_object()->slug;
df_arc_cat_port_grid_js();  
?>
<section id="primary" class="content-area">
    <!-- Content -->
    <?php
    echo '<div class="df-porto-style2 grid_3_portfolio" >';
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
        'paged' => $paged
    );
    $port_args['tax_query'] = array(
        array(
            'taxonomy' => 'portfolio-gallery',
            'field' => 'slug',
            'terms' => $queried_object
        )
    );
    query_posts($port_args);
    if (have_posts()) :
        df_isotope_category_port();
    ?>
    <div class="grid-sizer"></div>

    <?php 

// ======================================================================================
// while loop
// ======================================================================================
        echo "<div class='df-portfolio-isotope entry-content '>";
         ?>
    <div class="grid-sizer"></div>

    <?php 
        while (have_posts()) : the_post();   // main loop  
            df_get_template(df_get_composer(), 'content', 'portfolio-style2');
        endwhile;
        echo "</div><div class='clear'></div>";
        wp_reset_postdata();
    endif;
    echo '</div>';
    ?>
</section><!-- #primary -->