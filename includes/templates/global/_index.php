<?php if (have_posts()) : ?>
	
    <?php while (have_posts()) : the_post(); ?>
        <?php

        df_get_template(df_get_composer(), 'content', get_post_format());
        ?>
    <?php endwhile; ?>
    <?php df_pagenav(); ?>
<?php else : ?>
    <?php df_get_template('global', '_content-none'); ?>
<?php endif; ?>