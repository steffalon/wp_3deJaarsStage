<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newszine
 * @since   1.0.1
 */

get_header(); ?>
<?php if ( 'posts' != get_option( 'show_on_front' ) ): ?>
<?php if ( get_theme_mod( 'main_slider_disable','1' ) !='' ) : ?>
    <section class="main-slider">
        <div class="container-fluid">
            <div class="row">
                <div class="col col-sm-6 col-left">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php
                                $main_slider_catId = get_theme_mod( 'main_slider_category','1' );
                                $main_slider_catLink = get_category_link($main_slider_catId);
                                $main_slider_catName = get_category($main_slider_catId);
                                $args = array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'paged' => 1,
                                'posts_per_page' => 10,
                                'cat' => $main_slider_catId,
                                
                            );
                            $loop = new WP_Query($args);
                            $cn = 0;
                            if ( $loop->have_posts() ) :
                                while ($loop->have_posts()) : $loop->the_post(); $cn++; ?>
                                    <div class="item <?php if ( $cn == 1 ) { echo 'active';} ?>">                                    
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
                                         <img src="<?php echo esc_url(get_theme_mod( 'default_images'));?>" class="img-responsive" alt="">
                                        </a>
                                        <?php else: ?>
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/n1.jpg' ); ?>" class="img-responsive" alt="">
                                        </a>
                                        <?php endif;?>
                                        
                                        
                                        <div class="carousel-caption">
                                            <?php $slider_cat_disable= get_theme_mod('main_slider_category_disable','1');
                                            if($slider_cat_disable):?>
                                                <h5 class="category">
                                                    <a href="<?php echo esc_url( $main_slider_catLink ); ?>" title="" rel="bookmark">
                                                        <?php echo esc_attr( get_cat_name( $main_slider_catId ) );?>
                                                    </a>
                                                </h5>
                                            <?php endif;?>
                                            <?php $slider_display_disable= get_theme_mod('main_slider_publishdate_disable','1'); ?>
                                                <h2>
                                                    <a href="<?php the_permalink(); ?>" title="" rel="bookmark">
                                                     <?php the_title(); ?>
                                                    </a>
                                                </h2>
                                            <?php if($slider_display_disable): ?>
                                                <p>
                                                    <i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> 
                                                    <i class="fa fa-user"></i> <?php echo get_the_author_meta( 'display_name'); ?> 
                                                   
                                                </p>
                                            <?php endif;?>
                                        </div>
                                    </div>
                            <?php endwhile;
                            wp_reset_postdata();
                            endif;
                            ?>
                        
                            </div>                                      
                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="icon-next"></span>
                        </a>
                    
                    </div>
                </div>
                
                <div class="col col-sm-6 col-right">
                    <div class="col col-sm-12">
                        <div class="latest">
                        <?php
                            $slider_right_top_catId = get_theme_mod( 'slider_category_right_top','1' );
                            $slider_right_top_catLink = get_category_link($slider_right_top_catId);
                            $slider_right_top_catName = get_category($slider_right_top_catId);
                            $args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => 1,
                            'paged' => 1,
                            'cat' => $slider_right_top_catId,
                            
                        );
                        $loop = new WP_Query($args);
                        if ( $loop->have_posts() ) :
                            while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div class="latest">
                            
                                <?php if (has_post_thumbnail()) :                                    
                                    $args = array(
                                    'class' => 'img-responsive',
                                ); ?>
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php  the_post_thumbnail( 'newszine-post-thumb',$args ); ?>
                                </a>
                                <?php elseif(get_theme_mod( 'default_images')) : ?>
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                <img src="<?php echo esc_url(get_theme_mod( 'default_images'));?>" class="img-responsive" alt="">
                                </a>
                                <?php else: ?>
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/n1.jpg' ); ?>" class="img-responsive" alt="">
                                </a>
                                <?php endif;?>
                                
                                <div class="carousel-caption">
                                    <?php if($slider_cat_disable):?>
                                    <h5 class="category">
                                    <a href="<?php echo esc_url( $slider_right_top_catLink ); ?>" title="" rel="bookmark">
                                    <?php echo esc_attr( get_cat_name( $slider_right_top_catId ) );?>
                                    </a>
                                    </h5>
                                <?php endif; ?>
                                    <h2>
                                    <a href="<?php the_permalink();?>" title="" rel="bookmark">
                                    <?php the_title(); ?>
                                    </a>
                                    </h2>
                                    <?php if($slider_display_disable): ?>
                                    <p>
                                    <i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> 
                                    <i class="fa fa-user"></i> <?php echo get_the_author_meta( 'display_name'); ?> 
                                   
                                    </p>
                                <?php endif; ?>
                                    
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata();
                        endif;
                        ?>
                        </div>
                    </div>
                    <div class="col col-sm-6">
                        <div class="latest">
                            <?php
                                $slider_right_bottom_left_catId = get_theme_mod( 'slider_category_right_bottom_left','1' );
                                $slider_right_bottom_left_catLink = get_category_link($slider_right_bottom_left_catId);
                                $slider_right_bottom_left_catName = get_category($slider_right_bottom_left_catId);
                                $args = array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'posts_per_page' => 1,
                                'paged' => 1,
                                'offset'=> 1,
                                'cat' => $slider_right_bottom_left_catId,
                                
                            );
                            $loop = new WP_Query($args);
                            if ( $loop->have_posts() ) :
                                while ($loop->have_posts()) : $loop->the_post(); ?>                                
                                    <?php if (has_post_thumbnail()) :
                                        $args = array(
                                        'class' => 'img-responsive',
                                    ); ?>
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                            <?php the_post_thumbnail( 'newszine-blog-thumb',$args ); ?>
                                        </a>
                                        <?php elseif(get_theme_mod( 'default_images')) : ?>
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                         <img src="<?php echo esc_url(get_theme_mod( 'default_images'));?>" class="img-responsive" alt="">
                                        </a>
                                        <?php else: ?>
                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/n1.jpg' ); ?>" class="img-responsive" alt="">
                                        </a>
                                        <?php endif;?>
                                    
                                    
                                    <div class="carousel-caption">
                                   <?php if($slider_cat_disable):?>
                                        <h5 class="category">
                                            <a href="<?php echo esc_url( $slider_right_bottom_left_catLink ); ?>" title="" rel="bookmark">
                                                <?php echo esc_attr( get_cat_name( $slider_right_bottom_left_catId ) );?>
                                            </a>
                                        </h5>
                                    <?php endif; ?>
                                        <h2>
                                            <a href="<?php the_permalink(); ?>" title="" rel="bookmark">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                    <?php if($slider_display_disable): ?>
                                        <p>
                                            <i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> 
                                            <i class="fa fa-user"></i> <?php echo get_the_author_meta( 'display_name'); ?> 
                                            
                                        </p>
                                    <?php endif; ?>
                                    </div>
                                <?php endwhile;
                            wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="col col-sm-6">
                        <div class="latest">
                            <?php
                                $slider_right_bottom_right_catId = get_theme_mod( 'slider_category_right_bottom_right','1' );
                                $slider_right_bottom_right_catLink = get_category_link($slider_right_bottom_right_catId);
                                $slider_right_bottom_right_catName = get_category($slider_right_bottom_right_catId);
                                $args = array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'posts_per_page' => 1,
                                'paged' => 1,
                                'offset'=>2,
                                'cat' => $slider_right_bottom_right_catId,
                                
                            );
                            $loop = new WP_Query($args);
                            if ( $loop->have_posts() ) :
                                while ($loop->have_posts()) : $loop->the_post(); ?>
                                
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
                                    <img src="<?php echo esc_url(get_theme_mod( 'default_images'));?>" class="img-responsive" alt="">
                                </a>
                                <?php else: ?>
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/n1.jpg' ); ?>" class="img-responsive" alt="">
                                </a>
                                <?php endif;?>
                                
                                
                                <div class="carousel-caption">
                                <?php if($slider_cat_disable):?>
                                    <h5 class="category">
                                        <a href="<?php echo esc_url( $slider_right_bottom_right_catLink ); ?>" title="" rel="bookmark">
                                            <?php echo esc_attr( get_cat_name( $slider_right_bottom_right_catId ) );?>
                                        </a>
                                    </h5>
                                <?php endif; ?>
                                    <h2>
                                        <a href="<?php the_permalink();?>" title="" rel="bookmark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    <?php if($slider_display_disable): ?>
                                    <p>
                                        <i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> 
                                        <i class="fa fa-user"></i> <?php echo get_the_author_meta( 'display_name'); ?> 
                                       
                                    </p>
                                <?php endif; ?>
                                
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </section>
<?php endif; ?>
	<section class="news-body">
		<div class="container-fluid">
			<div class="row">
				<?php
				$class = 'col-md-12';
				$sidebar =  get_theme_mod( 'front_page_sidebar_position','right' );
				if ( !empty ( $sidebar ) && $sidebar != 'none') {
					$class = 'col-md-9';
				}
				?>

                
				<!-- Sidebar -->
				<?php if ($sidebar == 'left'){ get_sidebar('left','newszine'); } ?>

				<div class="<?php echo $class; ?>">				
                    					
						<?php dynamic_sidebar('newszine-home');?>
                        
					<div class="clearfix"></div>
				</div>


				<!-- Sidebar -->
				<?php if ($sidebar == 'right'){ get_sidebar('right','newszine'); } ?>

			</div>
		</div>
	</section>
<?php else: ?>
<section class="news-body">
        <div class="container-fluid">
            <div class="row">

                <?php
                $class = 'col-md-12';
                $sidebar =  get_theme_mod( 'front_page_sidebar_position','right' );
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
                      			$divCounter;
                      			if ($divCounter == 1) { echo "<div class='articleDiv'>"; $divCounter++; } elseif ($divCounter == 0) { $divCounter++; }
                                /*
                                 * Include the Post-Format-specific template for the content.
                                 * If you want to override this in a child theme, then include a file
                                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                 */
                                get_template_part( 'template-parts/content', get_post_format() );
                                ?>

                            <?php endwhile; ?>
                     	 			<?php echo "</div>"; ?>
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
<?php endif;?>
<?php
get_footer();
