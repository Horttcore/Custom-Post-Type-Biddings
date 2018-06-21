<?php
/**
 *  Shortcode [biddings]
 */
 class Custom_Post_Type_Biddings_Shortcode
 {



	/**
	 * Constructor
	 *
	 * @access public
	 * @since v1.2
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function __construct()
	{

		add_shortcode( 'biddings', array( $this, 'shortcode' ) );

	} // END __construct



	/**
	 * Output
	 *
	 * @access public
	 * @param array $atts Shortcode parameters
	 * @return string Shortcode render
	 * @since v1.2
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function shortcode( $atts )
	{

		ob_start();

		// Defaults
		$query = shortcode_atts( array(
			'bidding-category' => '',
			'orderby' => 'bidding_date',
			'order' => 'ASC',
			'showposts' => get_option( 'posts_per_page' ),
			'type' => 'future',
		), $atts );

		$query['post_type'] = 'bidding';
		$query = array_filter( $query );

		// Bidding category
		if ( isset( $query['bidding-category'] ) ) :
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'bidding-category',
					'field' => 'term_id',
					'terms' => $query['bidding-category'],
				)
			);
		endif;

		// Shortcode render
		$query = new WP_Query( apply_filters( 'custom-post-type-biddings-shortcode-query', $query ) );

		if ( $query->have_posts() ) :

			do_action( 'custom-post-type-biddings-shortcode-output', $query );

		endif;

		wp_reset_query();

		return ob_get_clean();

	} // END shortcode



	/**
	 * Shortcode output
	 *
	 * @static
	 * @access public
	 * @param WP_Query $query Query object
	 * @return void
	 * @since v1.2
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	static public function shortcode_output( $query )
	{

		/**
		 * Before shortcode biddings loop
		 *
		 * @param WP_Query $query Query object
		 * @hooked Custom_Post_Type_Biddings::loop_before - 10
		 */
		do_action( 'custom-post-type-biddings-shortcode-before-loop', $query );

		while ( $query->have_posts() ) : $query->the_post();

			/**
			 * Loop output
			 *
			 * @param WP_Query $query Query object
			 * @hooked Custom_Post_Type_Biddings::loop - 10
			 */
			do_action( 'custom-post-type-biddings-shortcode-loop', $query );

		endwhile;

		/**
		 * After shortcode biddings loop
		 *
		 * @param WP_Query $query Query object
		 * @hooked Custom_Post_Type_Biddings::loop_after - 10
		 */
		do_action( 'custom-post-type-biddings-shortcode-before-loop', $query );

	} // END shortcode_output



} // END final class Custom_Post_Type_Biddings_Shortcode
new Custom_Post_Type_Biddings_Shortcode;
