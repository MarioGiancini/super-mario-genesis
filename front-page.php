<?php

//* Add the Home Top Section
add_action( 'genesis_after_header', 'home_widget_top', 15 );
function home_widget_top() {

  echo '<div id="home-featured-top" class="home-featured-top color-section"><div class="wrap">';

  if (is_active_sidebar( 'home-1' )) {
    genesis_widget_area( 'home-1', array(
      'before' => '<div class="widget-area home-1">',
      'after' => '</div>'
    ) );
  }

  echo '</div></div>';
}

//* Add Second Section
add_action( 'genesis_after_header', 'home_widget_second', 15 );
function home_widget_second() {

  echo '<div id="home-featured-2" class="home-widgets"><div class="wrap">';

  if (is_active_sidebar( 'home-2' )) {
    genesis_widget_area( 'home-2', array(
      'before' => '<div class="widget-area home-2">',
      'after' => '</div>'
    ) );
  }

  echo '</div></div>';
}

//* Add Third Section
add_action( 'genesis_after_header', 'home_widget_third', 15 );
function home_widget_third() {

  echo '<div id="home-featured-3" class="home-widgets image-section"><div class="wrap">';

  if (is_active_sidebar( 'home-3' )) {
    genesis_widget_area( 'home-3', array(
      'before' => '<div class="widget-area home-3">',
      'after' => '</div>'
    ) );
  }

  echo '</div></div>';
}

//* Add Fourth Section
add_action( 'genesis_after_header', 'home_widget_fourth', 15 );
function home_widget_fourth() {

  echo '<div id="home-featured-4" class="home-widgets dark-section"><div class="wrap">';

  if (is_active_sidebar( 'home-4' )) {
    genesis_widget_area( 'home-4', array(
      'before' => '<div class="widget-area home-4">',
      'after' => '</div>'
    ) );
  }

  echo '</div></div>';
}

//* Add Fifth Section
add_action( 'genesis_after_header', 'home_widget_fifth', 15 );
function home_widget_fifth() {

  echo '<div id="home-featured-5" class="home-widgets no-line color-section"><div class="wrap">';


  if (is_active_sidebar( 'home-5' )) {
    genesis_widget_area( 'home-5', array(
      'before' => '<div class="widget-area home-5">',
      'after' => '</div>'
    ) );
  }

  echo '</div></div>';
}


genesis();
