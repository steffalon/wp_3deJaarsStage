<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newszine
 */

get_header(); ?>
	<section class="news-body">
		<div class="container-fluid">
			<div class="row">

				<?php
				$class = 'col-md-12';
				$sidebar =  get_theme_mod( 'archive_sidebar_position','right' );
				if ( !empty ( $sidebar ) && $sidebar != 'none') {
					$class = 'col-md-9';
				}
				?>
				<!-- Sidebar -->
				<?php if ($sidebar == 'left'){ get_sidebar('left','newszine'); } ?>


				<div class="<?php echo $class; ?>">

                  
					<div class="block">
						<?php if ( have_posts() ) : ?>

						<?php if ( is_home() && ! is_front_page() ) : ?>
						<header>
							<h1 class="block-title"><?php single_post_title(); ?></h1>
						</header>

						<?php endif; ?>


							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();
            
								/*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
								get_template_part( 'template-parts/content', get_post_format() );

								?>

							<?php endwhile; ?>

							<!-- Pagination -->
							<div class="newszine-pagination">
                            <?php the_posts_pagination( array(
                                'mid_size' => 2,
                                'prev_text' => __( '<<', 'newszine' ),
                                'next_text' => __( '>>', 'newszine' ),
                            ) ); ?>
                            </div>
						<?php else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>

					</div>

				</div>


				<!-- Sidebar -->
				<?php if ($sidebar == 'right'){ get_sidebar('right','newszine'); } ?>


			</div>
		</div>
	</section>

<?php
get_footer();
