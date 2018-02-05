<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newszine
 */

?>
<?php
$class = 'col-md-12';
$sidebar =  get_theme_mod( 'page_sidebar_position','right' );
if ( !empty ( $sidebar) && $sidebar != 'none') {
	$class = 'col-md-9';
}
?>

<!-- Sidebar -->
<?php if ($sidebar == 'left'){ get_sidebar('left','newszine'); } ?>

<div class="<?php echo $class; ?>">

	<!-- Breadcrumbs -->
	<div class="block">
		<?php echo newszine_theme_breadcrumbs(); ?>
	</div>

	<!-- Add Banner -->

		<?php if ( is_active_sidebar( 'single_page_advertisment' ) ) : ?>                      
            <?php dynamic_sidebar( 'single_page_advertisment' ); ?>                       
        <?php endif; ?>
	<!-- Contents -->
	<div class="block">
		<div class="single-post">
			<div class="image">

				<?php if (has_post_thumbnail()) : ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php
						$args = array(
							'class' => 'img-responsive center-block',
						);
						the_post_thumbnail( 'newszine-post-thumb',$args ); ?>
					</a>
				

				<?php endif; ?>

			</div>
			<div class="content">
				<h2 class="title"><?php the_title(); ?></h2>
				<div class="user-content">
					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'newszine' ),
						'after'  => '</div>',
					) );
					?>
				</div>
				
			</div>
			<footer>
				<?php
				edit_post_link(
					sprintf(
					/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'newszine' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
				?>
			</footer><!-- .entry-footer -->
		</div>


	</div>

	<!-- Add Banner -->
	
		<?php if ( is_active_sidebar( 'single_page_advertisment' ) ) : ?>                      
            <?php dynamic_sidebar( 'single_page_advertisment' ); ?>                       
        <?php endif; ?>
	</div>

<!-- Sidebar -->
<?php if ($sidebar == 'right'){ get_sidebar('right','newszine'); } ?>

