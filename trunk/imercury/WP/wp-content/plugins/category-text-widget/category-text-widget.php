<?php 
/*
Plugin Name: Category Text Widget
Plugin URI: http://shailan.com/wordpress/plugins/category-based-text-widget
Description: A multi widget to display text based on current category.
Version: 1.2
Author: Matt Say
Author URI: http://shailan.com
*/

define('SHAILAN_CT_VERSION','1.2');
define('SHAILAN_CT_TITLE', 'Category Based Text');

/**
 * Shailan Category Text Widget Class
 */
class shailan_CategoryTextWidget extends WP_Widget {
    /** constructor */
    function shailan_CategoryTextWidget() {
		$widget_ops = array('classname' => 'shailan-category-text', 'description' => __( 'Category based text/html' ) );
		$this->WP_Widget('shailan-category-text-widget', __('Category Text'), $widget_ops);
		$this->alt_option_name = 'widget_shailan_categoryText';
		
		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array(&$this, 'styles') );

		$this->widget_defaults = array(
			'title' => '',
			'text'	=> '',
			'category' => 'shailan-show-all-categories',
			'home' => ''
		);
    }
	
    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
		global $post;
		global $wpdb, $wp_locale, $wp_query;
	
        extract( $args );
		$widget_options = wp_parse_args( $instance, $this->widget_defaults );
		extract( $widget_options, EXTR_SKIP );
		
		// Filter widget title
        $title = apply_filters('widget_title', $title);
		$home = (bool) $home;
		
		$c1 = (is_home() && $home);
		$c2 = ((is_category() || is_single()) && $category == 'shailan-show-all-categories');
		$c3 = (is_home() && $category == 'shailan-home-only');
		$c4 = (is_single() && in_category( $category, $post->ID ));
		$c5 = (is_category($category));
		
		if( $c1 || $c2 || $c3 || $c4 || $c5 ){					
			?>
				  <?php echo $before_widget; ?>
					<?php if ( $title )
							echo $before_title . $title . $after_title;
					?>

				<div id="shailan-category-text-<?php echo $this->number; ?>">
					<?php echo do_shortcode($text); ?>
				</div> 			
				
				  <?php echo $after_widget; ?>
			<?php
		}
		
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
		$widget_options = wp_parse_args( $instance, $this->widget_defaults );
		extract( $widget_options, EXTR_SKIP );
		
        $title = esc_attr($title);
		$home = (bool) $home;
		
        ?>		
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		
		<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Content:'); ?><textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" rows="6"><?php echo $text; ?></textarea>
		</label></p> 
			
		<p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Display for:'); ?><select name="<?php echo $this->get_field_name('category'); ?>" id="<?php echo $this->get_field_id('category'); ?>" > 	
			<option value="shailan-show-all-categories" <?php if('shailan-show-all-categories' == $category){ echo "selected=\"selected\""; } ?> >All categories</option>		
			<option value="shailan-home-only" <?php if('shailan-home-only' == $category){ echo "selected=\"selected\""; } ?> >Homepage only</option>		
 <?php 
  $categories = get_categories(''); 
  foreach ($categories as $cat) {  
  	$option = '<option value="'.$cat->category_nicename .'" '. ( $cat->category_nicename == $category ? ' selected="selected"' : '' ) .'>';
	$option .= $cat->cat_name;
	$option .= '</option>\n';
	echo $option;
  }
 ?>
</select></label></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('home'); ?>" name="<?php echo $this->get_field_name('home'); ?>"<?php checked( $home ); ?> />
		<label for="<?php echo $this->get_field_id('home'); ?>"><?php _e( 'Display on homepage'); ?></label></p>
			
		<div class="widget-control-actions alignright">
		<small><a href="http://shailan.com/wordpress/plugins/category-based-text-widget">Visit plugin site</a></small>
		</div>
		<br class="clear">
			
        <?php 
	}
	
	function styles($instance){
		// additional styles will be printed here.
	}

} // class shailan_CategoryTextWidget

// register widget
add_action('widgets_init', create_function('', 'return register_widget("shailan_CategoryTextWidget");'));
