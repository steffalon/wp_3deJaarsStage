<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newszine
 */

?>

<section class="news-body">
	<div class="container-fluid">
		<div class="row">
			<?php
			$class = 'col-md-12';
			$sidebar =  get_theme_mod( 'not_found_sidebar_position','right' );
			if ( !empty ( $sidebar ) && $sidebar != 'none') {
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

				<div class="block">
					<h1 class="block-title"><a href="" title=""><?php esc_html_e( 'Niks gevonden.', 'newszine' ); ?></a></h1>

					<div class="not-found">
						<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

							<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'newszine' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

						<?php elseif ( is_search() ) : ?>

							<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'newszine' ); ?></p>
							<?php get_search_form(); ?>

						<?php else : ?>

							<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'newszine' ); ?></p>
							<?php get_search_form(); ?>

						<?php endif; ?>

					</div>

				</div>

			</div>

			<!-- Sidebar -->
			<?php if ($sidebar == 'right'){ get_sidebar('right','newszine'); } ?>

		</div>
	</div>
</section><!-- .no-results -->
