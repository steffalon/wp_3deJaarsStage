<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newszine
 */

?>

<div class="category-single">
	<div class="image">

		<?php if (has_post_thumbnail()) : ?>
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php
				$args = array(
					'class' => 'img-responsive',
				);
				the_post_thumbnail( 'newszine-blog-thumb',$args ); ?>
			</a>
		<?php else : ?>
			
		<?php endif; ?>

	</div>
	<div class="content">
		<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h2>
		<h6 class="info">
			<i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
			<i class="fa fa-user"></i> <?php echo get_the_author_meta( 'display_name' )?>			
			<i class="fa fa-comments"></i> <?php comments_popup_link('0','1', '%');?>
		</h6>
	<?php echo  newszine_exrcept(30); ?>

		<span class="read-more pull-right"><a href="<?php the_permalink();?>" class="btn btn-theme" ><?php _e('Lees meer','newszine')?> <i class="fa fa-angle-double-right"></i></a></span>

		
	</div>
</div>
