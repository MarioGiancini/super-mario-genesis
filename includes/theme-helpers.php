<?php

/**
* Manditory Theme Sidebar Widget Areas
*/
genesis_register_sidebar(
  array(
    'id'            => 'home-1',
    'name'          => __( 'Home Widgets 1', 'super-mario-genesis' ),
    'description'   => __( 'Widget area that appears at the top of the home page.', 'super-mario-genesis' ),
  )
);

genesis_register_sidebar(
  array(
    'id'            => 'home-2',
    'name'          => __( 'Home Widgets 2', 'super-mario-genesis' ),
    'description'   => __( 'Widget area that appears second on the home page.', 'super-mario-genesis' ),
  )
);

genesis_register_sidebar(
  array(
    'id'            => 'home-3',
    'name'          => __( 'Home Widgets 3', 'super-mario-genesis' ),
    'description'   => __( 'Widget area that appears third on the home page.', 'super-mario-genesis' ),
  )
);

genesis_register_sidebar(
  array(
    'id'            => 'home-4',
    'name'          => __( 'Home Widgets 4', 'super-mario-genesis' ),
    'description'   => __( 'Widget area that appears fourth on the home page.', 'super-mario-genesis' ),
  )
);

genesis_register_sidebar(
  array(
    'id'            => 'home-5',
    'name'          => __( 'Home Widgets 5', 'super-mario-genesis' ),
    'description'   => __( 'Widget area that appears fith on the home page.', 'super-mario-genesis' ),
  )
);

genesis_register_sidebar(
  array(
    'id'            => 'after-entry',
    'name'          => __( 'After Entry', 'super-mario-genesis' ),
    'description'   => __( 'Widget area that appears after a single post.', 'super-mario-genesis' ),
  )
);

genesis_register_sidebar(
  array(
    'id'            => 'footer-featured',
    'name'          => __( 'Footer Featured', 'super-mario-genesis' ),
    'description'   => __( 'Full width widget area that appears above the footer widgets.', 'super-mario-genesis' ),
  )
);
