<?php
$df_options =  get_theme_mod( 'df_options' );
$df_scroll_top_enable = $df_options[ 'scroll_top_enable' ];

if ( $df_scroll_top_enable == 1 ) : ?>
	<a class="scroll-top" href="#masthead" title="Back to Top">
		<i class="fa fa-angle-up"></i>
	</a>
<?php endif; ?>