<?php




function dahztheme_testimonials_custom ( $args = '' ) {
    global $post, $more;

    $defaults = apply_filters( 'dahztheme_testimonials_default_args', array(
        'limit'             => 5,
        'per_row'           => null,
        'orderby'           => 'menu_order',
        'order'             => 'DESC',
        'id'                => 0,
        'display_author'    => true,
        'display_avatar'    => true,
        'display_url'       => true,
        'effect'            => 'fade', // Options: 'fade', 'none'
        'echo'              => true,
        'size'              => 50,
        'title'             => '',
        'before'            => '<div class="widget widget_dahzthemes_testimonials">',
        'after'             => '</div>',
        'before_title'      => '<h2>',
        'after_title'       => '</h2>',
        'category'          => 0,
        'position'          => 'left', //  Options: 'left', 'center', 'right'
        'id_testimonial_slider' => 0,
        'testimonial_slider' => true,
    ) );

    $args = wp_parse_args( $args, $defaults );

    // Allow child themes/plugins to filter here.
    $args = apply_filters( 'dahztheme_testimonials_args', $args );
    $html = '';

    do_action( 'dahztheme_testimonials_before', $args );

        // The Query.
        $query = get_testimonials( $args );

        // The Display.
        if ( ! is_wp_error( $query ) && is_array( $query ) && count( $query ) > 0 ) {

            $class = '';
            $position = '';

            if ( is_numeric( $args['per_row'] ) ) {
                $class .= ' columns-' . intval( $args['per_row'] );
            }

            if ( 'none' != $args['effect'] ) {
                $class .= ' effect-' . $args['effect'];
            }

            $html .= $args['before'] . "\n";
            if ( '' != $args['title'] ) {
                $html .= $args['before_title'] . esc_html( $args['title'] ) . $args['after_title'] . "\n";
            }
            if ($args['testimonial_slider'] == "true") {
                $html .= '<div class="testimonials slider-testimonial-active component' . esc_attr( $class ) . '">' . "\n";
            } else {
                $html .= '<div class="testimonials component' . esc_attr( $class ) . '">' . "\n";

            }
            $html .= '<div class="testimonials-list">' . "\n";

            if ('' != $args['position']) {
                $position .= ' position_' . $args['position'];
            }
            $html .= '<div class="testimonials'. esc_attr( $position ) .'">' . "\n";
            if ($args['testimonial_slider'] == "true") {
                wp_enqueue_style('owl-carousel');
                $html .= '<div id="'.$args['id_testimonial_slider'].'" class="owl-carousel slider-testimonial">';
            }

            // Begin templating logic.
            $tpl = '<div id="quote-%%ID%%" class="%%CLASS%%" itemprop="review" itemscope itemtype="http://schema.org/Review"><p class="testimonials-text" itemprop="reviewBody">%%TEXT%%</p>%%AVATAR%% %%AUTHOR%%</div>';
            $tpl = apply_filters( 'dahztheme_testimonials_item_template', $tpl, $args );

            $count = 0;
            foreach ( $query as $post ) { $count++;
                $template = $tpl;

                $css_class = 'quote';
                if ( ( is_numeric( $args['per_row'] ) && ( $args['per_row'] > 0 ) && ( 0 == ( $count - 1 ) % $args['per_row'] ) ) || 1 == $count ) { $css_class .= ' first'; }
                if ( ( is_numeric( $args['per_row'] ) && ( $args['per_row'] > 0 ) && ( 0 == $count % $args['per_row'] ) ) || count( $query ) == $count ) { $css_class .= ' last'; }

                // Add a CSS class if no image is available.
                if ( isset( $post->image ) && ( '' == $post->image ) ) {
                    $css_class .= ' no-image';
                }

                setup_postdata( $post );

                $author = '';
                $author_text = '';

                // If we need to display the author, get the data.
                if ( ( get_the_title( $post ) != '' ) && true == $args['display_author'] ) {
                    $author .= '<cite class="author" itemprop="author" itemscope itemtype="http://schema.org/Person">';

                    //$author .= $author_name;

                    if ( isset( $post->byline ) && '' != $post->byline ) {
                        $author .= ' <span class="title " itemprop="jobTitle">&mdash; ' . get_the_title( $post ) .' '. $post->byline . '</span><!--/.title-->' . "\n";
                    }
                    else{
                        $author .= '<span itemprop="name">&mdash; ' . get_the_title( $post ) . ' </span>';
                    }

                    // if ( true == $args['display_url'] && '' != $post->url ) {
                    //     $author .= ' <span class="url"><a href="' . esc_url( $post->url ) . '" itemprop="url">' . apply_filters( 'dahztheme_testimonials_author_link_text', $text = esc_url( $post->url ) ) . '</a></span><!--/.excerpt-->' . "\n";
                    // }

                    $author .= '</cite><!--/.author-->' . "\n";

                    // Templating engine replacement.
                    $template = str_replace( '%%AUTHOR%%', $author, $template );
                } else {
                    $template = str_replace( '%%AUTHOR%%', '', $template );
                }

                // Templating logic replacement.
                $template = str_replace( '%%ID%%', get_the_ID(), $template );
                $template = str_replace( '%%CLASS%%', esc_attr( $css_class ), $template );

                if ( isset( $post->image ) && ( '' != $post->image ) && true == $args['display_avatar'] && ( '' != $post->url ) ) {
                    $template = str_replace( '%%AVATAR%%', '<a href="' . esc_url( $post->url ) . '" class="avatar-link">' . $post->image . '</a>', $template );
                } elseif ( isset( $post->image ) && ( '' != $post->image ) && true == $args['display_avatar'] ) {
                    $template = str_replace( '%%AVATAR%%', $post->image, $template );
                } else {
                    $template = str_replace( '%%AVATAR%%', '', $template );
                }

                // Remove any remaining %%AVATAR%% template tags.
                $template   = str_replace( '%%AVATAR%%', '', $template );
                $real_more  = $more;
                $more       = 0;
                $content    = apply_filters( 'dahztheme_testimonials_content', apply_filters( 'the_content', get_the_content( __( 'Read full testimonial...', 'dahztheme' ) ) ), $post );
                $more       = $real_more;
                $template   = str_replace( '%%TEXT%%', $content, $template );

                // Assign for output.
                $html .= $template;

                if( is_numeric( $args['per_row'] ) && ( $args['per_row'] > 0 ) && ( 0 == $count % $args['per_row'] ) ) {
                    $html .= '<div class="clearfix"></div>' . "\n";
                }
            }

            wp_reset_postdata();

            $html .= '</div><!--/.testimonials-list-->' . "\n";
            $html .= '</div><!--/.testimonials-component-->' . "\n";
            if ($args['testimonial_slider'] == "true") {
                $html .= '</div><!--/.testimonials-slider-->' . "\n";
            }

            $html .= '<div class="clearfix"></div>' . "\n";
            $html .= '</div><!--/.testimonials-->' . "\n";
            $html .= $args['after'] . "\n";
        }

        // Allow child themes/plugins to filter here.
        $html = apply_filters( 'dahztheme_testimonials_html', $html, $query, $args );

        if ( $args['echo'] != true ) { return $html; }

        // Should only run is "echo" is set to true.
        echo $html;

        do_action( 'dahztheme_testimonials_after', $args ); // Only if "echo" is set to true.
} // End dahztheme_testimonials()

 