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
		'name'                  => _x( 'Media Coverage', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'News Mention', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Media Coverage', 'text_domain' ),
		'name_admin_bar'        => __( 'News Mention', 'text_domain' ),
		'archives'              => __( 'Media Coverage', 'text_domain' ),
		'attributes'            => __( 'Media Coverage Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Media Coverage:', 'text_domain' ),
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
		'description'           => __( 'List of mentions from media outlets.', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array('title', 'editor', 'custom-fields', 'thumbnail' ),
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

/**
 * Adds a meta box to the post editing screen
 */
function sm_custom_meta_url() {
    add_meta_box( 'sm_meta', __( 'Add the URL of the media mention', 'sm-textdomain' ), 'sm_meta_callback', 'media-coverage' );
}
add_action( 'add_meta_boxes', 'sm_custom_meta_url' );

/**
 * Outputs the content of the meta box
 */
function sm_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'sm_nonce' );
    $sm_stored_meta = get_post_meta( $post->ID );
    ?>

    <p>
        <label for="coverage-url" class="sm-row-title"><?php _e( 'URL', 'sm-textdomain' )?></label>
        <input size="105" type="text" name="coverage-url" id="coverage-url" value="<?php if ( isset ( $sm_stored_meta['coverage-url'] ) ) echo $sm_stored_meta['coverage-url'][0]; ?>" />
    </p>

    <?php
}

/**
 * Saves the custom meta input
 */
function sm_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and sanitizes/saves if needed
    if( isset( $_POST[ 'coverage-url' ] ) ) {
        update_post_meta( $post_id, 'coverage-url', sanitize_text_field( $_POST[ 'coverage-url' ] ) );
    }
}
add_action( 'save_post', 'sm_meta_save' );

/* Stop Adding Functions Below this Line */
?>
