<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
    <div class="col-md-3">
        <aside class="home-sidebar" role="complementary">

            <?php dynamic_sidebar( 'sidebar-1' ); ?>

        </aside>
    </div> <!-- /.end of col 3 -->
<?php endif; ?>