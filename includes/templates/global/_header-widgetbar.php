<?php
$col_extra = ( df_options('header_widget_bar') == '' ) ? 3 : df_options('header_widget_bar');
if ($col_extra != 0) :
    ?>

    <div class="header-widgets collapse col-full">
        <div class="header-widgets-inner df_container-fluid">
            <div class="df_row-fluid">

                <?php
                $i = 0;
                while ($i < $col_extra) : $i ++;
                    switch ($col_extra) {
                        case 4 : $span = 'df_span-sm-3';
                            break;
                        case 3 : $span = 'df_span-sm-4';
                            break;
                        case 2 : $span = 'df_span-sm-6';
                            break;
                        case 1 : $span = 'df_span-sm-12';
                            break;
                    }
                    echo '<div class="' . $span . '">';
                    dynamic_sidebar('header-widgetbar-' . $i);
                    echo '</div>';
                endwhile;
                ?>

            </div> <!-- end .df_row-fluid -->
        </div> <!-- end .df_container-fluid -->
    </div> <!-- .header-widgets -->
    <div class="df-widgetbar-button">
        <i>&#043;<span class="hide"><?php _e('Toggle the Widgetbar', 'dahztheme'); ?></span></i>
    </div>

<?php endif; ?>
