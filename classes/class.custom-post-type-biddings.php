<?php
/**
 *
 *  Custom Post Type Biddings
 *
 */
class Custom_Post_Type_Biddings
{



	/**
	 * Plugin constructor
	 *
	 * @return void
	 * @author Ralf Hortt
	 * @since 1.0
	 **/
	public function __construct()
	{

		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

	} // END __construct



	/**
	 * Load plugin translation
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt <me@horttcore.de>
	 * @since v1.0
	 **/
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain( 'custom-post-type-biddings', false, dirname( plugin_basename( __FILE__ ) ) . '/../languages/'  );

	} // END load_plugin_textdomain



	/**
	 * Register Post Type
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 * @since 1.0
	 */
	public function register_post_type()
	{

		register_post_type( 'bidding', [
			'labels' => [
				'name' => _x( 'Biddings', 'post type general name', 'custom-post-type-biddings' ),
				'singular_name' => _x( 'Bidding', 'post type singular name', 'custom-post-type-biddings' ),
				'add_new' => _x( 'Add New', 'Bidding', 'custom-post-type-biddings' ),
				'add_new_item' => __( 'Add New Bidding', 'custom-post-type-biddings' ),
				'edit_item' => __( 'Edit Bidding', 'custom-post-type-biddings' ),
				'new_item' => __( 'New Bidding', 'custom-post-type-biddings' ),
				'view_item' => __( 'View Bidding', 'custom-post-type-biddings' ),
				'view_items' => __('View Biddings', 'custom-post-type-biddings'),
				'search_items' => __( 'Search Biddings', 'custom-post-type-biddings' ),
				'not_found' =>  __( 'No Biddings found', 'custom-post-type-biddings' ),
				'not_found_in_trash' => __( 'No Biddings found in Trash', 'custom-post-type-biddings' ),
				'parent_item_colon' => __('Parent Bidding:', 'custom-post-type-biddings' ),
				'all_items' => __( 'All Biddings', 'custom-post-type-biddings' ),
				'archives' => __( 'Bidding Archives', 'custom-post-type-biddings' ),
				'attributes' => __( 'Bidding Attributes', 'custom-post-type-biddings' ),
				'insert_into_item' => __( 'Insert into bidding', 'custom-post-type-biddings' ),
				'uploaded_to_this_item' => __( 'Uploaded to this bidding', 'custom-post-type-biddings' ),
				'featured_image' => __( 'Featured Image', 'custom-post-type-biddings' ),
				'set_featured_image' => __( 'Set featured image', 'custom-post-type-biddings' ),
				'remove_featured_image' => __( 'Remove featured image', 'custom-post-type-biddings' ),
				'use_featured_image' => __( 'Use as featured image', 'custom-post-type-biddings' ),
				'filter_items_list' => __( 'Filter bidding list', 'custom-post-type-biddings' ),
				'items_list_navigation' => __( 'Bidding list navigation', 'custom-post-type-biddings' ),
				'items_list' => __( 'Biddings list', 'custom-post-type-biddings' ),
				'menu_name' => __( 'Biddings', 'custom-post-type-biddings' )
			],
			'public' => TRUE,
			'publicly_queryable' => TRUE,
			'show_ui' => TRUE,
			'show_in_menu' => TRUE,
			'query_var' => TRUE,
			'rewrite' => [
				'slug' => _x( 'bidding', 'Post Type Slug', 'custom-post-type-biddings' ),
				'with_front' => FALSE,
			],
			'capability_type' => 'post',
			'has_archive' => TRUE,
			'hierarchical' => TRUE,
			'menu_position' => NULL,
			'supports' => array('title', 'editor', 'page-attributes' ),
			'menu_icon' => 'dashicons-media-text'
		] );

	} // END register_post_type


} // END class Custom_Post_Type_Biddings

new Custom_Post_Type_Biddings;
