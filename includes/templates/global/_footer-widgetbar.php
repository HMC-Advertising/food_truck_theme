<?php $df_options = get_theme_mod( 'df_options' ); ?>

<?php $col_extra = ( $df_options[ 'extra_footer_widget_columns' ] == '' ) ? 4 : $df_options[ 'extra_footer_widget_columns' ]; if ( $col_extra != 0 ) : ?>
<div class="footer-extra-widgets col-full">
	<div class="df_container-fluid">
    	<div class="df_row-fluid">

      <?php

      $i = 0; while ( $i < $col_extra ) : $i ++;
        switch ( $col_extra ) {
          case 4 : $span = 'df_span-md-3';  break;
          case 3 : $span = 'df_span-md-4';  break;
          case 2 : $span = 'df_span-md-6';  break;
          case 1 : $span = 'df_span-md-12'; break;
        }
        echo '<div class="' . $span . '">';
          dynamic_sidebar( 'extra-footer-' . $i );
        echo '</div>';
      endwhile;

      ?>

    	</div> <!-- end .df_row-fluid -->
  	</div> <!-- end .df_container-fluid -->
	
</div><!-- .footer-extra-widgets -->
<?php endif; ?>

<?php $col_primary = ( $df_options[ 'primary_footer_widget_columns' ] == '' ) ? 6 : $df_options[ 'primary_footer_widget_columns' ]; if ( $col_primary != 0 ) : ?>
<div class="footer-primary-widgets col-full">
		<div class="df_container-fluid">
    	<div class="df_row-fluid">

      <?php

      $i = 0; while ( $i < $col_primary ) : $i ++;
        switch ( $col_primary ) {
          case 6 : $span = 'df_span-md-2';  break;
          case 5 : $span = 'df_span-col5';  break;
          case 4 : $span = 'df_span-md-3';  break;
          case 3 : $span = 'df_span-md-4';  break;
          case 2 : $span = 'df_span-md-6';  break;
          case 1 : $span = 'df_span-md-12'; break;
        }
        echo '<div class="' . $span . '">';
          dynamic_sidebar( 'footer-' . $i );
        echo '</div>';
     endwhile;

      ?>

    	</div> <!-- end .df_row-fluid -->
  	</div> <!-- end .df_container-fluid -->
	
</div><!-- .footer-primary-widgets -->
<?php endif; ?>