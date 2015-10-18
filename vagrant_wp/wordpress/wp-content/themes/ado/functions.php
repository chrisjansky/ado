<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  // Allow editor style.
  add_editor_style(get_stylesheet_directory_uri() . "/library/css/editor-style.css");

  // Enable localization
  load_theme_textdomain("ado", get_template_directory() . "/library/translation");

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
  $content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size("ado_post_thumb", 600, 400);
// Only limit height
add_image_size("ado_post_full", 9999, 720);
add_image_size("ado_project_thumb", 600, 600);
// Only limit height
add_image_size("ado_project_full", 9999, 1000);

/*
  ADO
*/

// Custom post types
function ado_create_posttypes() {
  register_post_type('project',
  // CPT Options
    array(
      'labels' => array(
        'name' => 'Projects',
        'singular_name' => 'project'
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-format-gallery',
      'taxonomies' => array('bachelor', 'master', 'graduate'),
      'supports' => array('title', 'editor', 'thumbnail'),
      'rewrite' => array('slug' => 'projects')
    )
  );
}
function ado_create_taxonomies() {
  register_taxonomy('bachelor', 'project', array(
    'labels' => array(
        'name' => 'Bachelor’s',
        'menu_name' => 'Bachelor’s',
        'add_new_item' => 'Add New Bachelor'
      ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'bachelor')
  ));
  register_taxonomy('master', 'project', array(
    'labels' => array(
        'name' => 'Master’s',
        'menu_name' => 'Master’s',
        'add_new_item' => 'Add New Master'
      ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'master')
  ));
  register_taxonomy('graduate', 'project', array(
    'labels' => array(
        'name' => 'Graduates',
        'menu_name' => 'Graduates',
        'add_new_item' => 'Add New Graduate'
      ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'graduate')
  ));
  register_taxonomy('type', 'project', array(
    'labels' => array(
        'name' => 'Project Type',
        'menu_name' => 'Project Types',
        'add_new_item' => 'Add New Type'
      ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'type')
  ));
}
function cleanse_rewrite() {
  flush_rewrite_rules();
}

// Hooking up our function to theme setup
add_action( 'init', 'ado_create_posttypes' );
add_action( 'init', 'ado_create_taxonomies' );
add_action( 'init', 'cleanse_rewrite' );

function ado_fonts() {
  wp_enqueue_style('googleFonts', 'http://fonts.googleapis.com/css?family=Playfair+Display:400|Playfair+Display+SC:400,700|Open+Sans:400,600');
}
add_action('wp_enqueue_scripts', 'ado_fonts');

// Remove comments from sidebar
add_action('admin_menu', 'ado_clean_menu');
function ado_clean_menu() {
  remove_menu_page('edit-comments.php');
}

// Connect Simple Fields.
function ado_sf_connect($connector, $post) {
  if ("home" === $post->post_name) {
    $connector = "sfc_homepage";
  } else if ("project" === $post->post_type || "post" === $post->post_type) {
    $connector = "sfc_images";
  }
  return $connector;
}
add_filter("simple_fields_get_selected_connector_for_post", "ado_sf_connect", 10, 2);

/* DON'T DELETE THIS CLOSING TAG */ ?>
