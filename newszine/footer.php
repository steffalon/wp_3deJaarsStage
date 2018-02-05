<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package newszine
 */

?>

	<!-- Footer -->
<footer>
    <section class="footer-info">
        <div class="container-fluid">
            <div class="row">
                <?php if ( is_active_sidebar( 'footer-left' ) ) : ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="single">
                             <?php dynamic_sidebar( 'footer-left' ); ?>
                        </div>
                    </div>
                <?php endif; ?>


                <?php if ( is_active_sidebar( 'footer-middle' ) ) : ?>
                    <div class="col-md-3 col-sm-6">
                    <div class="single">
                        <?php dynamic_sidebar( 'footer-middle' ); ?>
                    </div>
                    </div>
                <?php endif; ?>
                
                <?php if ( is_active_sidebar( 'footer-middle2' ) ) : ?>
                    <div class="col-md-3 col-sm-6">
                    <div class="single">
                        <?php dynamic_sidebar( 'footer-middle2' ); ?>
                    </div>
                    </div>
                <?php endif; ?>

                <?php if ( is_active_sidebar( 'footer-right' ) ) : ?>
                    <div class="col-md-3 col-sm-6">
                    <div class="single">
                        <?php dynamic_sidebar( 'footer-right' ); ?>
                    </div>
                    </div>
                <?php endif; ?> 

            </div>
        </div>
    </section>

    <section class="copyright">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h6><?php echo esc_attr(get_theme_mod( 'copyright_textbox', 'Copyright &copy; 2018 Channel6' )); ?></h6>
                </div>
                    <div class="col-sm-6">
                        <h6 class="pull-right designby"><?php echo __('Developed By :','yLabs'); ?> <a href="http://ylabs.nl" rel="license"><?php echo __('yLabs'); ?></a></h6>
                    </div>
            </div>
        </div>
    </section>
</footer>


	<!-- Tab to top scrolling -->
    <?php $scrolltotop_disable= get_theme_mod('enable_scrolltotop','1');
        if($scrolltotop_disable==1):?>
    	<div class="scroll-top-wrapper">
    		<span class="scroll-top-inner">

    			<i class="fa fa-2x fa-angle-up"></i>

    		</span>
    	</div>
    <?php endif;?>
</div>

<?php wp_footer(); ?>

</body>
</html>
