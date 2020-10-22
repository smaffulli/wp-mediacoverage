<?php
/*
Plugin Name: Custom post type for media coverage
Description: Custom post type and taxonomy to record mentions in press, tv and other media.
Version: 0.1
Author: Stefano Maffulli
License: GPLv3
*/
/* Start Adding Functions Below this Line */

if ( ! function_exists( 'custom_taxonomy' ) ) {

// Register Custom Taxonomy
function custom_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Media Outlets', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Outlet', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Outlets', 'text_domain' ),
		'all_items'                  => __( 'All Outlets', 'text_domain' ),
		'parent_item'                => __( 'Parent Outlet', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Outlet:', 'text_domain' ),
		'new_item_name'              => __( 'New Outlet', 'text_domain' ),
		'add_new_item'               => __( 'Add New Outlet', 'text_domain' ),
		'edit_item'                  => __( 'Edit Outlet', 'text_domain' ),
		'update_item'                => __( 'Update Outlet', 'text_domain' ),
		'view_item'                  => __( 'View Outlet', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate outlets with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove outlets', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Outlets', 'text_domain' ),
		'search_items'               => __( 'Search Oulets', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No outlets', 'text_domain' ),
		'items_list'                 => __( 'Outlets list', 'text_domain' ),
		'items_list_navigation'      => __( 'Outlets list navigation', 'text_domain' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'show_in_rest'               => true,
	);
	register_taxonomy( 'outlets', array( 'post' ), $args );

}
add_action( 'init', 'custom_taxonomy', 0 );

}



/* Registering the CPT */
if ( ! function_exists('custom_post_type') ) {

// Register Custom Post Type
function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Media coverage', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'News mention', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Media Coverage', 'text_domain' ),
		'name_admin_bar'        => __( 'Post Type', 'text_domain' ),
		'archives'              => __( 'Media Coverage', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Media Coverage', 'text_domain' ),
		'add_new_item'          => __( 'Add Media Mention', 'text_domain' ),
		'add_new'               => __( 'Add New Mention', 'text_domain' ),
		'new_item'              => __( 'New Media Mention', 'text_domain' ),
		'edit_item'             => __( 'Edit Mention', 'text_domain' ),
		'update_item'           => __( 'Update Mention', 'text_domain' ),
		'view_item'             => __( 'View Mention', 'text_domain' ),
		'view_items'            => __( 'View Mentions', 'text_domain' ),
		'search_items'          => __( 'Search Mentions', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Mentions list', 'text_domain' ),
		'items_list_navigation' => __( 'Mentions list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter mentions list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'News mention', 'text_domain' ),
		'description'           => __( 'LIst of mentions from media outlets.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'editor', 'custom-fields' ),
		'taxonomies'            => array( 'outlets' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-format-status',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'media-coverage', $args );

}
add_action( 'init', 'custom_post_type', 0 );

}



/* Stop Adding Functions Below this Line */
?>
