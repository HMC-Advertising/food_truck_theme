<!DOCTYPE html>
<!--[if IE 9]><html class="no-js ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
    <head>
        <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
       <title><?php wp_title( '|', true, 'right' ); ?></title> 

        <?php dahz_meta(); ?>
        <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
<?php 
    df_float_menu(); 
    
    ?>

                <div id="wrapper">
                <?php 
                $page_transition = df_options('df_page_loader');
                $loading_animation_image = esc_url(df_options('loading_animation_image'));
                
                if($page_transition){ ?>
                    <div class="ajax_loader">
                        <div class="ajax_loader_1">
                            <?php if($loading_animation_image != ""){ ?>
                            <div class="ajax_loader_2">
                                <img src="<?php echo $loading_animation_image; ?>" alt="" />
                            </div><?php } else{ df_loading_spinners(); } ?>
                        </div>
                    </div>
                <?php } ?>

                <div id="sb-site">
