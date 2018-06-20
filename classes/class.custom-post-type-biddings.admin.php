<?php
/**
 * Custom Post Type Biddings Admin
 *
 * @package Custom Post Type Biddings
 * @since 1.0
 * @author Ralf Hortt <me@horttcore.de>
 */
class Custom_Post_Type_Biddings_Admin
{



	/**
	 * Plugin constructor
	 *
	 * @access public
	 * @since 1.0
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function __construct()
	{

		add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );

	} // END __construct


	/**
	 * Update messages
	 *
	 * @access public
	 * @param array $messages Messages
	 * @return array Messages
	 * @since 1.0
	 * @author Ralf Hortt <me@horttcore.de>
	 **/
	public function post_updated_messages( $messages )
	{

		$post             = get_post();
		$post_type        = 'bidding';
		$post_type_object = get_post_type_object( $post_type );

		$messages[$post_type] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Bidding updated.', 'custom-post-type-biddings' ),
			2  => __( 'Custom field updated.' ),
			3  => __( 'Custom field deleted.' ),
			4  => __( 'Bidding updated.', 'custom-post-type-biddings' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Bidding restored to revision from %s', 'custom-post-type-biddings' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Bidding published.', 'custom-post-type-biddings' ),
			7  => __( 'Bidding saved.', 'custom-post-type-biddings' ),
			8  => __( 'Bidding submitted.', 'custom-post-type-biddings' ),
			9  => sprintf( __( 'Bidding scheduled for: <strong>%1$s</strong>.', 'custom-post-type-biddings' ), date_i18n( __( 'M j, Y @ G:i', 'custom-post-type-biddings' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Bidding draft updated.', 'custom-post-type-biddings' )
		);

		if ( !$post_type_object->publicly_queryable )
			return $messages;

		$permalink = get_permalink( $post->ID );

		$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View bidding', 'custom-post-type-biddings' ) );
		$messages[$post_type][1] .= $view_link;
		$messages[$post_type][6] .= $view_link;
		$messages[$post_type][9] .= $view_link;

		$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
		$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview bidding', 'custom-post-type-biddings' ) );
		$messages[$post_type][8]  .= $preview_link;
		$messages[$post_type][10] .= $preview_link;

		return $messages;

	} // END post_updated_messages



} // END class Custom_Post_Type_Biddings_Admin

new Custom_Post_Type_Biddings_Admin;
