<div class="container-fluid">
    <?php if ( is_active_sidebar( 'widget-1' ) ) : ?>
        <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
            <?php dynamic_sidebar( 'widget-1' ); ?>
        </div><!-- #primary-sidebar -->
    <?php endif; ?>
</div>