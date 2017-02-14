<?php
function my_scripts_method() {

    $templateuri = get_template_directory_uri() . '/js/';

    $jslib = $templateuri."lib.js";
    wp_enqueue_script( 'jslib', $jslib,'','',true);
    $myscripts = $templateuri."main.min.js";
    wp_enqueue_script( 'myscripts', $myscripts,'','',true);

    wp_enqueue_style( 'site', get_stylesheet_directory_uri() . '/css/site.min.css' );

}
add_action('wp_enqueue_scripts', 'my_scripts_method');

if ( function_exists( 'add_theme_support' ) ) {
  	add_theme_support( 'post-thumbnails' );
}
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'admin-thumb', 150, 150, false );
	add_image_size( 'opengraph', 400, 300, true );

	add_image_size( 'large', 700, 9999, false );

	add_image_size( 'col-thin', 160, 9999, false );
	add_image_size( 'col-wide', 600, 9999, false );

	add_image_size( 'gallery', 600, 400, false );

	add_image_size( 'slide', 1400, 1400, false );

	add_image_size( 'hover-thumb', 200, 200, false );
}

get_template_part( 'lib/gallery' );
get_template_part( 'lib/post-types' );
get_template_part( 'lib/meta-boxes' );
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 11 );
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'lib/metabox/init.php';

}

/* disable that freaking admin bar */
add_filter('show_admin_bar', '__return_false');
/* turn off version in meta */
function no_generator() { return ''; }
add_filter( 'the_generator', 'no_generator' );
/* show thumbnails in admin lists */
add_filter('manage_posts_columns', 'new_add_post_thumbnail_column');
function new_add_post_thumbnail_column($cols){
	$cols['new_post_thumb'] = __('Thumbnail');
	return $cols;
}
add_action('manage_posts_custom_column', 'new_display_post_thumbnail_column', 5, 2);
function new_display_post_thumbnail_column($col, $id){
	switch($col){
		case 'new_post_thumb':
		if( function_exists('the_post_thumbnail') ) {
			echo the_post_thumbnail( 'admin-thumb' );
			}
		else
		echo 'Not supported in theme';
		break;
	}
}

// remove automatic <a> links from images in blog
function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'wpb_imagelink_setup', 10);

/* stuff */
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function is_active_page($page) {
  if (is_page($page)) {
    echo 'active';
  }
}

function is_active_post($type) {
  if (is_post_type_archive($type) || is_singular($type)) {
    echo 'active';
  }
}

function is_active_news() {
  if (is_post_type_archive('post') || is_singular('post') || is_category('news')) {
    echo 'active';
  }
}

function is_active_ma() {
  if (is_post_type_archive('students') || is_singular('students') || is_page('ma-programme')) {
    echo 'active';
  }
}


?>
