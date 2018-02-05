<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newszine
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>

		<div class="block">
			<h3 class="block-title">
				<?php
				printf( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title', 'newszine' ),
					number_format_i18n( get_comments_number() )
				);
				?>
			</h3>


			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
					<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'newszine' ); ?></h2>
					<div class="nav-links">

						<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'newszine' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'newszine' ) ); ?></div>

					</div><!-- .nav-links -->
				</nav><!-- #comment-nav-above -->
			<?php endif; // Check for comment navigation. ?>


			<?php wp_list_comments( array(
				'walker' => new Newszine_Comment_Walker,
				'style' => 'div',
				'callback' => null,
				'end-callback' => null,
				'type' => 'all',
				'page' => null,
				'avatar_size' => 32
			) ); ?><!-- .comment-list -->

		</div>



		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'newszine' ); ?></h2>
				<div class="nav-links">

					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'newszine' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'newszine' ) ); ?></div>

				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
			<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments zijn uitgezet.', 'newszine' ); ?></p>
	<?php endif; ?>

	<!-- Leave a comments -->
	<div class="block">
		<?php comment_form(); ?>
	</div>




</div><!-- #comments -->
