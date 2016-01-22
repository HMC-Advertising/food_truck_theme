<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package dahztheme
 */
/* ----------------------------------------------------------------------------------- */
/* Load responsive <meta> tags in the <head>                                           */
/* ----------------------------------------------------------------------------------- */

if (!function_exists('df_load_responsive_meta_tags')) {

    function df_load_responsive_meta_tags() {
        $html = '';

        $html .= "\n" . '<!--  Mobile viewport scale -->' . "\n";
        $html .= '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">' . "\n";

        echo $html;
    }

// End df_load_responsive_meta_tags()
    add_action('dahz_meta', 'df_load_responsive_meta_tags', 10);
}

/* ----------------------------------------------------------------------------------- */
/* Filter Tag Cloud                                                                    */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_tag_cloud_args')) {

    function df_tag_cloud_args($in) {
        return 'smallest=11&amp;largest=14&amp;unit=px';
    }

    add_filter('widget_tag_cloud_args', 'df_tag_cloud_args');
}

/* ----------------------------------------------------------------------------------- */
/* Breadcrumb display                                                                  */
/* ----------------------------------------------------------------------------------- */
// Customise the breadcrumb
if (!function_exists('df_custom_breadcrumbs_args')) {

    function df_custom_breadcrumbs_args($args) {
        $args = array('separator' => '&rsaquo;', 'before' => '', 'show_home' => sprintf(__('Home', 'dahztheme')),);
        
        return $args;
    }

// End df_custom_breadcrumbs_args()
    add_filter('dahz_breadcrumbs_args', 'df_custom_breadcrumbs_args', 10);
}

/* ----------------------------------------------------------------------------------- */
/* Global Post Meta                                                                    */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_posted_on')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function df_posted_on() {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        $time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date()));
        $author = __('by', 'dahztheme') .' '. sprintf('<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>', esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_html(get_the_author()));

        printf('<span class="posted-on">%1$s</span><span class="byline">%2$s</span>', sprintf('<a href="%1$s" rel="bookmark">%2$s</a>', esc_url(get_permalink()), $time_string ), $author) ;
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Categorized Blog                                                                    */
/* ----------------------------------------------------------------------------------- */

/**
 * Returns true if a blog has more than 1 category.
 */
function df_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('all_the_cool_cats') )) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'hide_empty' => 1,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('all_the_cool_cats', $all_the_cool_cats);
    }

    if ('1' != $all_the_cool_cats) {
        // This blog has more than 1 category so dahz_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so dahz_categorized_blog should return false.
        return false;
    }
}

/* ----------------------------------------------------------------------------------- */
/* Category Blog                                                                       */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_category_blog')) :

    function df_category_blog() {
        $blog_category_post = get_post_meta(get_the_id(), 'df_metabox_enable_post_cat', true);
        $df_enable_link_cat = df_options('enable_link_category');
        if ($df_enable_link_cat == '1' && $blog_category_post != '0') {
            $category = get_the_term_list(get_the_ID(), 'category', '', ', ');
            echo ' <span class="df-category-content-post df-grand-link">' . $category . '</span>';
        }
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Blog excerpt                                                                        */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_blog_excerpt')) :

    function df_blog_excerpt() {
        $blog_ex = get_post_meta(get_the_id(), 'df_metabox_enable_post_ex', true);
        $df_excerpt = df_options('blog_show_excerpt');
        $df_excerpt_length = esc_attr(df_options('excerpt_length'));
        if ($df_excerpt == '1' && $blog_ex != '0') {
            $excerpt = strip_tags(get_the_excerpt());
            echo "<p>";
            echo df_word_trim($excerpt, $df_excerpt_length, '...');
            echo "</p>";
        }
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Postnav single Blog next prev no thumbnail                                          */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_single_blog_postnav')) :

    function df_single_blog_postnav() {
        $df_enable_postnav = df_options('enable_post_pagination');
        $df_enable_postnav_style = df_options('blog_pagination_style');
        if (($df_enable_postnav) && ($df_enable_postnav_style == 'style1')) {
            ?>
            <div class="post-pagination">
                <div class="nav-prev small-left">
                    <?php
                        previous_post_link('%link', '<h5 >' . __(' Previous Article', 'dahztheme') . '</h5> <i class="df-arrow-grand-left"></i>');
                        previous_post_link('<span class="df-grand-link title-link-nav-single-post">%link</span>');
                    ?>

                </div>
                <div class="nav-next small-right">
                    <?php
                        next_post_link('%link', '<i class="df-arrow-grand-right"></i><h5>' . __('Next Article ', 'dahztheme') . '</h5>');
                        next_post_link('<span class="df-grand-link title-link-nav-single-post">%link</span>');
                    ?>
                </div>
            </div>
            <div class="clear"></div>
            <?php
        }
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Postnav single Blog next (left) with thumbnail                                      */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_single_blog_postnav_wl_thumb')) :

    function df_single_blog_postnav_wl_thumb() {
        $df_enable_postnav = df_options('enable_post_pagination');
        $df_enable_postnav_style = df_options('blog_pagination_style');
        if (($df_enable_postnav) && ($df_enable_postnav_style == 'style2')) {
            ?>
            <div id="post-single-nav-left" class="post-side-left-pagination no-active">
                <div id="post-nav">
                    <?php
                    global $post;
                    $prevPost = get_next_post(false);
                    if ($prevPost) {
                        $args = array(
                            'posts_per_page' => 1,
                            'include' => $prevPost->ID
                        );
                        $prevPost = get_posts($args);
                        foreach ($prevPost as $post) {
                            setup_postdata($post);
                            ?>
                            <div class="post-previous">

                                <a class="img" href="<?php esc_url(the_permalink()); ?>"><?php
                                    if (has_post_thumbnail()) {

                                        echo '<div class="view third-effect">';
                                        the_post_thumbnail('thumbnail-navi-single-post');
                                        echo '        <div class="mask">
                        <a href="' . esc_url(get_permalink()) . '" class="info">' . __('Read More', 'dahztheme') . '</a>
                    </div></div>';
                                    } else {
                                        echo '<div class="view third-effect">';
                                        $image_nav = get_post_format();
                                        $url_src = esc_url(get_template_directory_uri() . '/includes/images/presets/post-formats/');

                                        switch ($image_nav) {
                                            case 'audio':
                                                echo '<img src="' . $url_src . 'audio.jpg" class="wp-post-image" alt="">';
                                                break;
                                            case 'gallery':
                                                echo '<img src="' . $url_src . 'gallery.jpg" class="wp-post-image" alt="">';
                                                break;
                                            case 'image':
                                                echo '<img src="' . $url_src . 'image.jpg" class="wp-post-image" alt="">';
                                                break;
                                            case 'video':
                                                echo '<img src="' . $url_src . 'video.jpg" class="wp-post-image" alt="">';
                                                break;
                                            case 'quote':
                                                echo '<img src="' . $url_src . 'quote.jpg" class="wp-post-image" alt="">';
                                                break;
                                            case 'link':
                                                echo '<img src="' . $url_src . 'link.jpg" class="wp-post-image" alt="">';
                                                break;
                                            default:
                                                echo '<img src="' . $url_src . 'standard.jpg" class="wp-post-image" alt="">';
                                        }
                                        echo '<div class="mask"><a href="' . esc_url(get_permalink()) . '" class="info">' . __('Read More', 'dahztheme') . '</a></div></div>';
                                    }
                                    ?> </a>
                                <a class="previous" href="<?php esc_url(the_permalink()); ?>">
                                    <i class="df-arrow-grand-left"></i>
                                </a>
                            </div>

                            <?php
                            wp_reset_postdata();
                        } //end foreach
                    } // end if
                    ?>
                </div>
            </div>
            <?php
        }
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Postnav single Blog next (right) with thumbnail                                     */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_single_blog_postnav_wr_thumb')) :

    function df_single_blog_postnav_wr_thumb() {
        $df_enable_postnav = df_options('enable_post_pagination');
        $df_enable_postnav_style = df_options('blog_pagination_style');
        if (($df_enable_postnav) && ($df_enable_postnav_style == 'style2')) {
            ?>
            <div id="post-single-nav-right" class="post-side-right-pagination no-active">
                <div id="post-nav">
                    <?php
                    global $post;

                    $nextPost = get_previous_post(false);
                    if ($nextPost) {
                        $args = array(
                            'posts_per_page' => 1,
                            'include' => $nextPost->ID
                        );
                        $nextPost = get_posts($args);
                        foreach ($nextPost as $post) {
                            setup_postdata($post);
                            ?>
                            <div class="post-next">
                                <a class="img" href="<?php esc_url(the_permalink()); ?>"><?php
                                    if (has_post_thumbnail()) {
                                        echo '<div class="view third-effect">';
                                        the_post_thumbnail('thumbnail-navi-single-post');
                                        echo '        <div class="mask">
                        <a href="' . esc_url(get_permalink()) . '" class="info">' . __('Read More', 'dahztheme') . '</a>
                    </div></div>';
                                    } else {

                                        echo '<div class="view third-effect">';
                                        $image_nav = get_post_format();
                                        $url_src = esc_url(get_template_directory_uri() . '/includes/images/presets/post-formats/');

                                        switch ($image_nav) {
                                            case 'audio':
                                                echo '<img src="' . $url_src . 'audio.jpg" class="wp-post-image" alt="">';
                                                break;
                                            case 'gallery':
                                                echo '<img src="' . $url_src . 'gallery.jpg" class="wp-post-image" alt="">';
                                                break;
                                            case 'image':
                                                echo '<img src="' . $url_src . 'image.jpg" class="wp-post-image" alt="">';
                                                break;
                                            case 'video':
                                                echo '<img src="' . $url_src . 'video.jpg" class="wp-post-image" alt="">';
                                                break;
                                            case 'quote':
                                                echo '<img src="' . $url_src . 'quote.jpg" class="wp-post-image" alt="">';
                                                break;
                                            case 'link':
                                                echo '<img src="' . $url_src . 'link.jpg" class="wp-post-image" alt="">';
                                                break;
                                            default:
                                                echo '<img src="' . $url_src . 'standard.jpg" class="wp-post-image" alt="">';
                                        }
                                        echo '        <div class="mask">
                        <a href="' . esc_url(get_permalink()) . '" class="info">' . __('Read More', 'dahztheme') . '</a>
                    </div></div>';
                                    }
                                    ?></a>
                                <a class="next" href="<?php esc_url(the_permalink()); ?>">
                                    <i class="df-arrow-grand-right"></i>
                                </a>
                            </div>
                            <?php
                            wp_reset_postdata();
                        } //end foreach
                    } // end if
                    ?>
                </div>
            </div>
            <?php
        }
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Isotope Category blog                                                               */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_isotope_category_blog')) :

    function df_isotope_category_blog() {
        $blog_layout = get_post_meta(get_the_id(), 'df_metabox_blog_layout', true);
        $enable_filter_cat = get_post_meta(get_the_id(), 'df_metabox_enable_filter_category', true);
        $category_include   = get_post_meta(get_the_id(), 'df_metabox_select_category_include');
        $category_exclude   = get_post_meta(get_the_id(), 'df_metabox_select_category_exclude');

        if ($enable_filter_cat != '0' && $blog_layout == 'grid') {

            // init
            $category_inc = array();
            $category_ex = array();


            // category inculde blog
            $cat_count_inc = count($category_include);
            if ($cat_count_inc > 0) {
                foreach ($category_include as $catinc) {
                    $term = get_term_by('slug', $catinc , 'category'); 
                    $category_inc[] = $term->term_id;

                }
            }

            // category exclude blog
            $cat_count_ex = count($category_exclude);
            if ($cat_count_ex > 0) {
                foreach ($category_exclude as $catex) {
                    $term = get_term_by('slug', $catex , 'category'); 
                    $category_ex[] = $term->term_id;

                }
            }
            $terms = get_terms( 'category', array(
                'include' => $category_inc,
                'exclude' => $category_ex, 

             ) );

            $html = '<ul id="options-blog-sort">';
            $html .= '<li> ' . __('Filter By :', 'dahztheme') . '</li>';
            $html .= '<li><a href="#" data-option-value="*" data-filter="*" class="selected">' . __('All', 'dahztheme') . '</a></li>';

            foreach ($terms as $term) {
                $html .= "<li><a href='#' data-filter='.category-{$term->slug}'>{$term->name}</a></li>";
            }

            $html .= '</ul><div class="clear"></div>';

            echo $html;
        }
        $layout_gid_layout = get_post_meta(get_the_id(), 'df_metabox_blog_layout_grid', true);
        if ($layout_gid_layout == 'fitrows') {
            ?>
            <script>
                jQuery(window).ready(function($) {
                    // isotope blog   
                    var mycontainer = jQuery('.df-blog-grid-standard');
                    mycontainer.isotope({
                        itemSelector: '.df-blog-grid-standard .post',
                        layoutMode: 'fitRows',
                    });
                    mycontainer.imagesLoaded( function() {
                      mycontainer.isotope('layout');
                    });
                    jQuery('#options-blog-sort a').click(function() {
                        var selector = jQuery(this).attr('data-filter');
                        mycontainer.isotope({filter: selector});
                        return false;
                    });

                    var $links = jQuery('#options-blog-sort a');
                    $links.click(function() {
                        $links.removeClass('current').addClass('link');
                        jQuery(this).removeClass('link').addClass('current');

                        var divname = this.name;
                        jQuery("#" + divname).show("normal").siblings().hide("normal");
                    });
                });

            </script>

            <?php
        } else if ($layout_gid_layout == 'masonry') {
            ?>
            <script>


                jQuery(window).ready(function($) {
                    // isotope blog  
                    var mycontainer = jQuery('.df-blog-grid-standard');
                    mycontainer.isotope({
                        itemSelector: '.df-blog-grid-standard .post',
                        masonry: {
                            columnWidth: ".grid-sizer"
                        }
                    });
                    mycontainer.imagesLoaded( function() {
                      mycontainer.isotope('layout');
                    });
                    jQuery('#options-blog-sort a').click(function() {
                        var selector = jQuery(this).attr('data-filter');
                        mycontainer.isotope({filter: selector});
                        return false;
                    });

                    var $links = jQuery('#options-blog-sort a');
                    $links.click(function() {
                        $links.removeClass('current').addClass('link');
                        jQuery(this).removeClass('link').addClass('current');

                        var divname = this.name;
                        jQuery("#" + divname).show("normal").siblings().hide("normal");
                    });
                });

            </script>

            <?php
        }
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Isotope Category portfolio                                                          */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_isotope_category_port')) :

    function df_isotope_category_port() {
        $isotope_category = get_post_meta(get_the_id(), 'df_metabox_enable_porto_iso_cat', true);
        if ($isotope_category != '0') {

            $category_include = get_post_meta(get_the_id(), 'df_metabox_select_category_include_porto');
            $category_exclude = get_post_meta(get_the_id(), 'df_metabox_select_category_exclude_porto');

            // init
            $category_inc = array();
            $category_ex = array();
            
            // category inculde port
            $cat_count_inc = count($category_include);
            if ($cat_count_inc > 0) {
                foreach ($category_include as $catinc) {
                    $term = get_term_by('slug', $catinc , 'portfolio-gallery'); 
                    $category_inc[] = $term->term_id;

                }
            }

            // category exclude port
            $cat_count_ex = count($category_exclude);
            if ($cat_count_ex > 0) {
                foreach ($category_exclude as $catex) {
                    $term = get_term_by('slug', $catex , 'portfolio-gallery'); 
                    $category_ex[] = $term->term_id;

                }
            }
            $terms = get_terms( 'portfolio-gallery', array(
                'include' => $category_inc,
                'exclude' => $category_ex, 

             ) );

            $html = '<ul id="options-portfolio-sort">';
            $html .= '<li> ' . __('Filter By :', 'dahztheme') . '</li>';
            $html .= '<li><a href="#" data-option-value="*" data-filter="*" class="selected">' . __('All', 'dahztheme') . '</a></li>';
            if ( !empty( $terms ) && !is_wp_error( $terms ) ){
                foreach ($terms as $term) {
                    $html .= "<li><a href='#' data-filter='.{$term->slug}'>{$term->name}</a></li>";
                }
            }

            $html .= '</ul><div class="clear"></div>';

            echo $html;
        }
        $port_layout_opt = get_post_meta(get_the_id(), 'df_metabox_layout_porto_options', true);
        if ($port_layout_opt == 'fitrows') {
            ?>
            <script>
                jQuery(window).ready(function($) {
                    // isotope portfolio   
                    var mycontainer = jQuery('.df-portfolio-isotope');
                    mycontainer.isotope({
                        itemSelector: '.portfolio',
                        layoutMode: 'fitRows',
                    });
                    mycontainer.imagesLoaded( function() {
                      mycontainer.isotope('layout');
                    });
                    jQuery('#options-portfolio-sort a').click(function() {
                        var selector = jQuery(this).attr('data-filter');
                        mycontainer.isotope({filter: selector});
                        return false;
                    });

                    var $links = jQuery('#options-portfolio-sort a');
                    $links.click(function() {
                        $links.removeClass('current').addClass('link');
                        jQuery(this).removeClass('link').addClass('current');

                        var divname = this.name;
                        jQuery("#" + divname).show("normal").siblings().hide("normal");
                    });
                });

            </script>

            <?php
        } /* end if port_layout_opt */ else if ($port_layout_opt == 'masonry') {
            ?>
            <script>
                jQuery(window).ready(function($) {
                    // isotope portfolio   
                        var mycontainer = jQuery('.df-portfolio-isotope');
                        mycontainer.isotope({
                            itemSelector: '.portfolio',
                            masonry: {
                                columnWidth: ".grid-sizer"
                            }
                        });
                    mycontainer.imagesLoaded( function() {
                      mycontainer.isotope('layout');
                    });
                    jQuery('#options-blog-sort a').click(function() {
                        var selector = jQuery(this).attr('data-filter');
                        mycontainer.isotope({filter: selector});
                        return false;
                    });
                    // filter items when filter link is clicked
                    jQuery('#options-portfolio-sort a').click(function() {
                        var selector = jQuery(this).attr('data-filter');
                        mycontainer.isotope({filter: selector});
                        return false;
                    });

                    var $links = jQuery('#options-portfolio-sort a');
                    $links.click(function() {
                        $links.removeClass('current').addClass('link');
                        jQuery(this).removeClass('link').addClass('current');

                        var divname = this.name;
                        jQuery("#" + divname).show("normal").siblings().hide("normal");
                    });
                });

            </script>

            <?php
        }/* end else if port_layout_opt */
    }

endif;



/* ----------------------------------------------------------------------------------- */
/* Posted on Portfolio                                                                 */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_posted_on_portfolio')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function df_posted_on_portfolio() {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        $time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date()));

        printf(__('<span class="posted-on">%1$s</span>', 'dahztheme'), sprintf('<a href="%1$s" rel="bookmark">%2$s</a>', esc_url(get_permalink()), $time_string));
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Postnav single Portofolio next prev no thumbnail                                    */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_single_portfolio_postnav')) :

    function df_single_portfolio_postnav() {
        $df_enable_pagination = df_options('portfolio_pagination_single');

        if ($df_enable_pagination) {
            $enable_back_to_page = get_post_meta(get_the_id(), 'df_metabox_enable_back_to_page', true);
            $back_to_page = get_post_meta(get_the_id(), 'df_metabox_back_to_page', true);
            $back_to_page = get_permalink($back_to_page);
            ?>
            <div class="post-pagination-portfolio">
                <div class="nav-next small-right alignright">
                    <?php
                        next_post_link('%link', '<i class="df-arrow-grand-right"></i> ');
                    ?>

                </div>
                <?php if ($enable_back_to_page) { ?>
                    <div class="df-back-to-page-portfolio">
                        <a href="<?php echo esc_url($back_to_page); ?>"><i class="df-grid-grand"></i></a>
                    </div>
                <?php } ?>
                <div class="nav-prev small-left alignleft">
                    <?php
                    previous_post_link('%link', '<i class="df-arrow-grand-left"></i> ');
                    ?>
                </div>
            </div>
            <div class="clear"></div>


            <?php
        }
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Portfolio no margin                                                                 */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_portfolio_no_margin')) :

    function df_portfolio_no_margin() {
        $margin_port = get_post_meta(get_the_id(), 'df_metabox_no_margin_portfolio', true);
        if ($margin_port != '0') {
            ?>
            <style>
                .df-layout-grand .grid_2_portfolio .portfolio.big_port_class,
                .df-layout-grand .grid_3_portfolio .portfolio.big_port_class,
                .df-layout-grand .grid_4_portfolio .portfolio.big_port_class,
                .df-layout-grand .grid_5_portfolio .portfolio.big_port_class,
                .df-layout-grand .grid_2_portfolio .portfolio,
                .df-layout-grand .grid_3_portfolio .portfolio,
                .df-layout-grand .grid_4_portfolio .portfolio,
                .df-layout-grand .grid_5_portfolio .portfolio {
                    margin-right: 0;
                    margin-bottom: 0;
                    padding: 0px;
                    position: relative;
                }  
                .df-pict-slider, .df-pict-slider li {
                    margin-bottom: 0px!important
                }
                @media only screen and (min-width: 768px) {

                    .df-layout-grand .df-portfolio-isotope{
                        width: 100%;
                        padding: 0px;
                        margin: 0px;
                    }
                    .df-layout-grand .grid_2_portfolio .portfolio{
                        width: 50%;
                    }
                    .df-layout-grand .grid_3_portfolio .portfolio{
                        width: 32.99999%;
                    }
                    .df-layout-grand .grid_4_portfolio .portfolio{
                        width: 25%;
                    }
                    .df-layout-grand .grid_5_portfolio .portfolio{
                        width: 20%;
                         
                    }

                    .df-layout-grand .grid_2_portfolio .portfolio.big_port_class{
                        width: 100%;
                    }
                    .df-layout-grand .grid_3_portfolio .portfolio.big_port_class{
                        width: 66.666666%;
                    }
                    .df-layout-grand .grid_4_portfolio .portfolio.big_port_class{
                        width: 50%;
                    }
                    .df-layout-grand .grid_5_portfolio .portfolio.big_port_class{
                        width: 40%;
                    }
                }
            </style>
            <?php
        }
    }

endif;
/* ----------------------------------------------------------------------------------- */
/* Archive Author Js                                                                   */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_arc_author_grid_js')) :

    function df_arc_author_grid_js() {
        $author_ids = get_the_author_meta('ID');
        $archive_author_layout_grid = df_options('archive_author_grid_layout_js');
        if ($archive_author_layout_grid == "man") {
            ?>
            <script>
                jQuery(window).ready(function($) {
                    // isotope blog  

                        var mycontainer = jQuery('.df-blog-grid-standard');
                        mycontainer.isotope({
                            itemSelector: '.df-blog-grid-standard .post',
                            masonry: {
                                columnWidth: ".grid-sizer"
                            }
                        });
                        mycontainer.imagesLoaded( function() {
                          mycontainer.isotope('layout');
                        });
                });
            </script>

            <?php
        } else if ($archive_author_layout_grid == "fit") {
            ?>
            <script>
                jQuery(window).ready(function($) {
                    // isotope portfolio   
                        var mycontainer = jQuery('.df-portfolio-isotope');
                        mycontainer.isotope({
                            itemSelector: '.portfolio',
                            masonry: {
                                columnWidth: ".grid-sizer"
                            }
                        });
                         mycontainer.imagesLoaded( function() {
                          mycontainer.isotope('layout');
                        });

                });
            </script>

            <?php
        }
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Archive Category Portfolio JS                                                       */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_arc_cat_port_grid_js')) :

    function df_arc_cat_port_grid_js() {
        ?>
        <script>
            jQuery(window).load(function($) {
                // isotope portfolio   
 
                    var mycontainer = jQuery('.df-portfolio-isotope');
                    mycontainer.isotope({
                        itemSelector: '.portfolio',
                        layoutMode: 'fitRows',
                    });
                    mycontainer.imagesLoaded( function() {
                      mycontainer.isotope('layout');
                    });

            });
        </script>
        <?php
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Standard Pagination display                                                         */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_pagenav')) :

    function df_pagenav() {
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>
        <div class="clear"></div>

        <nav class="navigation paging-navigation col-full" role="navigation">

            <div class="nav-links">

                <?php if (get_previous_posts_link()) : ?>
                    <div class="nav-previous alignleft">
                        <?php
                            previous_posts_link(__('<i class="df-arrow-grand-left"></i> Prev', 'dahztheme'));
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (get_next_posts_link()) : ?>
                    <div class="nav-next alignright">
                        <?php
                            next_posts_link(__('Next <i class="df-arrow-grand-right"></i>', 'dahztheme'));
                        ?>
                    </div>
                <?php endif; ?>

            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <div class="clear"></div>
        <?php
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Pagination number display                                                           */
/* ----------------------------------------------------------------------------------- */

if (!function_exists('df_pagenav_number')) :

    function df_pagenav_number() {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        
        if (is_rtl()) {
            $next_text_pagination = '<i class="df-arrow-grand-left"></i>';
            $prev_text_pagination = '<i class="df-arrow-grand-right"></i>';
        } else {
            $next_text_pagination = '<i class="df-arrow-grand-right"></i>';
            $prev_text_pagination = '<i class="df-arrow-grand-left"></i>';
        }
     
        $pagination = array(
            'base' => @add_query_arg('paged', '%#%', esc_url(get_pagenum_link('page'))),
            'format' => '',
            'total' => $wp_query->max_num_pages,
            'current' => $current,
            'show_all' => true,
            'type' => 'list',
            'next_text' => $next_text_pagination,
            'prev_text' => $prev_text_pagination 
        );
        

        if ($wp_rewrite->using_permalinks())
            $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');

        if (!empty($wp_query->query_vars['s']))
            $pagination['add_args'] = array('s' => get_query_var('s'));
        echo "<div class='df-pagination-number'>";
        echo paginate_links($pagination);
        echo "</div>";
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Pagination infinite scroll display js                                               */
/* ----------------------------------------------------------------------------------- */

if (!function_exists('df_infinite_scr')) :

    function df_infinite_scr() {
        wp_enqueue_style('owl-carousel');
        wp_enqueue_style('wp-mediaelement');
        wp_enqueue_script('wp-playlist');
        ?>
        <script>
            jQuery(document).ready(function($) {
                // Infinite Scroll
                var grand = $('body').hasClass("df-layout-grand");
                if (grand) {
                    var image_loader = '<?php echo get_template_directory_uri(); ?>/includes/images/loader.png'
                }
                var url = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname;
                var url_match = url.match(/-2/);

                if (url_match){
                    var infi_url = [url, "/"]
                }
                else{
                   var infi_url = '';
                }

                var inficontainer = $('.df-main .entry-content ');
                inficontainer.infinitescroll({
                    navSelector: ".navigation",
                    nextSelector: ".nav-next a",
                    itemSelector: ".df-main .post, .df-main .portfolio",
                    path : infi_url,
                    loading: {
                        img:image_loader,
                        msgText: "<?php _e('', 'dahztheme'); ?>",
                        finishedMsg: "<?php _e('<p>All Post Loaded.</p>', 'dahztheme'); ?>"
                    }
                },
                function(arrayOfNewElems)
                {
                    // isotope append
                    jQuery('.df-blog-grid-standard, .df-portfolio-isotope').isotope('appended', arrayOfNewElems );
                    jQuery('.df-blog-grid-standard, .df-portfolio-isotope').imagesLoaded( function() {
                        jQuery('.df-blog-grid-standard, .df-portfolio-isotope').isotope('layout');
                    });
                    // youtube fitvid
                    $(".df-post-video").fitVids();

                    // share grand
                    $('.df-hover-share-container').mouseenter(function() {
                        $(this).addClass('df-share-content-active');
                    });
                    $('.df-hover-share-container').mouseleave(function() {
                        $(this).removeClass('df-share-content-active');
                    });
                    
                    // share single portfolio
                    $('.df-layout-grand.single-portfolio .single-share-portfolio .share-span').mouseenter(function() {
                        $('.df-layout-grand.single-portfolio .single-share-portfolio ul').removeClass('no-active');
                    });
                    $('.df-layout-grand.single-portfolio .single-share-portfolio .share-span').mouseleave(function() {
                        $('.df-layout-grand.single-portfolio .single-share-portfolio ul').addClass('no-active');
                    });
                    $('.df-layout-grand.single-portfolio .single-share-portfolio ul').mouseenter(function() {
                        $(this).removeClass('no-active');
                    });
                    $('.df-layout-grand.single-portfolio .single-share-portfolio ul').mouseleave(function() {
                        $(this).addClass('no-active');
                    });
                
                    // like button
                    $('.df-like').click(function() {
                        var $likeLink = $(this);
                        var $id = $(this).attr('id');

                        if ($likeLink.hasClass('liked'))
                            return false;
                        var $dataToPass = {
                            action: 'df_like',
                            likes_id: $id
                        }
                        var like = $.post(dfLike.ajaxurl, $dataToPass, function(data) {
                            $likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
                            $likeLink.find('span').css('opacity', 1);
                        });
                        return false;
                    });
                    // owl slider
                    var grand = $('body').hasClass("df-layout-grand");
                    if (grand) {
                        $(".slider-gallery-owl").owlCarousel({
                            navigation : true,
                            pagination: false,
                            slideSpeed : 300,
                            paginationSpeed : 400,
                            singleItem : true,
                            autoHeight : true,
                            navigationText: [
                                "<i class='df-arrow-grand-left'></i>",
                                "<i class='df-arrow-grand-right'></i>"
                            ],
                        });
                    }

                    $('audio').mediaelementplayer();
                    $('video').mediaelementplayer();
                    // pretty photo general
                    $(" a[rel^='prettyPhoto']").prettyPhoto();

                    // ipad menu carousel clash
                    if (dfGlobals.isiOS && jQuery('.owl-carousel, owl-wrapper').length) {
                        if (windowWidth < 480) {
                            jQuery('.sb-toggle-right').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(-80%)');
                            });
                        } else {
                            jQuery('.sb-toggle-right').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(-40%)');
                            });
                        }
                        if (windowWidth < 480) {
                            jQuery('.sb-toggle-left').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(80%)');
                            });
                        } else {
                            jQuery('.sb-toggle-left').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(40%)');
                            });
                        }
                     
                    };

                }); /*end callback*/
                // Infinite Scroll
            });
        </script>
        <?php
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Pagination infinite scroll display                                                  */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_pagenav_infinite_scroll')) :

    function df_pagenav_infinite_scroll() {
        df_infinite_scr();
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>
        <nav class="navigation paging-navigation col-full df-infi-scr" role="navigation">
            <div class="nav-links ">
                <?php if (get_next_posts_link()) : ?>
                    <div class="nav-next df-infi-scr">
                        <?php
                            next_posts_link(__('Next Page <i class="df-arrow-grand-right"></i>', 'dahztheme'));
                        ?>
                    </div>
                <?php endif; ?>

            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <?php
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Pagination infinite scroll button display js                                        */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_infinite_scr_btn')) :

    function df_infinite_scr_btn() {
        wp_enqueue_style('owl-carousel');
        wp_enqueue_style('wp-mediaelement');
        wp_enqueue_script('wp-playlist');
        ?>
        <script>
            jQuery(document).ready(function($) {
                var grand = $('body').hasClass("df-layout-grand");
                if (grand) {
                    var image_loader = '<?php echo get_template_directory_uri(); ?>/includes/images/loader.png'
                }

                var url = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname;
                var url_match = url.match(/-2/);

                if (url_match){
                    var infi_url = [url, "/"]
                }
                else{
                   var infi_url = '';
                }
                $('.df-main .entry-content ').infinitescroll({
                    navSelector: ".navigation",
                    nextSelector: ".nav-next a",
                    itemSelector: ".df-main .post, .df-main .portfolio",
                    path : infi_url,

                    loading: {
                        img: image_loader,
                        msgText: "<?php _e('', 'dahztheme'); ?>",
                        finishedMsg: "<?php _e('<p>All Post Loaded.</p>', 'dahztheme'); ?>"

                    }

                },
                function(arrayOfNewElems)
                {
                    // isotope append
                    jQuery('.df-blog-grid-standard, .df-portfolio-isotope').isotope('appended', arrayOfNewElems );
                    jQuery('.df-blog-grid-standard, .df-portfolio-isotope').imagesLoaded( function() {
                        jQuery('.df-blog-grid-standard, .df-portfolio-isotope').isotope('layout');
                    });
                    // youtube fitvid
                    $(".df-post-video").fitVids();

                    // share grand
                    $('.df-hover-share-container').mouseenter(function() {
                        $(this).addClass('df-share-content-active');
                    });
                    $('.df-hover-share-container').mouseleave(function() {
                        $(this).removeClass('df-share-content-active');
                    });
                    
                    // share single portfolio
                    $('.df-layout-grand.single-portfolio .single-share-portfolio .share-span').mouseenter(function() {
                        $('.df-layout-grand.single-portfolio .single-share-portfolio ul').removeClass('no-active');
                    });
                    $('.df-layout-grand.single-portfolio .single-share-portfolio .share-span').mouseleave(function() {
                        $('.df-layout-grand.single-portfolio .single-share-portfolio ul').addClass('no-active');
                    });
                    $('.df-layout-grand.single-portfolio .single-share-portfolio ul').mouseenter(function() {
                        $(this).removeClass('no-active');
                    });
                    $('.df-layout-grand.single-portfolio .single-share-portfolio ul').mouseleave(function() {
                        $(this).addClass('no-active');
                    });
                    
                    // like button
                    $('.df-like').click(function() {
                        var $likeLink = $(this);
                        var $id = $(this).attr('id');

                        if ($likeLink.hasClass('liked'))
                            return false;
                        var $dataToPass = {
                            action: 'df_like',
                            likes_id: $id
                        }
                        var like = $.post(dfLike.ajaxurl, $dataToPass, function(data) {
                            $likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
                            $likeLink.find('span').css('opacity', 1);
                        });
                        return false;
                    });
                    // owl slider
                    var grand = $('body').hasClass("df-layout-grand");
                    if (grand) {
                        $(".slider-gallery-owl").owlCarousel({
                            navigation : true,
                            pagination: false,
                            slideSpeed : 300,
                            paginationSpeed : 400,
                            singleItem : true,
                            autoHeight : true,
                            navigationText: [
                                "<i class='df-arrow-grand-left'></i>",
                                "<i class='df-arrow-grand-right'></i>"
                            ],
                        });
                    } 
                    $('audio').mediaelementplayer();
                    $('video').mediaelementplayer();
                    // pretty photo general
                    $(" a[rel^='prettyPhoto']").prettyPhoto();
                    // ipad menu carousel clash
                    if (dfGlobals.isiOS && jQuery('.owl-carousel, owl-wrapper').length) {
                        if (windowWidth < 480) {
                            jQuery('.sb-toggle-right').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(-80%)');
                            });
                        } else {
                            jQuery('.sb-toggle-right').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(-40%)');
                            });
                        }
                        if (windowWidth < 480) {
                            jQuery('.sb-toggle-left').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(80%)');
                            });
                        } else {
                            jQuery('.sb-toggle-left').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(40%)');
                            });
                        }
                     
                    };

                }); /*end callback*/
                $(window).unbind('.infscr');
                jQuery('.nav-next a').click(function() {
                    jQuery('.df-main .entry-content ').infinitescroll('retrieve');
                    return false;
                });
            });

            // Infinite Scroll
        </script>
        <?php
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Pagination infinite scroll button display                                           */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_pagenav_infinite_scroll_button')) :

    function df_pagenav_infinite_scroll_button() {


        df_infinite_scr_btn();
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>
        <nav class="navigation paging-navigation col-full df-infi-scr-btn" role="navigation">

            <div class="nav-links">


                <?php if (get_next_posts_link()) : ?>
                    <div class="nav-next ">
                        <?php next_posts_link(__('load more', 'dahztheme')); ?></div>
                <?php endif; ?>

            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <div class="clear"></div>
        <?php
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Pagination infinite scroll button with count display js                             */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_infinite_scr_btn_cnt')) :

    function df_infinite_scr_btn_cnt() {
        wp_enqueue_style('owl-carousel');
        wp_enqueue_style('wp-mediaelement');
        wp_enqueue_script('wp-playlist');
        ?>
        <script>
            jQuery(document).ready(function($) {
                var grand = $('body').hasClass("df-layout-grand");
                if (grand) {
                    var image_loader = '<?php echo get_template_directory_uri(); ?>/includes/images/loader.png'
                }
                var url = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname;
                var url_match = url.match(/-2/);

                if (url_match){
                    var infi_url = [url, "/"]
                }
                else{
                   var infi_url = '';
                }

                var count_post = $(".entry-content .post, .entry-content .portfolio").length;
                $(".df-infi-scrl-count .count-value").append('<span>' + count_post + '</span>');
 
                $('.df-main .entry-content ').infinitescroll({
                    navSelector: ".navigation",
                    nextSelector: ".nav-next a",
                    itemSelector: ".df-main .post, .df-main .portfolio",
                    path : infi_url,
                    loading: {
                        img:image_loader,
                        msgText: "<?php _e('', 'dahztheme'); ?>",
                        finishedMsg: "<?php _e('<p>All Post Loaded.</p>', 'dahztheme'); ?>"

                    }

                },
                function(arrayOfNewElems)
                {
                    // isotope append
                    jQuery('.df-blog-grid-standard, .df-portfolio-isotope').isotope('appended', arrayOfNewElems );
                    jQuery('.df-blog-grid-standard, .df-portfolio-isotope').imagesLoaded( function() {
                        jQuery('.df-blog-grid-standard, .df-portfolio-isotope').isotope('layout');
                    });
                    // youtube fitvid
                    $(".df-post-video").fitVids();

                    // share grand
                    $('.df-hover-share-container').mouseenter(function() {
                        $(this).addClass('df-share-content-active');
                    });
                    $('.df-hover-share-container').mouseleave(function() {
                        $(this).removeClass('df-share-content-active');
                    });
                    
                    // share single portfolio
                    $('.df-layout-grand.single-portfolio .single-share-portfolio .share-span').mouseenter(function() {
                        $('.df-layout-grand.single-portfolio .single-share-portfolio ul').removeClass('no-active');
                    });
                    $('.df-layout-grand.single-portfolio .single-share-portfolio .share-span').mouseleave(function() {
                        $('.df-layout-grand.single-portfolio .single-share-portfolio ul').addClass('no-active');
                    });
                    $('.df-layout-grand.single-portfolio .single-share-portfolio ul').mouseenter(function() {
                        $(this).removeClass('no-active');
                    });
                    $('.df-layout-grand.single-portfolio .single-share-portfolio ul').mouseleave(function() {
                        $(this).addClass('no-active');
                    });
                    
                    // like button
                    $('.df-like').click(function() {
                        var $likeLink = $(this);
                        var $id = $(this).attr('id');

                        if ($likeLink.hasClass('liked'))
                            return false;
                        var $dataToPass = {
                            action: 'df_like',
                            likes_id: $id
                        }
                        var like = $.post(dfLike.ajaxurl, $dataToPass, function(data) {
                            $likeLink.html(data).addClass('liked').attr('title', 'You already like this!');
                            $likeLink.find('span').css('opacity', 1);
                        });
                        return false;
                    });
                    // owl slider
                    var grand = $('body').hasClass("df-layout-grand");
                    if (grand) {
                        $(".slider-gallery-owl").owlCarousel({
                            navigation : true,
                            pagination: false,
                            slideSpeed : 300,
                            paginationSpeed : 400,
                            singleItem : true,
                            autoHeight : true,
                            navigationText: [
                                "<i class='df-arrow-grand-left'></i>",
                                "<i class='df-arrow-grand-right'></i>"
                            ],
                        });
                    } 

                    $(".df-infi-scrl-count .count-value span:first-child").remove();

                    var count_post = $(".entry-content .post, .entry-content .portfolio").length;
                    $(".df-infi-scrl-count .count-value").append('<span>' + count_post + '</span>');

                    $('audio').mediaelementplayer();
                    $('video').mediaelementplayer();
                    // pretty photo general
                    $(" a[rel^='prettyPhoto']").prettyPhoto();
                    // ipad menu carousel clash
                    if (dfGlobals.isiOS && jQuery('.owl-carousel, owl-wrapper').length) {
                        if (windowWidth < 480) {
                            jQuery('.sb-toggle-right').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(-80%)');
                            });
                        } else {
                            jQuery('.sb-toggle-right').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(-40%)');
                            });
                        }
                        if (windowWidth < 480) {
                            jQuery('.sb-toggle-left').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(80%)');
                            });
                        } else {
                            jQuery('.sb-toggle-left').on('touchend click', function(event) {
                                jQuery('#sb-site').css('-webkit-transform', 'translate(40%)');
                            });
                        }
                     
                    };
                }); /*end callback*/





                $(window).unbind('.infscr');
                jQuery('.nav-next a').click(function() {
                    jQuery('.df-main .entry-content ').infinitescroll('retrieve');
                    return false;
                });
            });
            // Infinite Scroll
        </script>
        <?php
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Pagination infinite scroll button with count display                                */
/* ----------------------------------------------------------------------------------- */

if (!function_exists('df_pagenav_infinite_scroll_button_count')) :

    function df_pagenav_infinite_scroll_button_count() {

        df_infinite_scr_btn_cnt();
        // Don't print empty markup if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>
        <nav class="navigation paging-navigation col-full df-infi-scr-btn" role="navigation">

            <div class="nav-links">

                <?php $count_posts = wp_count_posts(get_post_type())->publish;
                ?>
                <?php if (get_next_posts_link()) : ?>
                    <div class="nav-next ">
                        <?php next_posts_link(sprintf(__('load more <span class="df-infi-scrl-count">(showing <span class="count-value"></span> / %s )</span>', 'dahztheme'), $count_posts)); ?></div>
                    <?php endif; ?>

            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
        <div class="clear"></div>
        <?php
    }

endif;


/* ----------------------------------------------------------------------------------- */
/* Pagination inside single post                             */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_custom_nextpage_links')) :

function df_custom_nextpage_links($defaults) {
        $args = array(
            'before' => '<div class="my-paginated-posts"><p>' . __('Sections &#151;', 'dahztheme'),
            'after' => '</p></div>',
        );
        $r = wp_parse_args($args, $defaults);
        return $r;
    }
    add_filter('wp_link_pages_args','df_custom_nextpage_links');
endif;


/* ----------------------------------------------------------------------------------- */
/* Password protected change form                             */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_password_form')) :

function df_password_form() {
        global $post;
        $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
        $output = '<div class="password-form">
        <p class="protected-text">' . __('This post is password protected. To view it, please enter your password below:', 'dahztheme') . '</p>
        <form action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
        <p><input name="post_password" id="' . $label . '" type="password" size="20" /> <input placeholder="password" type="submit" name="submit" value="' . esc_attr__('Submit') . '" /></p></form></div>';
        return $output;
    }
    add_filter('the_password_form','df_password_form');
endif;

 

/* ----------------------------------------------------------------------------------- */
/* Mobile Menu Top (header)                                                            */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_mobile_menu_header')) :

    function df_mobile_menu_header() {
        if (!class_exists('UberMenu')) {

            $toogle_class = 'sb-toggle-left';
            $mobile_menu_position = df_options('mobile_menu_position');
            if ($mobile_menu_position == 'sb-left') {
                $toogle_class = 'sb-toggle-left';
            }
            else{
                $toogle_class = 'sb-toggle-right';
            }
            ?>
                <ul class="df-mobile-toogle-nav">
                    <li class="<?php echo $toogle_class; ?>"><i class="df-menu"></i> </li>
                </ul>
            <?php 
        }/*uber menu class exist*/
    }

endif;

/* ----------------------------------------------------------------------------------- */
/* Mobile Menu footer (footer)                                                         */
/* ----------------------------------------------------------------------------------- */
if (!function_exists('df_mobile_menu_footer')) :

    function df_mobile_menu_footer() {
        if (!class_exists('UberMenu')) {
        $mobile_menu_skin = df_options('mobile_menu_skin');
        $mobile_menu_position = df_options('mobile_menu_position');

            ?>
            <div class="sb-slidebar <?php echo $mobile_menu_position; ?> sb-momentum-scrolling <?php echo $mobile_menu_skin; ?>">
                <ul class="mobile-search-cart">

                    <?php 

                        // WooCommerce Topbar // mod-woocommerce/wc-mini-cart.php 
                        // if(is_woocommerce_activated()){ 
                        //   echo "<li class='mini-cart-mobile-menu'>";
                        //   echo df_woocommerce_add_nav_cart_link(); 
                        //   echo "</li>";
                        // }
                        

                    ?>
      
                    <li class="search-mobile-menu">
                        <form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div>
                                <input type="text" value="<?php echo esc_attr(get_search_query()); ?>" name="s" class="s" />
                            </div>
                        </form>
                    </li>   
                </ul>
            <nav id="df-mobile-nav" class="mobile-primary-menu df-mobile-menu" role="navigation">
              
                <?php
                if( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary-menu' )){
                 wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'df-navi' ) );
                } else {
                echo sprintf('<ul class="df-navi"><li><a href="%swp-admin/nav-menus.php">Assign a Menu</a></li></ul>', esc_url( home_url( '/' ) ));
                }
                  ?>
            </nav><!-- #site-navigation -->
            <?php if( df_options('header_topbar') == 1): ?>

            <nav class="mobile-top-menu df-mobile-menu" role="navigation">

            <?php 
                if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'top-menu' ) ) {
                    wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_class' => 'df-navi', 'theme_location'  => 'top-menu' ) );
                }
            ?>
            </nav><!-- #site-navigation -->
            
            <?php 
                // booking top bar
                if (class_exists('Dahzhotelbooking') && df_options('hotel_reservation_top')) {
                echo "<div class='menu-mobile-reservation'>";
                    echo '<a href="'. esc_url(df_options('hotel_link_booking_mobile')).'"><span class=" button">'._x('Reservation', 'dahztheme').'</span></a>';
                echo "</div>";
                }


                // social connect
                df_social_connect(); 

                endif; /*end if Topbar*/
            ?>
            </div> <!-- sb-sidebar -->
         <?php 
        }/*uber menu class exist*/
    }

endif;

/*------------------------------------------------------------------------------------ */
/* Page Loader                                                                         */
/* ----------------------------------------------------------------------------------- */
if(!function_exists('df_loading_spinners')) {
    function df_loading_spinners($return = false) {
        $loading_animation = df_options('loading_animation');
        $loading_animation_style = df_options('loading_animation_style');
         
        if($loading_animation == 1){
            switch ($loading_animation_style) {
                case "pulse":
                    $spinner_html = df_loading_spinner_pulse();
                break;
                case "double_pulse":
                    $spinner_html =  df_loading_spinner_double_pulse();
                break;
                case "cube":
                    $spinner_html =  df_loading_spinner_cube();
                break;
                case "rotating_cubes":
                    $spinner_html =  df_loading_spinner_rotating_cubes();
                break;
                case "stripes":
                    $spinner_html =  df_loading_spinner_stripes();
                break;
                case "wave":
                    $spinner_html =  df_loading_spinner_wave();
                break;
                case "two_rotating_circles":
                    $spinner_html =  df_loading_spinner_two_rotating_circles();
                break;
                case "five_rotating_circles":
                    $spinner_html =  df_loading_spinner_five_rotating_circles();
                break;
            }
        }else{
            $spinner_html = df_loading_spinner_pulse();
        }

        if($return === true) {
            return $spinner_html;
        }

        echo $spinner_html;
    }
}

if(!function_exists('df_loading_spinner_pulse')) {
    function df_loading_spinner_pulse() {
        $loading_animation_image = df_options('loading_animation_color');

        $html = '';
        $html .= '<div class="pulse" style="background-color:'.$loading_animation_image.'"></div>';
        return $html;
    }
}

if(!function_exists('df_loading_spinner_double_pulse')) {
    function df_loading_spinner_double_pulse() {
        $loading_animation_image = df_options('loading_animation_color');

        $html = '';
        $html .= '<div class="double_pulse">';
        $html .= '<div class="double-bounce1" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="double-bounce2" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('df_loading_spinner_cube')) {
    function df_loading_spinner_cube() {
        $loading_animation_image = df_options('loading_animation_color');

        $html = '';
        $html .= '<div class="cube" style="background-color:'.$loading_animation_image.'"></div>';
        return $html;
    }
}

if(!function_exists('df_loading_spinner_rotating_cubes')) {
    function df_loading_spinner_rotating_cubes() {
        $loading_animation_image = df_options('loading_animation_color');

        $html = '';
        $html .= '<div class="rotating_cubes">';
        $html .= '<div class="cube1" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="cube2" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('df_loading_spinner_stripes')) {
    function df_loading_spinner_stripes() {
        $loading_animation_image = df_options('loading_animation_color');

        $html = '';
        $html .= '<div class="stripes">';
        $html .= '<div class="rect1" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="rect2" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="rect3" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="rect4" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="rect5" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';
        return $html;
    }
}

if(!function_exists('df_loading_spinner_wave')) {
    function df_loading_spinner_wave() {
        $loading_animation_image = df_options('loading_animation_color');

        $html = '';
        $html .= '<div class="wave">';
        $html .= '<div class="bounce1" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="bounce2" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="bounce3" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('df_loading_spinner_two_rotating_circles')) {
    function df_loading_spinner_two_rotating_circles() {
        $loading_animation_image = df_options('loading_animation_color');

        $html = '';
        $html .= '<div class="two_rotating_circles">';
        $html .= '<div class="dot1" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="dot2" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';

        return $html;
    }
}

if(!function_exists('df_loading_spinner_five_rotating_circles')) {
    function df_loading_spinner_five_rotating_circles() {
        $loading_animation_image = df_options('loading_animation_color');

        $html = '';
        $html .= '<div class="five_rotating_circles">';
        $html .= '<div class="spinner-container container1">';
        $html .= '<div class="circle1" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="circle2" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="circle3" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="circle4" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';
        $html .= '<div class="spinner-container container2">';
        $html .= '<div class="circle1" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="circle2" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="circle3" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="circle4" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';
        $html .= '<div class="spinner-container container3">';
        $html .= '<div class="circle1" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="circle2" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="circle3" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '<div class="circle4" style="background-color:'.$loading_animation_image.'"></div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
 
/*------------------------------------------------------------------------------------ */
/* float menu                                                                        */
/* ----------------------------------------------------------------------------------- */
 if (!function_exists('df_float_menu')) :

    function df_float_menu() {
        $site_title = get_bloginfo('name');
        $site_description = get_bloginfo( 'description' );
        $df_logo = df_options('logo');
        $df_mobile_logo = df_options('mobile_logo');
        $header_navbar_position = df_options('header_navbar_position');
        $df_logo_target_link = home_url( '/' );
        $df_float_menu = df_options('menu_float_setting');
        if ($df_float_menu != '1') {
        ?>
         <div class="df-float-menu">
            <div class="df-navibar-inner df_container-fluid">

                <div class="site-branding">
                    <h1 class="site-title hide">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php df_sitename_class(); ?>" rel="home"><?php $site_title ; ?></a>
                    </h1>
                    <a href="<?php echo esc_url( $df_logo_target_link ); ?>" class="<?php df_sitename_class(); ?>" rel="home"> <?php echo ( $df_logo == '' ) ? $site_title : '<img src="' . esc_url($df_logo) . '" alt="' . $site_description . '">'; ?></a>
                    <a href="<?php echo esc_url( $df_logo_target_link ); ?>" class="<?php df_sitename_class(); ?> mobile-logo" rel="home"> <?php echo ( $df_mobile_logo == '' ) ? $site_title : '<img src="' . esc_url($df_mobile_logo) . '" alt="' . $site_description . '">'; ?></a>
                </div>
                
                <?php df_mobile_menu_header(); ?>
                
                <nav class="main-navigation" role="navigation">
                <?php 
                df_navbar_menu( array(
                    'menu_wraper'       => '<ul id="df-float-main-nav" class="df-navi">%MENU_ITEMS%' . "\n" . '</ul>',
                    'menu_items'        =>  "\n" . '<li class="%ITEM_CLASS%"><a href="%ITEM_HREF%"%ESC_ITEM_TITLE%>%ICON%<span>%ITEM_TITLE%%SPAN_DESCRIPTION%</span></a>%SUBMENU%</li> ',
                    'submenu'           => '<ul class="sub-nav df_row-fluid">%ITEM%</ul>',
                    //'parent_clicable' => of_get_option( 'header-submenu_parent_clickable', true ),
                    'params'            => array( 'act_class' => 'act', 'please_be_mega_menu' => true ),
                ) ); 
                ?>
                </nav><!-- #site-navigation float -->
                
                
            </div><!-- .container fluid-->
        </div><!-- .df-navibar float-->
        <?php }  /*end if df_float_menu*/
    }/*end function*/

endif;

/*-----------------------------------------------------------------------------------*/
/* Ajax search header */
/*-----------------------------------------------------------------------------------*/

add_action('wp_head','df_ajax_custom_head');
function df_ajax_custom_head()
{
    echo '<script type="text/javascript">var ajaxurl = \''.admin_url('admin-ajax.php').'\';</script>';
}

add_action('wp_ajax_ajax_search', 'ajax_search');
add_action('wp_ajax_nopriv_ajax_search', 'ajax_search');
 
function ajax_search(){

global $post;
    
$s = $_POST['s'];
$args = array(
 
    's' => $s,
    'showposts' => -1,
    'post_status' => 'publish',
    'suppress_filters' => 0
);
    $query = new WP_Query($args);
    if($query->have_posts()) :
 
 
    echo "<div class='search_que_post2'>";
    echo "<div class='divider_search'></div>";

    $i = 0;
    while ($query->have_posts()) : $query->the_post(); ?>

        <?php 
            $post_type = get_post_type( $post->ID );
        ?>
             <div id="result-<?php echo $post->ID; ?>"  class="ajax-search-result">
                <?php  
                 if ( has_post_thumbnail()){ ?>
                    <div class='df-search-image'>
                        <a class="image_thum_post" href="<?php esc_url(the_permalink()); ?>" title="<?php the_title_attribute(); ?>" >
                           <?php  the_post_thumbnail('ajax-search-thumb'); ?>    
                        </a>
                    </div>
                <?php } else {  

                $url_src = esc_url(get_template_directory_uri() . '/includes/images/');
                echo "<div class='df-search-image'>";
                echo '<a href="' . esc_url(get_permalink(get_the_ID())) . '" rel="bookmark" title="">';
                echo '<img src="' . $url_src . 'search.jpg" class="" alt="">';
                echo "</div>";
                echo "</a>";


                 } ?>
                <div class="df-search-content">
                   <h4><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h4>  
                   <p> <?php echo get_post_type(); ?> </p>
                </div>            
            </div>
            <div class="clear"></div>
        <?php $i +=1; ?> 

    <?php endwhile;
    else : 
    ?>

    <div id="result-not-found">
        <h3 class="counter_search"> <?php _e('Your search did not match any post. Try different keyword.','dahztheme'); ?> </h3>
    </div>

    <?php
    endif;
    die();
}


/*-----------------------------------------------------------------------------------*/
/* Browser and operating system body class */
/*-----------------------------------------------------------------------------------*/
if (!function_exists('df_browser_body_class')) :

function df_browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        if($is_lynx) $classes[] = 'lynx';
        elseif($is_gecko) $classes[] = 'gecko';
        elseif($is_opera) $classes[] = 'opera';
        elseif($is_NS4) $classes[] = 'ns4';
        elseif($is_safari) $classes[] = 'safari';
        elseif($is_chrome) $classes[] = 'chrome';
        elseif($is_IE) {
                $classes[] = 'ie';
                if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
                $classes[] = 'ie'.$browser_version[1];
        } else $classes[] = 'unknown';
        if($is_iphone) $classes[] = 'iphone';
        if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
                 $classes[] = 'osx';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
                 $classes[] = 'linux';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
                 $classes[] = 'windows';
           }
        return $classes;
}
add_filter('body_class','df_browser_body_class');
endif;

/*-----------------------------------------------------------------------------------*/
/* contact form 7 other browser error */
/*-----------------------------------------------------------------------------------*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
    if (!function_exists('df_contact_form_datepicker')) :
        function df_contact_form_datepicker() {
             wp_enqueue_script( 'jquery-ui-datepicker' );
        }
        add_action( 'wp_enqueue_scripts', 'df_contact_form_datepicker', 0 );

    endif;
}
