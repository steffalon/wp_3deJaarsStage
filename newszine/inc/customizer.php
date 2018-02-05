<?php
/**
 * newszine Theme Customizer.
 *
 * @package newszine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newszine_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->remove_section( 'header_image');
	
}
add_action( 'customize_register', 'newszine_customize_register' );


/**
 * Enqueue scripts for customizer
 */
function newszine_customizer_pro_js() {
    wp_enqueue_script('newszine-customizer', get_template_directory_uri() . '/js/newszine-customizer.js', array('jquery'), '1.3.0', true);

    wp_localize_script( 'newszine-customizer', 'newszine_customizer_pro_js_obj', array(
        'pro' => __('Upgrade To Newszine Pro','newszine')
    ) );
    wp_enqueue_style( 'newszine-customizer', get_template_directory_uri() . '/css/newszine-customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'newszine_customizer_pro_js' );



function newszine_theme_customize_register( $wp_customize ) {
	$wp_customize->add_panel( 'theme_option', array(
			'priority' => 10,
			'title' => __( 'Newszine Theme Option', 'newszine' ),
			'description' => __( ' Newszine Theme Option', 'newszine' ),
		)
	);

	

	/**********************************************/
	/*************** Top Header *****************/
	/**********************************************/

	// BREAKING NEWS
	$wp_customize->add_section('newszine_breaking_news',array(
			'priority' => 20,
			'title' => __('Top Header','newszine'),
			'description' => __('Configure Breaking News type and Social icons.','newszine'),
			'panel' => 'theme_option',
		)
	);

	$wp_customize->add_setting('news_disable',array(
			'sanitize_callback' => 'newszine_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'news_disable',array(
			'label' => __('Show or Hide Breaking News','newszine'),
			'section' => 'newszine_breaking_news',
			'settings' => 'news_disable',
			'type'=> 'checkbox',
		)
	));

	$wp_customize->add_setting('breaking_news_title',array(
			'sanitize_callback' => 'newszine_sanitize_text',
			'default' =>  'Breaking News',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'breaking_news_title',array(
			'label' => __('Breaking News Title','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'breaking_news_title',
		)
	));

	$wp_customize->add_setting('breaking_news_category',array(
			'sanitize_callback' => 'newszine_sanitize_category',
			'default' =>  '1',
		)
	);

	$wp_customize->add_control(new Newszine_Theme_Customize_Dropdown_Taxonomies_Control($wp_customize,'breaking_news_category',array(
			'label' => __('Choose Category','newszine'),
			'section' => 'newszine_breaking_news',
			'settings' => 'breaking_news_category',
			'type'=> 'dropdown-taxonomies',
		)
	));


	//SOCIAL ICONS
	$wp_customize->add_setting('social_profile_disable',array(
			'sanitize_callback' => 'newszine_sanitize_checkbox',
			'default' => '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'social_profile_disable',array(
			'label' => __('Show or Hide Social Icons','newszine'),
			'section' => 'newszine_breaking_news',
			'settings' => 'social_profile_disable',
			'type'=> 'checkbox',
		)
	));
	$wp_customize->add_setting('profile_facebook',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_facebook',array(
			'label' => __('Facebook','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_facebook',
		)
	));

	$wp_customize->add_setting('profile_twitter',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_twitter',array(
			'label' => __('Twitter','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_twitter',
		)
	));

	$wp_customize->add_setting('profile_instagram',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_instagram',array(
			'label' => __('Instagram','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_instagram',
		)
	));

	$wp_customize->add_setting('profile_google',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' =>  '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_google',array(
			'label' => __('Google Plus','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_google',
		)
	));

	$wp_customize->add_setting('profile_linkedin',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_linkedin',array(
			'label' => __('Linkedin','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_linkedin',
		)
	));

	$wp_customize->add_setting('profile_skype',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_skype',array(
			'label' => __('Skype Username','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_skype',
		)
	));
	$wp_customize->add_setting('profile_pinterest',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' =>  '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_pinterest',array(
			'label' => __('Pinterest','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_pinterest',
		)
	));
	$wp_customize->add_setting('profile_soundcloud',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' =>  '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_soundcloud',array(
			'label' => __('Sound Cloud','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_soundcloud',
		)
	));
	$wp_customize->add_setting('profile_whatsapp',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_whatsapp',array(
			'label' => __('WhatsApp User','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_whatsapp',
		)
	));
$wp_customize->add_setting('profile_youtube',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' =>  '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_youtube',array(
			'label' => __('Youtube','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_youtube',
		)
	));
	

	/**********************************************/
	/*************** Slider Category *****************/
	/**********************************************/

	$wp_customize->add_section('newszine_slider',array(
			'priority' => 30,
			'title' => __('Slider Categories','newszine'),
			'description' => __('Select the Slider Category for Homepage.','newszine'),
			'panel' => 'theme_option',
		)
	);

	$wp_customize->add_setting('main_slider_disable',array(
			'sanitize_callback' => 'newszine_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'main_slider_disable',array(
			'label' => __('Show or Hide Main Slider','newszine'),
			'section' => 'newszine_slider',
			'settings' => 'main_slider_disable',
			'type'=> 'checkbox',
		)
	));

	$wp_customize->add_setting('main_slider_category',array(
			'sanitize_callback' => 'newszine_sanitize_category',
			'default' =>  '1',
		)
	);

	$wp_customize->add_control(new Newszine_Theme_Customize_Dropdown_Taxonomies_Control($wp_customize,'main_slider_category',array(
			'label' => __('Choose Main slider category','newszine'),
			'section' => 'newszine_slider',
			'settings' => 'main_slider_category',
			'type'=> 'dropdown-taxonomies',
		)
	));

	$wp_customize->add_setting('slider_category_right_top',array(
			'sanitize_callback' => 'newszine_sanitize_category',
			'default' =>  '1',
		)
	);

	$wp_customize->add_control(new Newszine_Theme_Customize_Dropdown_Taxonomies_Control($wp_customize,'slider_category_right_top',array(
			'label' => __('Choose category','newszine'),
			'section' => 'newszine_slider',
			'settings' => 'slider_category_right_top',
			'type'=> 'dropdown-taxonomies',
		)
	));

	$wp_customize->add_setting('slider_category_right_bottom_left',array(
			'sanitize_callback' => 'newszine_sanitize_category',
			'default' =>  '1',
		)
	);

	$wp_customize->add_control(new Newszine_Theme_Customize_Dropdown_Taxonomies_Control($wp_customize,'slider_category_right_bottom_left',array(
			'label' => __('Choose category','newszine'),
			'section' => 'newszine_slider',
			'settings' => 'slider_category_right_bottom_left',
			'type'=> 'dropdown-taxonomies',
		)
	));

	$wp_customize->add_setting('slider_category_right_bottom_right',array(
			'sanitize_callback' => 'newszine_sanitize_category',
			'default' =>  '1',
		)
	);

	$wp_customize->add_control(new Newszine_Theme_Customize_Dropdown_Taxonomies_Control($wp_customize,'slider_category_right_bottom_right',array(
			'label' => __('Choose category','newszine'),
			'section' => 'newszine_slider',
			'settings' => 'slider_category_right_bottom_right',
			'type'=> 'dropdown-taxonomies',
		)
	)); 
	$wp_customize->add_setting('main_slider_category_disable',array(
			'sanitize_callback' => 'newszine_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'main_slider_category_disable',array(
			'label' => __('Show or Hide Categories on Main Slider','newszine'),
			'section' => 'newszine_slider',
			'settings' => 'main_slider_category_disable',
			'type'=> 'checkbox',
		)
	));
	$wp_customize->add_setting('main_slider_publishdate_disable',array(
			'sanitize_callback' => 'newszine_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'main_slider_publishdate_disable',array(
			'label' => __('Show or Hide Publish Date and Author  on Main Slider','newszine'),
			'section' => 'newszine_slider',
			'settings' => 'main_slider_publishdate_disable',
			'type'=> 'checkbox',
		)
	));
    
    
    /**********************************************/
	/*************** Default Images *****************/
	/**********************************************/
	$wp_customize->add_section('newszine_default_images',array(
			'priority' => 50,
			'title' => __('Default Image','newszine'),
			'description' => __('Display Default Images.','newszine'),
			'panel' => 'theme_option',
		)
	);
	

	$wp_customize->add_setting('default_images',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' =>  get_template_directory_uri().'/images/n1.jpg',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'default_images', array(
			'label' => __('Default Images.','newszine'),
			'section' => 'newszine_default_images',
			'settings' => 'default_images',
		)
	));
   	
	/**********************************************/
	/*************** Footer *****************/
	/**********************************************/
	$wp_customize->add_section('newszine_footer',array(
			'priority' => 60,
			'title' => __('Footer Settings','newszine'),
			'description' => __('Footer Settings Section.','newszine'),
			'panel' => 'theme_option',
		)
	);

	$wp_customize->add_setting('copyright_textbox',array(
			'sanitize_callback' => 'newszine_sanitize_text',
			'default' => __( 'Copyright &copy; 2016.Your Company.','newszine'),
		)
	);

	$wp_customize->add_control('copyright_textbox',array(
			'label' => __('Copyright text','newszine'),
			'section' => 'newszine_footer',
			'settings' => 'copyright_textbox',
			'type' => 'text',
		)
	);

	/**********************************************/
	/*************** Other Setting *****************/
	/**********************************************/
	$wp_customize->add_section('newszine_other_setting',array(
			'priority' => 60,
			'title' => __('Other Settings','newszine'),
			'description' => __('Other Settings Section.','newszine'),
			'panel' => 'theme_option',
		)
	);

	$wp_customize->add_setting('enable_scrolltotop',array(
			'sanitize_callback' => 'newszine_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'enable_scrolltotop',array(
			'label' => __('Show or Hide Scroll To Top','newszine'),
			'section' => 'newszine_other_setting',
			'settings' => 'enable_scrolltotop',
			'type'=> 'checkbox',
		)
	));

	$wp_customize->add_setting('enable_searchbutton',array(
			'sanitize_callback' => 'newszine_sanitize_checkbox',
			'default' => '1',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'enable_searchbutton',array(
			'label' => __('Show or Hide Search option on Header','newszine'),
			'section' => 'newszine_other_setting',
			'settings' => 'enable_searchbutton',
			'type'=> 'checkbox',
		)
	));


	/**********************************************/
	/*************** Theme Sidebar *****************/
	/**********************************************/
	$wp_customize->add_panel( 'theme_layout', array(
		'priority' => 15,
		'title' => __( 'Newszine Sidebar Position', 'newszine' ),
		'description' => __( 'Newszine Sidebar Position', 'newszine' ),
	));
    // Fornt Page
	$wp_customize->add_section('front_page_sidebar' , array(
		'priority' => 10,
		'title' => __('Front Page Sidebar','newszine'),
		'panel' => 'theme_layout'
	));

	$wp_customize->add_setting('front_page_sidebar_position', array(
		'sanitize_callback' => 'newszine_sanitize_sidebar',
		'default' => 'right'
	));

	$wp_customize->add_control('front_page_sidebar_position', array(
		'label'      => __('Sidebar Position', 'newszine'),
		'section'    => 'front_page_sidebar',
		'settings'   => 'front_page_sidebar_position',
		'type'       => 'radio',
		'choices'    => array(
			'left'   => __('Left','newszine'),
			'right'  => __('Right','newszine'),
			'none'	 => __('None','newszine'),
		),
	));


	// CATEGORY PAGE
	$wp_customize->add_section('archive_sidebar' , array(
		'priority' => 10,
		'title' => __('Category Sidebar','newszine'),
		'panel' => 'theme_layout'
	));

	$wp_customize->add_setting('archive_sidebar_position', array(
		'sanitize_callback' => 'newszine_sanitize_sidebar',
		'default' => 'right'
	));

	$wp_customize->add_control('archive_sidebar_position', array(
		'label'      => __('Sidebar Position', 'newszine'),
		'section'    => 'archive_sidebar',
		'settings'   => 'archive_sidebar_position',
		'type'       => 'radio',
		'choices'    => array(
			'left'   => __('Left','newszine'),
			'right'  => __('Right','newszine'),
			'none'	 => __('None','newszine'),
		),
	));

	// SINGLE-POST
	$wp_customize->add_section('post_sidebar' , array(
		'priority' => 20,
		'title' => __('Single Post Sidebar','newszine'),
		'panel' => 'theme_layout'
	));

	$wp_customize->add_setting('post_sidebar_position', array(
		'sanitize_callback' => 'newszine_sanitize_sidebar',
		'default' => 'right'
	));

	$wp_customize->add_control('post_sidebar_position', array(
		'label'      => __('Sidebar Position', 'newszine'),
		'section'    => 'post_sidebar',
		'settings'   => 'post_sidebar_position',
		'type'       => 'radio',
		'choices'    => array(
			'left'   => __('Left','newszine'),
			'right'  => __('Right','newszine'),
			'none'	 => __('None','newszine'),
		),
	));

	// SINGLE-PAGE
	$wp_customize->add_section('page_sidebar' , array(
		'priority' => 30,
		'title' => __('Single Page Sidebar','newszine'),
		'panel' => 'theme_layout'
	));

	$wp_customize->add_setting('page_sidebar_position', array(
		'sanitize_callback' => 'newszine_sanitize_sidebar',
		'default' => 'right'
	));

	$wp_customize->add_control('page_sidebar_position', array(
		'label'      => __('Sidebar Position', 'newszine'),
		'section'    => 'page_sidebar',
		'settings'   => 'page_sidebar_position',
		'type'       => 'radio',
		'choices'    => array(
			'left'   => __('Left','newszine'),
			'right'  => __('Right','newszine'),
			'none'	 => __('None','newszine'),
		),
	));


	// SEARCH PAGE
	$wp_customize->add_section('search_sidebar' , array(
		'priority' => 40,
		'title' => __('Search Page Sidebar','newszine'),
		'panel' => 'theme_layout'
	));

	$wp_customize->add_setting('search_sidebar_position', array(
		'sanitize_callback' => 'newszine_sanitize_sidebar',
		'default' => 'right'
	));

	$wp_customize->add_control('search_sidebar_position', array(
		'label'      => __('Sidebar Position', 'newszine'),
		'section'    => 'search_sidebar',
		'settings'   => 'search_sidebar_position',
		'type'       => 'radio',
		'choices'    => array(
			'left'   => __('Left','newszine'),
			'right'  => __('Right','newszine'),
			'none'	 => __('None','newszine'),
		),
	));

	// PAGE NOT FOUND
	$wp_customize->add_section('not_found_sidebar' , array(
		'priority' => 50,
		'title' => __('Page Not Found Sidebar','newszine'),
		'panel' => 'theme_layout'
	));

	$wp_customize->add_setting('not_found_sidebar_position', array(
		'sanitize_callback' => 'newszine_sanitize_sidebar',
		'default' => 'right'
	));

	$wp_customize->add_control('not_found_sidebar_position', array(
		'label'      => __('Sidebar Position', 'newszine'),
		'section'    => 'not_found_sidebar',
		'settings'   => 'not_found_sidebar_position',
		'type'       => 'radio',
		'choices'    => array(
			'left'   => __('Left','newszine'),
			'right'  => __('Right','newszine'),
			'none'	 => __('None','newszine'),
		),
	));

	$wp_customize->add_setting('profile_instagram',array(
			'sanitize_callback' => 'esc_url_raw',
			'default' => '#',
		)
	);

	$wp_customize->add_control(new WP_Customize_Control($wp_customize,'profile_instagram',array(
			'label' => __('Instagram','newszine'),
			'type' => 'text',
			'section' => 'newszine_breaking_news',
			'settings' => 'profile_instagram',
		)
	));
}
add_action( 'customize_register', 'newszine_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function newszine_customize_preview_js() {
	wp_enqueue_script( 'newszine_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'newszine_customize_preview_js' );



/**
 * Sanitize Input or Textarea.
 * @param $input
 * @return string
 */
function newszine_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Sanitize Checkbox.
 * @param $input
 * @return int|string
 */
function newszine_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Sanitize Sidebar custom dropdown.
 * @param $input
 * @return string
 */
function newszine_sanitize_sidebar( $input ) {
	$valid = array(
		'left'   => 'Left',
		'right'  => 'Right',
		'none'	 => 'None',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitize Category.
 * @param $input
 * @return int
 */
function newszine_sanitize_category($input){
	$output=intval($input);
	return $output;
}


/**
 * Sanitize Integer(page).
 * @param $input
 * @return int
 */
function newszine_sanitize_integer( $input ) {
	if( is_numeric( $input ) ) {
		return intval( $input );
	}
}

/**
 * Sanitize Advertisement custom radio.
 * @param $input
 * @return string
 */
function newszine_sanitize_radio_img_text( $input ) {
	$valid = array(
		'img'   => 'Image',
		'text'  => 'Text',
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}
