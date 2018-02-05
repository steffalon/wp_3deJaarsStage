<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package newszine
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function newszine_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'newszine_body_classes' );


/**********************************************/
/*************** breadcrumb customize  *****************/
/**********************************************/
if ( ! function_exists( 'newszine_theme_breadcrumbs' ) ) {

	function newszine_theme_breadcrumbs() {

	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter = '<span class="divider"></span>'; // delimiter between crumbs
	$home = __('Home','newszine'); // text for the 'Home' link
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before = '<li class="active"><span class="current">'; // tag before the current crumb
	$after = '</span></li>'; // tag after the current crumb

	global $post;
	$homeLink = esc_url( home_url() );

	if (is_home() || is_front_page()) {

		if ($showOnHome == 1) echo '<ul class="breadcrumb"><li><a href="' . $homeLink . '">' . $home . '</a></li></ul>';

	} else {

		echo '<ul class="breadcrumb"><li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
			echo $before . '' . single_cat_title('', false) . '' . $after;

		} elseif ( is_search() ) {
			echo $before . 'Zoek resultaten voor: "' . get_search_query() . '"' . $after;

		} elseif ( is_day() ) {
			echo '<li><a href="' . esc_attr(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
			echo '<li><a href="' . esc_attr(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . get_the_time('F') . '</a> ' . $delimiter . '</li> ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo '<li><a href="' . esc_attr(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> ');
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
				echo '<li>'.$cats.'</li>';
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . '</li> ');
			echo '<li><a href="' . esc_attr(get_permalink($parent)) . '">' . $parent->post_title . '</a>';
			if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<li><a href="' . esc_attr(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . '</li> ';
			}
			if ($showCurrent == 1) echo ' ' . $delimiter . '</li> ' . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . esc_html__('Articles posted by ','newszine') . $userdata->display_name . $after;

		} elseif ( is_404() ) {
			echo $before . esc_html__('Error 404','newszine') . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page','newszine') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</ul>';

	}
}
}

/**********************************************/
/*************** theme comment-form ************/
/**********************************************/

/**
 * Add custom style of form field
 */
add_filter( 'comment_form_default_fields', 'newszine_theme_comment_form_fileds' );
function newszine_theme_comment_form_fileds( $fields ) {
	$commenter = wp_get_current_commenter();
	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

	$fields   =  array(

		'author'=>'<input class="form-control" placeholder="'.__('Naam*','newszine').'" name="author" type="text" value="' .
			esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />'.
			( $req ? '<span class="required"></span>' : '' ),
		'email'=> '<input class="form-control" placeholder="'.__('Email adres*','newszine').'" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" ' . $aria_req . ' />' .
			( $req ? '<span class="required"></span>' : '' ),
		'url'=> '<input class="form-control" name="url" placeholder="'.__('Website','newszine').'" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" /> ',
	);

	return $fields;
}

/**
 * Add custom default values of form.
 */
add_filter( 'comment_form_defaults', 'newszine_theme_comment_form' );
function newszine_theme_comment_form( $args ) {
	$args['title_reply'] = __('Laat een bericht achter','newszine');
	$args['title_reply_before'] = '<h3 class="block-title">';
	$args['title_reply_after'] = '</h3>';
	$args['comment_notes_before'] = '<p>'. __( 'Je email word niet mee gepubliceerd. Verplichte velden zijn aangegeven.','newszine' ) . '<span class="red">*</span></p>';
	$args['comment_field'] = '<textarea name="comment" rows="5" class="form-control" placeholder="'.__('Bericht','newszine').'" aria-required="true"></textarea>';
	$args['class_submit'] = 'btn btn-submit'; // since WP 4.1
	$args['label_submit'] = 'Verzenden';

	return $args;
}

/**
 * Add custom HTML between the `</h3>` and the `<form>` tags in the comment_form() output.
 */
add_action( 'comment_form_before', function(){
	add_filter( 'pre_option_comment_registration', 'newszine_theme_add_div_above_form' );
});

function newszine_theme_add_div_above_form( $comment_registration ) {
	// Adjust this to your needs:
	echo '<div class="leave-comments">';
	remove_filter( current_filter(), __FUNCTION__ );
    echo '</div>';
	return $comment_registration;
}

/**
 * Add custom class name in reply link.
 */
add_filter('comment_reply_link', 'newszine_replace_reply_link_class');

function newszine_replace_reply_link_class($class){
	$class = str_replace("class='comment-reply-link", "class='comment-reply", $class);
	return $class;
}

/**********************************************/
/*************** wp-cloud-tags ************/
/**********************************************/

add_filter( 'widget_tag_cloud_args', 'newszine_theme_cloud_tag_args' );
function newszine_theme_cloud_tag_args( $args ) {
	$args['number'] = 20; // Your extra arguments go here
	$args['largest'] = 18;
	$args['smallest'] = 12;
	$args['unit'] = 'px';
	return $args;
}

if ( ! class_exists( 'WP_Customize_Control' ) )
  return NULL;

/**
 * Class Newszine_Theme_Customize_Dropdown_Taxonomies_Control
 */
class Newszine_Theme_Customize_Dropdown_Taxonomies_Control extends WP_Customize_Control {

  public $type = 'dropdown-taxonomies';

  public $taxonomy = '';


  public function __construct( $manager, $id, $args = array() ) {

    $our_taxonomy = 'category';
    if ( isset( $args['taxonomy'] ) ) {
      $taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
      if ( true === $taxonomy_exist ) {
        $our_taxonomy = esc_attr( $args['taxonomy'] );
      }
    }
    $args['taxonomy'] = $our_taxonomy;
    $this->taxonomy = esc_attr( $our_taxonomy );

    parent::__construct( $manager, $id, $args );
  }

  public function render_content() {

    $tax_args = array(
      'hierarchical' => 0,
      'taxonomy'     => $this->taxonomy,
    );
    $all_taxonomies = get_categories( $tax_args );

    ?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
         <select <?php echo $this->link(); ?>>
            <?php
              printf('<option value="%s" %s>%s</option>', '', selected($this->value(), '', false),__('Select', 'newszine') );
             ?>
            <?php if ( ! empty( $all_taxonomies ) ): ?>
              <?php foreach ( $all_taxonomies as $key => $tax ): ?>
                <?php
                  printf('<option value="%s" %s>%s</option>', $tax->term_id, selected($this->value(), $tax->term_id, false), $tax->name );
                 ?>
              <?php endforeach ?>
           <?php endif ?>
         </select>

    </label>
    <?php
  }

}


if ( ! class_exists( 'Walker_Comment' ) )
  return NULL;

/**
 * Class Newszine_Comment_Walker
 */
class Newszine_Comment_Walker extends Walker_Comment {
  var $tree_type = 'comment';
  var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );



function start_lvl( &$output, $depth = 0, $args = array() ) {
  $GLOBALS['comment_depth'] = $depth + 2; ?>

  <div class="comment-single">

<?php }


function end_lvl( &$output, $depth = 0, $args = array() ) {
  $GLOBALS['comment_depth'] = $depth + 2; ?>

  </div>

<?php }


function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
  $depth++;
  $GLOBALS['comment_depth'] = $depth;
  $GLOBALS['comment'] = $comment;
  $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );

  if ( 'article' == $args['style'] ) {
    $tag = 'article';
    $add_below = 'comment';
  } else {
    $tag = 'article';
    $add_below = 'comment';
  } ?>

  <div class="comment-single" id="comment-<?php comment_ID() ?>" itemprop="comment">
  <div class="image">
    <?php echo get_avatar( $comment, 65); ?>
  </div>
  <div class="content">
    <h6>
      <span class="pull-left"><?php comment_author(); ?></span>
      <span class="pull-right"><?php comment_date('M d, Y') ?> at <?php comment_time() ?></span>
    </h6>
    <?php edit_comment_link(__('edit','newszine'), '<h3 class="edit-comment">', '</h3>'); ?>
    <?php comment_text();?>

    <?php
    comment_reply_link(
        array_merge(
            $args,
            array(
                'add_below' => $add_below,
                'depth' => $depth,
                'max_depth' => $args['max_depth']
            )
        )
    )
    ?>
  </div>


<?php }


function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

  </div>

<?php }

}

if ( ! class_exists( 'Walker_Page' ) )
  return NULL;

/**
 * Class Newszine_Walker_Page
 */
class Newszine_Walker_Page extends Walker_Page {

  /**
   * @see Walker::start_lvl()
   * @since 1.0.1
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int    $depth  Depth of page. Used for padding.
   * @param array  $args
   */
  public function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class='dropdown-menu'>\n";
  }

  /**
   * @see Walker::end_lvl()
   * @since 1.0.1
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int    $depth  Depth of page. Used for padding.
   * @param array  $args
   */
  public function end_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  /**
   * @see Walker::start_el()
   * @since 1.0.1
   *
   * @param string $output       Passed by reference. Used to append additional content.
   * @param object $page         Page data object.
   * @param int    $depth        Depth of page. Used for padding.
   * @param int    $current_page Page ID.
   * @param array  $args
   */
  function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0) {
    if ( $depth ) {
      $indent = str_repeat( "\t", $depth );
    } else {
      $indent = '';
    }

    $css_class = array( 'page_item', 'page-item-' . $page->ID );

    if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
      $css_class[] = 'page_item_has_children';
    }

    if ( ! empty( $current_page ) ) {
      $_current_page = get_post( $current_page );
      if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
        $css_class[] = 'current_page_ancestor';
      }
      if ( $page->ID == $current_page ) {
        $css_class[] = 'active';
      } elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
        $css_class[] = 'current_page_parent';
      }
    } elseif ( $page->ID == get_option('page_for_posts') ) {
      $css_class[] = 'current_page_parent';
    }

    $css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

    /** This filter is documented in wp-includes/post-template.php */
    if ( isset( $args['pages_with_children'][ $page->ID ] ) ) {
      $output .= $indent . sprintf(
              '<li class="%s"><a href="%s">%s%s%s <span class="caret"></span></a>',
              $css_classes,
              esc_attr(get_permalink( $page->ID )),
              $args['link_before'],
              apply_filters( 'the_title', $page->post_title, $page->ID ),
              $args['link_after']
          );
    } else {
      $output .= $indent . sprintf(
              '<li class="%s"><a href="%s">%s%s%s</a>',
              $css_classes,
              esc_attr(get_permalink( $page->ID )),
              $args['link_before'],
              apply_filters( 'the_title', $page->post_title, $page->ID ),
              $args['link_after']
          );
    }

  }
  /**
   * @see Walker::end_el()
   * @since 1.0.1
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $page Page data object. Not used.
   * @param int    $depth Depth of page. Not Used.
   * @param array  $args
   */
  public function end_el( &$output, $page, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
  }

}



/**
 * Flush out the transients used in newszine_categorized_blog.
 */
function newszine_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'newszine_categories' );
}
add_action( 'edit_category', 'newszine_category_transient_flusher' );
add_action( 'save_post',     'newszine_category_transient_flusher' );




