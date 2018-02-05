<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package newszine
 */

get_header(); ?>

	<section class="news-body">
		<div class="container-fluid">
			<div class="row">

				<?php if ( have_posts() ) : ?>
					<?php
					$class = 'col-md-12';
					$sidebar =  get_theme_mod( 'search_sidebar_position','right' );
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

								<!-- .page-header -->
								<h1 class="block-title"><a href="" title=""><?php printf( esc_html__( 'Zoek resultaten voor: %s', 'newszine' ), '<span>' . get_search_query() . '</span>' ); ?></a></h1>

								<?php
								/* Start the Loop */
								while ( have_posts() ) : the_post();

									/**
									 * Run the loop for the search to output the results.
									 * If you want to overload this in a child theme then include a file
									 * called content-search.php and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'search' );

								endwhile; ?>

								<!-- Pagination -->
							<div class="newszine-pagination">
                            <?php the_posts_pagination( array(
                                'mid_size' => 2,
                                'prev_text' => __( '<<', 'newszine' ),
                                'next_text' => __( '>>	', 'newszine' ),
                            ) ); ?>
                            </div>

						</div>

					</div>

					<!-- Sidebar -->
					<?php if ($sidebar == 'right'){ get_sidebar('right','newszine'); } ?>

				<?php else : ?>

					<?php get_template_part( 'template-parts/content', 'none' ); ?>

				<?php endif; ?>


			</div>
		</div>
	</section>

<?php
get_footer();
