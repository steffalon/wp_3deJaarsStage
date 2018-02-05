<?php
/**
 * Template Name: Fullwidth page
 * The template used for displaying fullwidth page content in fullwidth.php
 * @package newszine
 */

get_header(); ?>

	<section class="news-body">
		<div class="container-fluid">
			<div class="row">
				<?php while ( have_posts() ) : the_post(); ?>

					<div class="col-md-12">

						<!-- Breadcrumbs -->
						<div class="block">
							<?php echo newszine_theme_breadcrumbs(); ?>
						</div>

						<!-- Add Banner -->
						<?php if ( get_theme_mod( 'page_top_advertisement_disable' ) ) : ?>

							<div class="block">
								<?php if ( get_theme_mod( 'single_page_top_ad_type','img' ) == 'img') : ?>

									<?php $newszine_top_advertisement_id = get_theme_mod( 'page_top_advertisement_image' ); ?>
									<?php
									if ( is_numeric( $newszine_top_advertisement_id ) ) {
										$newszine_top_advertisement_url = wp_get_attachment_url( $newszine_top_advertisement_id );
									} else {
										$newszine_top_advertisement_url = get_theme_mod( 'page_top_advertisement_image' );
									}
									?>

									<img  src="<?php echo esc_url( $newszine_top_advertisement_url )?>" class="img-responsive pull-right" alt="">

								<?php else : ?>

									<?php echo $newszine_top_advertisement_textarea = get_theme_mod( 'page_top_advertisement_textarea' ); ?>

								<?php endif; ?>

							</div>

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
									<?php else : ?>
									   	
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
						<?php if ( get_theme_mod( 'page_bottom_advertisement_disable' ) ) : ?>
							<div class="block">

								<?php if ( get_theme_mod( 'single_page_bottom_ad_type','img' ) == 'img') : ?>

									<?php $newszine_bottom_advertisement_id = get_theme_mod( 'page_bottom_advertisement_image' ); ?>
									<?php
									if ( is_numeric( $newszine_bottom_advertisement_id ) ) {
										$newszine_bottom_advertisement_url = wp_get_attachment_url( $newszine_bottom_advertisement_id );
									} else {
										$newszine_bottom_advertisement_url = get_theme_mod( 'page_bottom_advertisement_image' );
									}
									?>
									<img src="<?php echo esc_url( $newszine_bottom_advertisement_url )?>" class="img-responsive pull-right" alt="">

								<?php else : ?>

									<?php echo $newszine_bottom_advertisement_textarea = get_theme_mod( 'page_bottom_advertisement_textarea' ); ?>

								<?php endif; ?>

							</div>
						<?php endif; ?>

					</div>

				<?php endwhile; // End of the loop. ?>

			</div>
		</div>
	</section>

<?php
get_footer();