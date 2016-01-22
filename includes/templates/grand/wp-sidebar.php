<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * =======================================================================
 * TEMPLATES/GRAND/WP-SIDEBAR.PHP
 * =======================================================================
 * The Sidebar containing the main widget areas.
 *
 * If no active custom settings panel in page/post, global default options will take place.
 * ======================================================================== */

global $post, $wp_query;
$layout = df_get_layout_content_class();

if ( 'one-col' != $layout ) : ?>


        <div id="secondary" class="widget-area df-sidebar" role="complementary">

            <?php if(class_exists('sidebar_generator') && is_page()) { 

                 do_action('before_sidebar'); 
                    generated_dynamic_sidebar(); 

                } else { ?>
                
            <?php do_action('before_sidebar'); ?>
            <?php if (!dynamic_sidebar('primary')) : ?>

                <aside id="search" class="widget widget_search">
                    <?php get_search_form(); ?>
                </aside>

                <aside id="archives" class="widget">
                    <h3 class="widget-title"><?php _e('Archives', 'dahztheme'); ?></h3>
                    <ul>
                        <?php wp_get_archives(array('type' => 'monthly')); ?>
                    </ul>
                </aside>

                <aside id="meta" class="widget">
                    <h3 class="widget-title"><?php _e('Meta', 'dahztheme'); ?></h3>
                    <ul>
                        <?php wp_register(); ?>
                        <li><?php wp_loginout(); ?></li>
                        <?php wp_meta(); ?>
                    </ul>
                </aside>

            <?php endif; // end sidebar widget area ?>
        <?php } ?>
        </div><!-- #secondary -->


<?php endif; ?>