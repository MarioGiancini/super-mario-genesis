<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Super Mario Genesis' );
define( 'CHILD_THEME_URL', 'http://www.mariogiancini.com/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Include Assets
include_once( get_stylesheet_directory()  . '/includes/theme-helpers.php' );

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Structural Wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer-nav',
	'footer'
) );

//* Add Custom Navs
add_theme_support(
  'genesis-menus',
	array(
		'primary'   => __( 'Primary Navigation Menu', 'super-mario-genesis' ),
		'secondary' => __( 'Secondary Navigation Menu', 'super-mario-genesis' ),
		'top'       => __( 'Top Navigation Menu', 'super-mario-genesis' ),
		'footer'		=> __( 'Footer Navigation Menu', 'super-mario-genesis' )
	)
);

//* Add support for post formats
add_theme_support( 'post-formats', array(
	'audio',
	'gallery',
	'image',
	'link',
	'quote',
	'video'
) );

//* Add new image sizes
add_image_size('grid-thumbnail-small', 100, 100, TRUE);
add_image_size('grid-thumbnail-medium', 400, 200, TRUE);
add_image_size('grid-thumbnail-large', 600, 300, TRUE);
add_image_size('featured-page', 960, 720, TRUE);
add_image_size('featured-large', 1380, 690, TRUE);

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 240,
	'height'          => 80,
	'header-selector' => '.site-title a',
	'flex-width'      => true,
	'flex-height'     => true,
	)
);

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

/**
 * After-entry widget area to single posts
 */
add_action( 'genesis_entry_footer', 'after_entry_widget'  );
function after_entry_widget() {

    if ( ! is_singular( 'post' ) ){
		return;
	}

	if (is_active_sidebar( 'after-entry' )) { // sidebar created with simple sidebars plugin
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry widget-area">',
			'after'  => '</div>',
		) );
	}

}

/**
* Footer Top Ad Space
*/
function mario_footer_featured() {
	echo '<div class="footer-featured">';

	if ( is_active_sidebar( 'footer-featured' ) ) {
		genesis_widget_area( 'footer-featured', array(
			'before' => '<div class="wrap"><div class="footer-featured widget-area">',
			'after' => '</div></div>'
		) );
	}

	echo '</div>';
}
add_action( 'genesis_before_footer', 'mario_footer_featured', 5 );

/**
 * Output Top Navigation
 */
add_action( 'genesis_before', 'custom_top_nav' );
function custom_top_nav() {
	/** Do nothing if menu not supported */
	if ( ! genesis_nav_menu_supported( 'top' ) )
		return;

	/** If menu is assigned to theme location, output */
	if ( has_nav_menu( 'top' ) ) {
		$args = array(
			'theme_location' => 'top',
			'container'      => '',
			'menu_class'     => genesis_get_option( 'nav_superfish' ) ? 'menu genesis-nav-menu menu-top superfish' : 'menu genesis-nav-menu menu-top',
			'echo'           => 0,
		);

		$nav = wp_nav_menu( $args );

		/** Wrap nav menu with nav tag and .wrap div if applied to #nav */
		$nav_output = sprintf( '<nav id="top-nav" class="nav-primary">%2$s%1$s%3$s</nav>', $nav, genesis_structural_wrap( 'nav', 'open', 0 ), genesis_structural_wrap( 'nav', 'close', 0 ) );

		echo $nav_output;
	}
}

/**
 * Output Footer Navigation
 */
add_action( 'genesis_before_footer', 'custom_footer_nav' );
function custom_footer_nav() {
	/** Do nothing if menu not supported */
	if ( ! genesis_nav_menu_supported( 'footer' ) )
		return;

	/** If menu is assigned to theme location, output */
	if ( has_nav_menu( 'footer' ) ) {
		$args = array(
			'theme_location' => 'footer',
			'container'      => '',
			'menu_class'     => genesis_get_option( 'nav_superfish' ) ? 'menu genesis-nav-menu menu-footer superfish' : 'menu genesis-nav-menu menu-footer',
			'echo'           => 0,
		);

		$nav = wp_nav_menu( $args );

		/** Wrap nav menu with nav tag and .wrap div if applied to #nav */
		$nav_output = sprintf( '<div id="nav-footer" class="nav-footer">%2$s%1$s%3$s</div>', $nav, genesis_structural_wrap( 'footer-nav', 'open', 0 ), genesis_structural_wrap( 'footer-nav', 'close', 0 ) );

		echo $nav_output;
	}
}

/**
 * Custom Next & Prev links for pagination
 */
add_filter( 'genesis_prev_link_text', 'custom_prev_link_text' );
function custom_prev_link_text() {
        $prevlink = 'Previous';
        return $prevlink;
}
add_filter( 'genesis_next_link_text', 'custom_review_next_link_text' );
function custom_review_next_link_text() {
        $nextlink = 'Next';
        return $nextlink;
}

//* Customize the WordPress read more link
add_filter( 'the_content_more_link', 'customize_read_more_link' );
//* Customize the Genesis content limit read more link
add_filter( 'get_the_content_more_link', 'customize_read_more_link' );
// * Customize Read More Link to Excerpts
add_filter('excerpt_more', 'customize_read_more_link');
function customize_read_more_link() {
	return '<span class="ellipsis">...</span> <a class="more-link" href="' . get_permalink() . '"><span class="theres-more">Theres More</span> <small>(Keep Reading)</small></a>';
}

/**
 * Enqueue jQuery plugins and scripts
 */
add_action( 'wp_enqueue_scripts', 'mario_enqueue_scripts' );
function mario_enqueue_scripts() {

	//* Smooth Scrolling Anchors
	wp_enqueue_script( 'mario-local-scroll', get_stylesheet_directory_uri() . '/js/jquery.localScroll.min.js', array( 'jquery' ), CHILD_THEME_VERSION, TRUE );
	wp_enqueue_script( 'mario-scroll-to', get_stylesheet_directory_uri() . '/js/jquery.scrollTo.min.js', array( 'jquery' ), CHILD_THEME_VERSION, TRUE );

	//* Home Page full screen
	wp_enqueue_script( 'mario-home', get_stylesheet_directory_uri() . '/js/home.js', array( 'jquery' ), CHILD_THEME_VERSION, TRUE );

	//* FitVids
	wp_enqueue_script('fitvids', get_stylesheet_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), CHILD_THEME_VERSION, TRUE);
	wp_enqueue_script('fitvids-setup', get_stylesheet_directory_uri() . '/js/fitvids.js', array('fitvids'), CHILD_THEME_VERSION, TRUE);

	//* Shrinking header
	wp_enqueue_script( 'add-bumper', get_stylesheet_directory_uri() . '/js/add-bumper.js', array( 'jquery' ), CHILD_THEME_VERSION, TRUE );
	wp_enqueue_script( 'shrink-header', get_stylesheet_directory_uri() . '/js/shrink-header.js', array( 'jquery' ), CHILD_THEME_VERSION, TRUE );

}

/**
 * Enqueue styles and fonts
 */
add_action( 'wp_enqueue_scripts', 'mario_enqueue_styles' );
function mario_enqueue_styles() {

	//* Google Fonts
	wp_enqueue_style( 'google-font-lato', '//fonts.googleapis.com/css?family=Lato:100,300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'google-font-source-sans-pro', '//fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,700,300italic,400italic,700italic', array(), CHILD_THEME_VERSION );

	//* Font Awesome
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );

	//* Dashicons
	wp_enqueue_style( 'mario-dashicons-style', get_stylesheet_directory_uri(), array('dashicons'), CHILD_THEME_VERSION );
}

/**
 * Display custom author box on single posts
 */
add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8);

add_action('genesis_after_entry', 'theme_author_box', 8);
function theme_author_box() {
	if ( is_singular( 'post' ) ) {
		theme_author_box_layout();
	}
}
/**
 * Custom Author Box Layout
 * @since 1.0.0
 *
 * Creates a custom layout for author meta
 * @link http://mariogiancini.com
 *
 * @param boolean $archived
 * @return string
 */
function theme_author_box_layout( $archived = false ) {
	$add_class = '';
	$image_size = 100;
	$author_title_open = '<h4>About <span class="entry-author-name">';
	$author_title_close = '</span></h4>';

	if( $archived ) {
		$add_class = '-archive';
		$image_size = 150;
		$author_title_open = '<h1 id="archive-title">';
		$author_title_close = '</h1>';
	}

	$authinfo = '<div class="author-box'.$add_class.'"><div class="author-wrap">';
	$authinfo .= get_avatar(get_the_author_id() , $image_size);
	$authinfo .= $author_title_open . get_the_author_meta('display_name') . $author_title_close;

	if( !$archived ) {
		$authinfo .= '<p>' . get_the_author_meta('description') . '</p></div>';
	}

	$facebook = get_the_author_meta('facebook');
	$twitter = get_the_author_meta('twitter');
	$googleplus = get_the_author_meta('googleplus');
	$website = get_the_author_meta('user_url');

	$flength = strlen($facebook);
	$tlength = strlen($twitter);
	$glength = strlen($googleplus);
	$wlength = strlen($website);

	$authsocial = '<div class="author-box-networks"> <ul class="author-networks">';
	if ($flength > 1) {
		$authsocial .= '<li><a class="author-facebook" href="' . $facebook . '" target="_blank" rel="nofollow" title="' . get_the_author_meta('display_name') . ' on Facebook">Facebook</a></li>';
	}

	if ($tlength > 1) {
		$authsocial .= '<li><a class="author-twitter" href="http://twitter.com/' . $twitter . '" target="_blank" rel="nofollow" title="' . get_the_author_meta('display_name') . ' on Twitter">Twitter</a></li>';
	}

	if ($glength > 1) {
		$authsocial .='<li><a class="author-gplus" href="' . $googleplus . '" rel="me" target="_blank" title="' . get_the_author_meta('display_name') . ' on Google+">Google+</a></li>';
	}

	if ($wlength > 1) {
		$authsocial .= '<li><a class="author-website" href="' . $website . '" target="_blank" rel="nofollow" title="' . get_the_author_meta('display_name') . ' Official Website">Website</a></li>';
	}

	$authsocial .= '</ul>';
	$authsocial .= '</div>';

	$authinfo .= $authsocial; // add social networks below description and avatar
	$authinfo .= '</div>';

	echo $authinfo;
}


/**
 * Move image above post title in blog and archive pages
 */
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 8 );

/**
 * Remove Image Alignment from Featured Image
 */
function remove_image_alignment( $attributes ) {
  $attributes['class'] = str_replace( 'alignleft', 'alignnone', $attributes['class'] );
	return $attributes;
}
add_filter( 'genesis_attr_entry-image', 'remove_image_alignment' );

/**
 * Custom entry meta in entry header - remove "by" & "edit"
 */
add_filter( 'genesis_post_info', 'mario_filter_post_info' );
function mario_filter_post_info( $post_info ) {

	if( is_singular() ) {
		$post_info = '[post_date] [post_author_posts_link]';
		return $post_info;
	} else {
		$post_info = '[post_date] [post_categories before=""]';
		return $post_info;
	}

}

/**
 * Custom post meta in entry footer - remove text
 */
add_filter( 'genesis_post_meta', 'mario_filter_post_meta', 25 );
function mario_filter_post_meta( $post_meta ) {

	if( is_singular('post') ) {
		$post_meta = do_shortcode('[post_categories before=""] [post_tags before=""]');
    return $post_meta;
	}
	elseif( is_singular('download') ) {
		$post_meta = do_shortcode('[post_terms taxonomy="download_category" before=""] [post_terms taxonomy="download_tag" before=""]');
    return $post_meta;
	} else {
		$post_meta = do_shortcode('[post_terms taxonomy="download_category" before=""] [post_terms taxonomy="download_tag" before=""]'); // removed tags: [post_tags before=""]
    return $post_meta;
	}
}

/**
 * Add a CSS ID to main element
 */
add_filter( 'genesis_attr_content', 'add_custom_attributes_content' );
function add_custom_attributes_content( $attributes ) {
	$attributes['id'] = 'main-content';
	return $attributes;
}

/**
 * Customize Pagination Links
 */
add_action('genesis_entry_footer', 'custom_pagination_links', 15 );
function truncate($string,$length=100,$append="&hellip;") {
	$string = trim($string);

	if(strlen($string) > $length) {
		$string = wordwrap($string, $length);
		$string = explode("\n",$string);
		$string = array_shift($string) . $append;
  }

  return $string;
}
function get_featured_img_url($id) {
	/* Custom function to get featured image url */
	$thumb_id = get_post_thumbnail_id($id);
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'grid-thumbnail-medium', true);
	$thumb_url = $thumb_url_array[0];
	return $thumb_url;
}
function custom_pagination_links() {
	if( !is_singular( 'post' ) )
    return;

	/* Get IDs for images & titles since wordpress doesn't spit this out in an easy way */
	$prev_post  = get_adjacent_post( false, '', true );
	$next_post  = get_adjacent_post( false, '', false );
	$prev_title = get_the_title($prev_post->ID);
	$next_title = get_the_title($next_post->ID);
	$prev_title = truncate($prev_title,30,'&hellip;');
	$next_title = truncate($next_title,30,'&hellip;');

	echo '<div class="single-pagination">';
    if( $prev_post ) {
		previous_post_link('<span class="single-post-nav previous-post-link one-half first" style="background-image:url(' . get_featured_img_url($prev_post->ID) . ');">%link</span>', $prev_title, FALSE);
	} else { echo '<span class="single-post-nav previous-post-link one-half first random"><a href="/about" rel="random">Find Out More About Me</a></span>'; }
	if( $next_post ) {
    	next_post_link('<span class="single-post-nav next-post-link one-half last" style="background-image:url(' . get_featured_img_url($next_post->ID) . ');">%link</span>', $next_title, FALSE);
	} else { echo '<span class="single-post-nav next-post-link one-half last random"><a href="/about" rel="random">Find Out More About Me</a></span>'; }
	echo '<div class="clearfix"></div></div>';
}

/**
 * Customize Footer the credits
 */
add_filter( 'genesis_footer_creds_text', 'sp_footer_creds_text' );
function sp_footer_creds_text() {
	echo '<div class="creds"><p>';
	echo 'Copyright &copy; ';
	echo date('Y');
	echo ' &middot; <a href="http://mariogiancini.com">Mario Giancini</a> &middot; All rights reserved.';
	echo '</p></div>';
}

/**
 * Add custom sharing text and custom download spec text
 **/
add_action('wp_footer', 'add_custom_sharing_text');
function add_custom_sharing_text() { ?>
	<script>

		jQuery(document).ready(function() {

			jQuery( "a.share-facebook > span" ).text("Share");
			jQuery( "a.share-twitter > span" ).text("Tweet");
			jQuery( "a.share-google-plus-1 > span" ).text("Plus");
			jQuery( "a.share-pinterest > span" ).text("Pin");

			jQuery( "h3.jp-relatedposts-headline > em" ).text("You May Like");

		});

	</script>
	<?php

	if( is_singular('download') ) {

		?>

		<script>

			jQuery(document).ready(function() {

				jQuery( "#isa-edd-specs tr:nth-child(4) td:first-child" ).text("Type:");

			});

		</script>

		<?php
	}

}

/**
* Add share-a-sale affiliate code
**/
add_action('wp_head', 'add_shareasale_code');
function add_shareasale_code() {
	echo '<!-- CBD0EEFA-B4AC-428D-87BB-2C6D098C00FA -->';
}
