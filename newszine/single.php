<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package newszine
 */

get_header(); ?>

	<section class="news-body container-fluid">
		<div>
			<div class="row">
				<?php while ( have_posts() ) :  the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'single' ); ?>
				<?php endwhile; // End of the loop. ?>

			</div>
		</div>
	</section>

<?php
get_footer();
