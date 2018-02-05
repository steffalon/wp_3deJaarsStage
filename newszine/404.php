<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package newszine
 */

get_header(); ?>

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
						<h1 class="block-title"><a href="" title=""><?php esc_html_e( 'Oeps! De pagina kan niet worden gevonden.', 'newszine' ); ?></a></h1>

						<div class="not-found">

							<p><?php esc_html_e( 'Het lijkt erop dat de pagina niet bestaad.', 'newszine' ); ?></p>

							<?php get_search_form(); ?>

						</div>

					</div>

				</div>

				<!-- Sidebar -->
				<?php if ($sidebar == 'right'){ get_sidebar('right','newszine'); } ?>

			</div>
		</div>
	</section><!-- .no-results -->

<?php
get_footer();
