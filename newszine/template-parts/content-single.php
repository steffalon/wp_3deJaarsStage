<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newszine
 */

?>

<?php
$class = 'col-md-12';
$sidebar =  get_theme_mod('post_sidebar_position','right');
if ( !empty ( $sidebar) && $sidebar != 'none') {
	$class = 'col-md-9';
}
?>

<!-- Sidebar -->
<?php if ($sidebar == 'left'){ get_sidebar('left','newszine'); } ?>


    <div class="<?php echo $class; ?>">
    
        <div class="block">
            <?php echo newszine_theme_breadcrumbs(); ?>
        </div>
        
        
        <!-- Add Banner -->
            <?php if ( is_active_sidebar( 'single_post_advertisment' ) ) : ?>                      
                <?php dynamic_sidebar( 'single_post_advertisment' ); ?>                       
            <?php endif; ?> 
        
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
                   
                    <?php endif; ?>
                
                </div>
                <div class="content">
                    <h2 class="title"><?php the_title(); ?></h2>
                    <h6 class="info">
                    <i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
                    <i class="fa fa-user"></i> <?php echo get_the_author_meta( 'display_name' ); ?>                    
                    <i class="fa fa-comments"></i> <?php comments_popup_link('0','1', '%');?></h6>
                    
                    <div class="user-content">
                        <?php the_content();?>
                    </div>
                    
                    <div class="tags">
                        <ul class="list-inline">
                            <?php echo get_the_tag_list('<li><i class="fa fa-tag"></i> ',', ','</li>'); ?>
                        </ul>
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
            <?php if ( is_active_sidebar( 'single_post_advertisment' ) ) : ?>                      
                <?php dynamic_sidebar( 'single_post_advertisment' ); ?>                       
            <?php endif; ?>
        
        <!-- Related Post -->
        <?php
        
        $related_catId = get_the_category();
        $related_id[] = '1';
        if ( ! empty( $related_catId ) ) {
        foreach ($related_catId as $related_cat ) {
        $related_id[] = $related_cat->term_id;
        }
        $related_id = join( ", ", $related_id );
        }
        
        $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'post_status' => 'publish',
        'paged' => 1,
        'cat' => $related_id,
        'orderby' => 'rand',
        'post__not_in'  =>array(get_the_ID())
        );
        $loop = new WP_Query($args);
        
        if ( $loop->have_posts() ) :?>
        <div class="block">
            <h3 class="block-title"><?php _e('Gerelateerde berichten','newszine')?></h3>
            <?php while ($loop->have_posts()) : $loop->the_post();?>
            <div class="col-sm-3">
                <div class="news-single-2">
                    <div class="image">
                    
                        <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                            <?php
                                $args = array(
                                'class' => 'img-responsive center-block',
                            );
                            the_post_thumbnail( 'newszine-post-thumb',$args ); ?>
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
                        <h2><a href="<?php esc_url(the_permalink()); ?>" title=""><?php the_title(); ?></a></h2>
                        <h6 class="info">
                        <i class="fa fa-user"></i> <?php echo get_the_author_meta( 'display_name' )?> 
                        <i class="fa fa-clock-o"></i> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' geleden'; ?></h6>
                        <?php echo  newszine_exrcept(30); ?> 
                        <span class="read-more pull-right"><a href="<?php the_permalink();?>" id="readMore" class="btn btn-theme" ><?php _e('Lees meer','newszine');?> <i class="fa fa-angle-double-right"></i></a></span>
                    </div>
                    
                </div>
            </div>
            <?php endwhile;
            wp_reset_postdata();?>
        </div>
        
        <?php endif; ?>
    
    <?php comments_template(); ?>
    </div>

<!-- Sidebar -->
<?php if ($sidebar == 'right'){ get_sidebar('right','newszine'); } ?>


