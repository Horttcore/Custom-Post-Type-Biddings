<?php
/**
 * Widget
 *
 * @author Ralf Hortt
 */
class Custom_Post_Type_Biddings_Widget extends WP_Widget {



	/**
	 * Constructor
	 *
	 * @access public
	 * @since v0.3
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function __construct()
	{

		$widget_ops = array(
			'classname' => 'widget-biddings',
			'description' => __( 'Lists the latest biddings', 'custom-post-type-biddings' ),
		);
		$control_ops = array( 'id_base' => 'widget-biddings' );
		parent::__construct( 'widget-biddings', __( 'Biddings', 'custom-post-type-biddings' ), $widget_ops, $control_ops );

	} // END __construct



	/**
	 * Output
	 *
	 * @access public
	 * @param array $args Arguments
	 * @param array $instance Widget instance
	 * @since v0.3
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function widget( $args, $instance )
	{

		$query = array(
			'post_type' => 'bidding',
			'showposts' => $instance['limit'],
			'orderby' => $instance['orderby'],
			'order' => $instance['order'],
		);

		if ( 0 != $instance['bidding-category'] ) :
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'bidding-category',
					'field' => 'term_id',
					'terms' => $instance['bidding-category'],
				)
			);
		endif;

		$query = new WP_Query( apply_filters( 'custom-post-type-biddings-widget-query', $query, $args, $instance ) );

		if ( $query->have_posts() ) :

			/**
			 * Widget output
			 *
			 * @param array $args Arguments
			 * @param array $instance Widget instance
			 * @param obj $query WP_Query object
			 * @hooked Custom_Post_Type_Widget::widget_output - 10
			 */
			do_action( 'custom-post-type-biddings-widget-output', $args, $instance, $query );

		endif;

		wp_reset_query();

	} // END widget



	/**
	 * Save widget settings
	 *
	 * @access public
	 * @param array $new_instance New widget instance
	 * @param array $old_instance Old widget instance
	 * @author Ralf Hortt <me@horttcore.de>
	 */
	public function update( $new_instance, $old_instance )
	{

		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		$instance['limit'] = $new_instance['limit'];
		$instance['bidding-category'] = $new_instance['bidding-category'] ?? FALSE;

		return $instance;

	} // END update



	/**
	 * Widget settings
	 *
	 * @access public
	 * @param array $instance Widget instance
	 * @author Ralf Hortt <me@horttcore.de>
	 * @since v0.3
	 */
	public function form( $instance )
	{

		?>

		<p>
			<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label><br>
			<input class="regular-text" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" id="<?php if ( $this->get_field_name( 'title' ) ) echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ) ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'orderby' ); ?>"><?php _e( 'Order By:', 'custom-post-type-biddings' ); ?></label><br>
			<select name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<option <?php selected( $instance['orderby'], 'ID' ) ?> value="ID"><?php _e( 'ID', 'custom-post-type-biddings' ); ?></option>
				<option <?php selected( $instance['orderby'], 'title' ) ?> value="title"><?php _e( 'Title', 'custom-post-type-biddings' ); ?></option>
				<option <?php selected( $instance['orderby'], 'date' ) ?> value="date"><?php _e( 'Publishing date', 'custom-post-type-biddings' ); ?></option>
				<option <?php selected( $instance['orderby'], 'menu_order' ) ?> value="date"><?php _e( 'Menu order', 'custom-post-type-biddings' ); ?></option>
				<option <?php selected( $instance['orderby'], 'rand' ) ?> value="rand"><?php _e( 'Random', 'custom-post-type-biddings' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'order' ); ?>"><?php _e( 'Order:', 'custom-post-type-biddings' ); ?></label><br>
			<select name="<?php echo $this->get_field_name( 'order' ); ?>" id="<?php echo $this->get_field_name( 'order' ); ?>">
				<option><?php _e( 'Ascending', 'custom-post-type-biddings' ); ?></option>
				<option><?php _e( 'Descending', 'custom-post-type-biddings' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_name( 'limit' ); ?>"><?php _e( 'Limit:', 'custom-post-type-biddings' ); ?></label><br>
			<input class="regular-text" type="text" name="<?php echo $this->get_field_name( 'limit' ); ?>" id="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo esc_attr( $instance['limit'] ) ?>">
		</p>

		<?php
		$category_dropdown = wp_dropdown_categories(array(
			'show_option_all' => __( 'All', 'custom-post-type-biddings' ),
			'taxonomy' => 'bidding-category',
			'name' => $this->get_field_name( 'bidding-category' ),
			'selected' => $instance['bidding-category'],
			'hide_if_empty' => TRUE,
			'hide_empty' => FALSE,
			'hierarchical' => TRUE,
			'echo' => FALSE
		));

		if ( $category_dropdown ) :

			?>

			<p>
				<label for="<?php echo $this->get_field_name( 'bidding-category' ); ?>"><?php _e( 'Bidding Category', 'custom-post-type-biddings' ); ?></label><br>
				<?php echo $category_dropdown ?>
			</p>

			<?php

		endif;

	} // END form



	/**
	 * Widget output
	 *
	 * @static
	 * @access public
	 * @param array $args Arguments
	 * @param array $instance Widget instance
	 * @param obj $query WP_Query object
	 * @author Ralf Hortt <me@horttcore.de>
	 * @since v0.3
	 **/
	static public function widget_output( $args, $instance, $query )
	{

		echo $args['before_widget'];

		if ( isset( $instance['title'] ) && '' != $instance['title'] )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		/**
		 * Before widget loop
		 *
		 * @param WP_Query $query WP_Query object
		 * @param array $args Arguments
		 * @param array $instance Widget instance
		 * @hooked Custom_Post_Type_Biddings::loop_after - 10
		 */
		do_action( 'custom-post-type-biddings-widget-before-loop', $query, $args, $instance );

		while ( $query->have_posts() ) : $query->the_post();

			/**
			 * Loop output
			 *
			 * @param WP_Query $query WP_Query object
			 * @param array $args Arguments
			 * @param array $instance Widget instance
			 * @hooked Custom_Post_Type_Biddings::loop - 10
			 */
			do_action( 'custom-post-type-biddings-widget-loop', $query, $args, $instance );

		endwhile;

		/**
		 * After widget loop
		 *
		 * @param WP_Query $query WP_Query object
		 * @param array $args Arguments
		 * @param array $instance Widget instance
		 * @hooked Custom_Post_Type_Biddings::loop_after - 10
		 */
		do_action( 'custom-post-type-biddings-widget-after-loop', $query, $args, $instance );

		echo $args['after_widget'];

	} // END widget_output



} // END class Custom_Post_Type_Biddings_Widget
