<?php
add_action( 'init', 'register_cpt_artists' );

function register_cpt_artists() {

    $labels = array(
        'name' => _x( 'Artists', 'artists' ),
        'singular_name' => _x( 'Artist', 'artists' ),
        'add_new' => _x( 'Add New', 'artists' ),
        'add_new_item' => _x( 'Add New Artist', 'artists' ),
        'edit_item' => _x( 'Edit Artist', 'artists' ),
        'new_item' => _x( 'New Artist', 'artists' ),
        'view_item' => _x( 'View Artist', 'artists' ),
        'search_items' => _x( 'Search Artists', 'artists' ),
        'not_found' => _x( 'No artists found', 'artists' ),
        'not_found_in_trash' => _x( 'No artists found in Trash', 'artists' ),
        'parent_item_colon' => _x( 'Parent Artist:', 'artists' ),
        'menu_name' => _x( 'Artists', 'artists' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'editor', 'thumbnail' ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'artists', $args );
}


add_action( 'init', 'register_cpt_projects' );

function register_cpt_projects() {

    $labels = array(
        'name' => _x( 'Projects', 'projects' ),
        'singular_name' => _x( 'Project', 'projects' ),
        'add_new' => _x( 'Add New', 'projects' ),
        'add_new_item' => _x( 'Add New Project', 'projects' ),
        'edit_item' => _x( 'Edit Project', 'projects' ),
        'new_item' => _x( 'New Project', 'projects' ),
        'view_item' => _x( 'View Project', 'projects' ),
        'search_items' => _x( 'Search Projects', 'projects' ),
        'not_found' => _x( 'No projects found', 'projects' ),
        'not_found_in_trash' => _x( 'No projects found in Trash', 'projects' ),
        'parent_item_colon' => _x( 'Parent Project:', 'projects' ),
        'menu_name' => _x( 'Projects', 'projects' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies' => array( 'category' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'projects', $args );
}
add_action( 'init', 'register_cpt_students' );

function register_cpt_students() {

    $labels = array(
        'name' => _x( 'Students', 'students' ),
        'singular_name' => _x( 'Student', 'students' ),
        'add_new' => _x( 'Add New', 'students' ),
        'add_new_item' => _x( 'Add New Student', 'students' ),
        'edit_item' => _x( 'Edit Student', 'students' ),
        'new_item' => _x( 'New Student', 'students' ),
        'view_item' => _x( 'View Student', 'students' ),
        'search_items' => _x( 'Search Students', 'students' ),
        'not_found' => _x( 'No students found', 'students' ),
        'not_found_in_trash' => _x( 'No students found in Trash', 'students' ),
        'parent_item_colon' => _x( 'Parent Student:', 'students' ),
        'menu_name' => _x( 'Students', 'students' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies' => array( 'category' ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'students', $args );
}
add_action( 'init', 'register_cpt_shop' );

function register_cpt_shop() {

    $labels = array(
        'name' => _x( 'Shop', 'shop' ),
        'singular_name' => _x( 'Shop', 'shop' ),
        'add_new' => _x( 'Add New', 'shop' ),
        'add_new_item' => _x( 'Add New Shop', 'shop' ),
        'edit_item' => _x( 'Edit Shop', 'shop' ),
        'new_item' => _x( 'New Shop', 'shop' ),
        'view_item' => _x( 'View Shop', 'shop' ),
        'search_items' => _x( 'Search Shop', 'shop' ),
        'not_found' => _x( 'No shop found', 'shop' ),
        'not_found_in_trash' => _x( 'No shop found in Trash', 'shop' ),
        'parent_item_colon' => _x( 'Parent Shop:', 'shop' ),
        'menu_name' => _x( 'Shop', 'shop' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'editor', 'thumbnail' ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'shop', $args );
}
add_action( 'init', 'register_cpt_home_slide' );

function register_cpt_home_slide() {

    $labels = array(
        'name' => _x( 'Home Slides', 'home_slide' ),
        'singular_name' => _x( 'Home Slide', 'home_slide' ),
        'add_new' => _x( 'Add New', 'home_slide' ),
        'add_new_item' => _x( 'Add New Home Slide', 'home_slide' ),
        'edit_item' => _x( 'Edit Home Slide', 'home_slide' ),
        'new_item' => _x( 'New Home Slide', 'home_slide' ),
        'view_item' => _x( 'View Home Slide', 'home_slide' ),
        'search_items' => _x( 'Search Home Slides', 'home_slide' ),
        'not_found' => _x( 'No home slides found', 'home_slide' ),
        'not_found_in_trash' => _x( 'No home slides found in Trash', 'home_slide' ),
        'parent_item_colon' => _x( 'Parent Home Slide:', 'home_slide' ),
        'menu_name' => _x( 'Home Slides', 'home_slide' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,

        'supports' => array( 'title', 'thumbnail' ),

        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,

        'show_in_nav_menus' => true,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'post'
    );

    register_post_type( 'home_slide', $args );
}
?>