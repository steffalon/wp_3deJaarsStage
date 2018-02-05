<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up to Secion </header>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package newszine
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div class="wraper">
	<header>

<section class="main-menu">
    <h6 class="hidden"><?php echo esc_html__( 'Main Menu', 'newszine' ); ?></h6>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-11">
				<div class="col-sm-3">
                <div class="logo">
                    <?php
                        if (has_custom_logo()):
                    ?>
                        <div class="site_logo">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php the_custom_logo(); ?></a>
                        </div>
                    <?php endif; ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                        <h6 class="site-description"><?php bloginfo('description'); ?></h6>
					
                </div>
            </div>
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only"><?php echo esc_html__('Toggle navigation', 'newszine'); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse">

                        <!-- Right nav -->
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <?php wp_nav_menu( array(
                                    'menu'              => 'primary',
                                    'theme_location'    => 'primary',
                                    'depth'             => 8,
                                    'menu_class'        => 'nav navbar-nav navbar-left',
                                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                    'walker'            => new wp_bootstrap_navwalker())
                            ); ?>
                        <?php else : ?>
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-left sm">
                                    <?php
                                    $args = array(
                                        'depth'        => 0,
                                        'echo'         => 1,
                                        'post_type'    => 'page',
                                        'post_status'  => 'publish',
                                        'show_date'    => '',
                                        'sort_column'  => 'menu_order',
                                        'title_li'     => __('','newszine'),
                                        'walker'       => new Newszine_Walker_Page
                                    );
                                    wp_list_pages( $args );
                                    ?>
                                </ul>
                                
                            </div>

                        <?php endif; ?>

                    </div><!--/.nav-collapse -->
                </div>
            </div>
            <?php $search_disable= get_theme_mod('enable_searchbutton','1');
                if($search_disable==1):?>
                    <div class="col-sm-1">
                        <div class="search hidden-xs">
                            <button id="search-toggle"><i class="fa fa-search"></i></button>
                            <div class="search-form">
                                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" accept-charset="utf-8">
                                    <input type="search" class="form-control" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php _e('Zoek','newszine');?>">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif;?>
        </div>
    </div>
</section>

<section class="top-info">
    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-8 breaking-wraper hidden-xs">
                <?php if ( get_theme_mod( 'news_disable','1' ) ) : ?>
                <h3 class="breaking-title"><?php if ( get_theme_mod( 'breaking_news_title','Breaking News' ) ) : echo esc_attr(get_theme_mod('breaking_news_title','Breaking News')); else: ?><?php _e('Ticker News','newszine'); endif;?></h3>
                <div class="breaking-news">
                    <div id="breaking-news" class="owl-carousel owl-theme">
                        <?php
                        $breaking_news_catId = get_theme_mod( 'breaking_news_category' );
                        $breaking_news_link = get_category_link( $breaking_news_catId );
                        $breaking_news_cat_name = get_category( $breaking_news_catId );
                        $args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'paged' => 1,
                            'cat' => $breaking_news_catId,
                            'orderby' => 'ID',
                            'order' => 'DESC'
                        );
                        $loop = new WP_Query($args);
                        if ( $loop->have_posts() ) :
                        while ($loop->have_posts()) : $loop->the_post(); ?>
                            <div class="item"><a href="<?php the_permalink(); ?>" title="" rel="bookmark"><?php the_title(); ?></a></div>
                        <?php endwhile;
                        wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-sm-4">
                <div class="top-social pull-right ">

                    <?php if ( get_theme_mod( 'social_profile_disable','1') ) : ?>
                        <ul class="list-inline">
                            <?php if ( get_theme_mod( 'profile_facebook','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'profile_facebook','#' ) ); ?>" title=""><i class="fa fa-facebook"></i></a></li>
                            <?php endif; ?>

                            <?php if ( get_theme_mod( 'profile_twitter','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'profile_twitter','#' ) ); ?>" title=""><i class="fa fa-twitter"></i></a></li>
                            <?php endif; ?>

                            <?php if ( get_theme_mod( 'profile_instagram','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'profile_instagram','#' ) ); ?>" title=""><i class="fa fa-instagram"></i></a></li>
                            <?php endif; ?>

                            <?php if( get_theme_mod( 'profile_google','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'profile_google','#' ) ); ?>" title=""><i class="fa fa-google-plus"></i></a></li>
                            <?php endif; ?>

                            <?php if( get_theme_mod( 'profile_linkedin','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'profile_linkedin','#' ) ); ?>" title=""><i class="fa fa-linkedin"></i></a></li>
                            <?php endif; ?>
                            <?php if( get_theme_mod( 'profile_skype','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'profile_skype','#' ) ); ?>" title=""><i class="fa fa-skype"></i></a></li>
                            <?php endif; ?>
                             <?php if( get_theme_mod( 'profile_pinterest','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'profile_pinterest','#' ) ); ?>" title=""><i class="fa fa-pinterest"></i></a></li>
                            <?php endif; ?>
                             <?php if( get_theme_mod( 'profile_soundcloud','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'profile_soundcloud','#' ) ); ?>" title=""><i class="fa fa-soundcloud"></i></a></li>
                            <?php endif; ?>
                             <?php if( get_theme_mod( 'profile_whatsapp','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'profile_whatsapp','#' ) ); ?>" title=""><i class="fa fa-whatsapp"></i></a></li>
                            <?php endif; ?>
                             <?php if( get_theme_mod( 'profile_youtube','#' ) ) : ?>
                                <li><a href="<?php echo esc_url( get_theme_mod( 'profile_youtube','#' ) ); ?>" title=""><i class="fa fa-youtube-play"></i></a></li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

	</header>

