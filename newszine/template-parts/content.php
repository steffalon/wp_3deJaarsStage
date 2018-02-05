<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newszine
 */

?>
<?php $i=rand ( 1 , 1000 ) ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
				<?php elseif(get_theme_mod( 'default_images')) : ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark">
				<img src="<?php echo esc_attr(get_theme_mod( 'default_images'));?>" class="img-responsive" alt="">
				</a>
				<?php else: ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/images/n1.jpg' ); ?>" class="img-responsive" alt="">
				</a>
				<?php endif;?>


		</div>

		<div class="content">
			<h2 class="title"><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h2>
			<h6 class="info">
				<i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' geleden'; ?> 
				<i class="fa fa-user"></i> <?php echo get_the_author_meta( 'display_name' )?> 			
				<i class="fa fa-comments"></i> <?php comments_popup_link('0','1', '%');?>
			</h6>

			<?php echo  newszine_exrcept(70); ?>

			


		</div>
		
	</div>
</article>




