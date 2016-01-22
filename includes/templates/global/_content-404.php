<?php
$df_hide_search = df_options('hide_search_form');
$df_404_text = df_options('404_page_text');
?>


<section class="error-404 not-found">
    <div class="df_row-fluid">
        <div class="page-content df_span6">
            <div class="warpper-404">
                <div class="content-404">
                    <h1 class="header-404">Page Not Found</h1>
                    <?php
                    if ($df_404_text == '') {
                        echo '<p class="text-404">We`re sorry!<br />We can`t seem to find the page you`re looking for.<br />Please try your search again or go to <span class="df-grand-link"><a href="' . esc_url(get_home_url()) . '">Homepage</a></span></p>';
                    } else {
                        echo '<p class = "text-404">' .esc_attr($df_404_text) . '</p>';
                    }

                    if ($df_hide_search == '0') {
                        get_search_form();
                    }
                    ?>
                </div>
            </div>
        </div><!-- .page-content -->
    </div>
</section><!-- .error-404 -->
