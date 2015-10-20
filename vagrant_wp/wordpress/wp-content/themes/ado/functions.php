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
    array(
      'labels' => array(
        'name' => 'Projects',
        'singular_name' => 'Project'
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-format-gallery',
      'taxonomies' => array('person'),
      'supports' => array('title', 'editor', 'thumbnail'),
      'rewrite' => array('slug' => 'projects')
    )
  );
}
function ado_create_taxonomies() {
  register_taxonomy('person', 'project', array(
    'labels' => array(
        'name' => 'Project Author',
        'menu_name' => 'Project Authors',
        'add_new_item' => 'Add New Author'
      ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'people')
  ));
  register_taxonomy('type', 'project', array(
    'labels' => array(
        'name' => 'Project Type',
        'menu_name' => 'Project Types',
        'add_new_item' => 'Add New Type'
      ),
    'hierarchical' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'projects')
  ));
}

// https://codeable.io/community/get-your-custom-taxonomy-urls-in-order/
function generate_taxonomy_rewrite_rules( $wp_rewrite ) {
  $rules = array();
  $post_types = get_post_types( array( 'name' => 'project', 'public' => true, '_builtin' => false ), 'objects' );
  $taxonomies = get_taxonomies( array( 'name' => 'type', 'public' => true, '_builtin' => false ), 'objects' );

  foreach ( $post_types as $post_type ) {
    $post_type_name = $post_type->name; // 'developer'
    $post_type_slug = $post_type->rewrite['slug']; // 'developers'

    foreach ( $taxonomies as $taxonomy ) {
      if ( $taxonomy->object_type[0] == $post_type_name ) {
        $terms = get_categories( array( 'type' => $post_type_name, 'taxonomy' => $taxonomy->name, 'hide_empty' => 0 ) );
        foreach ( $terms as $term ) {
          $rules[$post_type_slug . '/' . $term->slug . '/?$'] = 'index.php?' . $term->taxonomy . '=' . $term->slug;
        }
      }
    }
  }
  $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}

// Hooking up our function to theme setup
add_action('init', 'ado_create_posttypes');
add_action('init', 'ado_create_taxonomies');
add_action('generate_rewrite_rules', 'generate_taxonomy_rewrite_rules');

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

// Get rid of Emoji fluff.
remove_action("wp_head", "print_emoji_detection_script", 7);
remove_action("wp_print_styles", "print_emoji_styles" );

function alter_query($query) {
  // Do not alter the query on wp-admin pages and only alter it if it's the main query.
  if (!is_admin() && $query->is_main_query()){

    // For projects archive.
    if (is_post_type_archive()) {
      $query->set('posts_per_page', 20);
    }

  }
}
add_action('pre_get_posts', 'alter_query');

/* DON'T DELETE THIS CLOSING TAG */ ?>
