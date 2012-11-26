<?php
/**
 * Plugin Name: Goodlayers Recent Portfolio Widget 2
 * Description: A widget that show recent portfolio( Specified by portfolio-category ).
 * Version: 1.0
 * Author: Sittipol Sunthornpiyakul
 * Author URI: http://www.goodlayers.com
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'recent_port_widget2' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function recent_port_widget2() {
	register_widget( 'Recent_Port2' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Recent_Port2 extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Recent_Port2() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'recentport-widget2', 'description' => __('A widget that show last portfolio', 'gdl_back_office') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'recentport-widget2' );

		/* Create the widget. */
		$this->WP_Widget( 'recentport-widget2', __('Recent Port 2nd Style (Goodlayers)', 'gdl_back_office'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('Recent Port 2nd', $instance['title'] );
		$port_cat = $instance['port_cat'];
		if($port_cat == "All"){ $port_cat = ''; }
		$show_num = $instance['show_num'];

		/* Before widget (defined by themes). */
		echo $before_widget;
		if($title)
			echo $before_title . $title . $after_title;
			
		/* Display the widget title if one was input (before and after defined by themes). */
		$custom_posts = get_posts('post_type=portfolio&showposts='.$show_num.'&portfolio-category='.$port_cat);
		if( !empty($custom_posts) ){ 
			echo "<div class='gdl-recent-port-widget'>";
			foreach($custom_posts as $custom_post) { 
				?>
				<div class="recent-port-widget">
					<div class="recent-port-widget-thumbnail">
						<a href="<?php echo get_permalink( $custom_post->ID ); ?>">
							<?php 
								$thumbnail_id = get_post_thumbnail_id( $custom_post->ID );				
								$thumbnail = wp_get_attachment_image_src( $thumbnail_id , '56x56' );
								$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
									
								if( !empty($thumbnail) ){
									echo '<img src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>';
								}
							?>
						</a>
					</div>
				</div>						
				<?php 
				
			}
			echo "<div class='clear'></div>";
			echo "</div>";
		}
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['port_cat'] = strip_tags( $new_instance['port_cat'] );
		$instance['show_num'] = strip_tags( $new_instance['show_num'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Recent Port Widget', 'gdl_back_office'), 'port_cat' => __('All', 'gdl_back_office'), 'show_num' => '3');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title :', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="width100" />
		</p>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'port_cat' ); ?>"><?php _e('Category :', 'gdl_back_office'); ?></label>		
			<select name="<?php echo $this->get_field_name( 'port_cat' ); ?>" id="<?php echo $this->get_field_id( 'port_cat' ); ?>">
				
			<?php 	
			$category_list = get_category_list( 'portfolio-category' ); 
			foreach($category_list as $category ){
			?>
				<option value="<?php echo $category; ?>" <?php if (  $instance['port_cat'] == $category ) echo ' selected="selected"'; ?>><?php echo $category; ?></option>				
			<?php } ?>	
			</select> 
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_num' ); ?>"><?php _e('Show Count :', 'gdl_back_office'); ?></label>
			<input id="<?php echo $this->get_field_id( 'show_num' ); ?>" name="<?php echo $this->get_field_name( 'show_num' ); ?>" value="<?php echo $instance['show_num']; ?>" class="width100" />
		</p>

	<?php
	}
}

?>