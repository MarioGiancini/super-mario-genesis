<?php

/**
* Template Name: Hero Image Template
* Description: Page template to display a custom hero image with optional title at top of page.
*
**/

$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];


remove_action( 'genesis_post_title', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );


//* Add the Hero Image Section
add_action( 'genesis_after_header', 'add_hero_image', 15 );
function add_hero_image() {

	global $post;
	$post_type = get_post_type( $post );

	// See if post type has pages turned off by default from genesis title toggle
	$default = genesis_get_option( 'be_title_toggle_' . $post_type );

	$image = wp_get_attachment_url( get_post_thumbnail_id());

	echo '<div class="hero-featured-image" style="background-image: url(' . $image . ');">';

	// If titles are turned off by default, let's check for an override before removing
	if( ! empty( $default ) ) {

		$override = get_post_meta( $post->ID, 'be_title_toggle_show', true );
		if( ! empty( $override ) ) {
			echo '<div class="wrap"><h1 class="entry-title" itemprop="headline">' . get_the_title() . '</h1></div>';
		}

	} else {
		$override = get_post_meta( $post->ID, 'be_title_toggle_hide', true );

		if( empty( $override ) ) {
			echo '<div class="wrap">' . get_the_title() . '</div>';
		}

	}

	echo '</div>';

}

genesis();
