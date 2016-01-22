<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (!is_singular()): ?>
        <header class="entry-header">
            <h2 class="entry-title"><?php the_title(); ?></h2>
        </header><!-- .entry-header -->
    <?php endif; ?>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . __('Pages:', 'dahztheme'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->
    <div class="clear"></div>
    <?php edit_post_link(__('Edit', 'dahztheme'), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>'); ?>

</article><!-- #post-## -->