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

		add_action( 'custom-post-type-biddings-shortcode-output', 'Custom_Post_Type_Biddings_Shortcode::shortcode_output', 10, 3 );
		add_action( 'custom-post-type-biddings-shortcode-before-loop', 'Custom_Post_Type_Biddings::loop_before', 10, 3 );
		add_action( 'custom-post-type-biddings-shortcode-loop', 'Custom_Post_Type_Biddings::loop', 10, 3 );
		add_action( 'custom-post-type-biddings-shortcode-after-loop', 'Custom_Post_Type_Biddings::loop_after', 10, 3 );

		add_action( 'custom-post-type-biddings-widget-output', 'Custom_Post_Type_Biddings_Widget::widget_output', 10, 3 );
		add_action( 'custom-post-type-biddings-widget-before-loop', 'Custom_Post_Type_Biddings::loop_before', 10, 3 );
		add_action( 'custom-post-type-biddings-widget-loop', 'Custom_Post_Type_Biddings::loop', 10, 3 );
		add_action( 'custom-post-type-biddings-widget-after-loop', 'Custom_Post_Type_Biddings::loop_after', 10, 3 );

		add_action( 'init', [$this, 'register_post_type'] );
		add_action( 'init', [$this, 'register_taxonomy'] );
		add_action( 'widgets_init', [$this, 'register_widget'] );
		add_action( 'plugins_loaded', [$this, 'load_plugin_textdomain'] );

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
	 * Loop output
	 *
	 * @static
	 * @access public
	 * @return void
	 * @since v1.2
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	static public function loop()
	{

		?>
		<li>
			<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
		</li>
		<?php

	} // END loop


	/**
	 * After loop output
	 *
	 * @static
	 * @access public
	 * @return void
	 * @since v1.2
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	static public function loop_after()
	{

		?>
		</ul>
		<?php

	} // END loop_after


	/**
	 * After loop output
	 *
	 * @static
	 * @access public
	 * @return void
	 * @since v1.2
	 * @author Ralf Hortt <me@horttcore.de>
 	 */
	static public function loop_before()
	{

		?>
		<ul class="event-list">
		<?php

	} // END loop_before


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
			'rewrite' => array(
				'slug' => _x( 'biddings', 'Post Type Slug', 'custom-post-type-biddings' ),
				'with_front' => FALSE,
			),
			'capability_type' => 'post',
			'has_archive' => TRUE,
			'hierarchical' => TRUE,
			'menu_position' => NULL,
			'supports' => array('title', 'editor', 'page-attributes' ),
			'menu_icon' => 'dashicons-media-text'
		] );

	} // END register_post_type


	/**
	 * Register shortcode
	 *
	 * @return void
	 * @author Ralf Hortt
	 * @since 1.2
	 */
	public function register_shortcode()
	{

		add_shortcode('biddings', ['Custom_Post_Type_Biddings', 'render']);

	} // END register_shortcode


	/**
	 * Register Post Type
	 *
	 * @access public
	 * @return void
	 * @author Ralf Hortt
	 * @since 1.1
	 */
	public function register_taxonomy()
	{

		register_taxonomy( 'bidding-category', array( 'bidding' ), array(
            'hierarchical' => TRUE,
            'labels' => array(
                'name' => _x( 'Bidding Categories', 'taxonomy general name', 'custom-post-type-biddings' ),
                'singular_name' => _x( 'Bidding Category', 'taxonomy singular name', 'custom-post-type-biddings' ),
                'search_items' =>  __( 'Search Bidding Categories', 'custom-post-type-biddings' ),
                'popular_items' =>  __( 'Popular Bidding Categories', 'custom-post-type-biddings' ),
                'all_items' => __( 'All Bidding Categories', 'custom-post-type-biddings' ),
                'parent_item' => __( 'Parent Bidding Category', 'custom-post-type-biddings' ),
                'parent_item_colon' => __( 'Parent Bidding Category:', 'custom-post-type-biddings' ),
                'edit_item' => __( 'Edit Bidding Category', 'custom-post-type-biddings' ),
                'view_item' => __( 'View Bidding Category', 'custom-post-type-biddings' ),
                'update_item' => __( 'Update Bidding Category', 'custom-post-type-biddings' ),
                'add_new_item' => __( 'Add New Bidding Category', 'custom-post-type-biddings' ),
                'new_item_name' => __( 'New Bidding Category Name', 'custom-post-type-biddings' ),
                'separate_items_with_commas' => __( 'Separate bidding categories with commas', 'custom-post-type-biddings' ),
                'add_or_remove_items' => __( 'Add or remove bidding categories', 'custom-post-type-biddings' ),
                'choose_from_most_used' => __( 'Choose from the most used bidding categories', 'custom-post-type-biddings' ),
                'not_found' => __( 'No bidding categories found', 'custom-post-type-biddings' ),
                'no_terms' => __( 'No bidding categories', 'custom-post-type-biddings' ),
                'items_list_navigation' => __( 'Bidding Categories list navigation', 'custom-post-type-biddings' ),
                'items_list' => __( 'Bidding Categories list', 'custom-post-type-biddings' ),
            ),
            'show_ui' => TRUE,
            'query_var' => TRUE,
            'rewrite' => array(
                'slug' => _x( 'bidding-category', 'Bidding Category Slug', 'custom-post-type-biddings' ),
            ),
            'show_admin_column' => TRUE,
        ) );

	} // END register_taxonomy


	/**
	 * Register widget
	 *
	 * @return void
	 * @author Ralf Hortt
	 * @since 1.2
	 */
	public function register_widget()
	{

		register_widget( 'Custom_Post_Type_Biddings_Widget' );

	} // END register_widget


} // END final class Custom_Post_Type_Biddings

new Custom_Post_Type_Biddings;
