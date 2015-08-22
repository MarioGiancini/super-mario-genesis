<?php
/**
* Modify Single download
**/

remove_action( 'genesis_post_title', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


//* Add the Featured Image Title Section
add_action( 'genesis_after_header', 'add_featured_title', 15 );
function add_featured_title() {

  global $post;
  $post_type = get_post_type( $post );

  // See if post type has pages turned off by default from genesis title toggle
  $default = genesis_get_option( 'be_title_toggle_' . $post_type );

  $image = wp_get_attachment_url( get_post_thumbnail_id());

  echo '<div class="featured-title theme-bg" style="background-image: url(' . $image . ');">';

  // If titles are turned off by default, let's check for an override before removing
  if( ! empty( $default ) ) {

    $override = get_post_meta( $post->ID, 'be_title_toggle_show', true );
    if( ! empty( $override ) ) {
      echo '<div class="wrap"><h1 class="entry-title white-color" itemprop="headline">' . get_the_title() . '</h1></div>';
    }

  } else {
    $override = get_post_meta( $post->ID, 'be_title_toggle_hide', true );

    if( empty( $override ) ) {
      echo '<div class="wrap"><h1 class="entry-title white-color" itemprop="headline">' . get_the_title() . '</h1></div>';
    }

  }

  echo '</div>';

}

add_action( 'genesis_after_post_content', 'gcedd_single_after_widget' );	// XHTMTL, pre G2.0
add_action( 'genesis_entry_footer', 'gcedd_single_after_widget' );			// HTML5, G2.0+
/**
 * Add the optional after content widget for the single download page
 *
 * @since 1.0.0
 *
 * @uses  genesis_widget_area()
 */
function gcedd_single_after_widget() {

	genesis_widget_area(
		'gcedd-single-after',
		array(
			//'before' => '<div class="gcedd-single-after widget-area">',
			//'after'  => '</div>',
			'before' => current_theme_supports( 'html5' ) ? '<aside class="gcedd-single-after widget-area">' : '<div class="gcedd-single-after widget-area">',
			'after'  => current_theme_supports( 'html5' ) ? '</aside>' : '</div>',
		)
	);

}  // end of function gcedd_single_after_widget


/** Let Genesis take over :) */
genesis();
