<?php
/**
 * @package Content Aware Sidebars
 * @author Joachim Jensen <jv@intox.dk>
 */

/**
 *
 * Post Type Module
 *
 * Detects if current content is:
 * a) specific post type or specific post
 * b) specific post type archive or home
 * 
 */
class CASModule_post_type extends CASModule {
	
	private $post_type_objects;
	
	public function __construct() {
		parent::__construct();
		$this->id = 'post_types';
		$this->name = __('Post Types','content-aware-sidebars');
	}
	
	public function _get_content() {
		
	}
	
	public function is_content() {
		return ((is_singular() || is_home()) && !is_front_page()) || is_post_type_archive();
	}
	
	public function db_where() {
		if(is_singular()) {
			return "(post_types.meta_value IS NULL OR post_types.meta_value IN('".get_post_type()."','".get_the_ID()."'))";
		}
		global $post_type;
		
		// Home has post as default post type
		if(!$post_type) $post_type = 'post';
		return "(post_types.meta_value IS NULL OR post_types.meta_value = '".$post_type."')";
	}

	public function meta_box_content() {
		global $post;

		foreach ($this->_get_post_types() as $post_type) {
			echo '<h4><a href="#">' . $post_type->label . '</a></h4>'."\n";
			echo '<div class="cas-rule-content" id="cas-' . $this->id . '-' . $post_type->name . '">'."\n";
			$meta = get_post_meta($post->ID, ContentAwareSidebars::prefix . 'post_types', false);
			$current = $meta != '' ? $meta : array();

			$exclude = array();
			if ($post_type->name == 'page' && 'page' == get_option('show_on_front')) {
				$exclude[] = get_option('page_on_front');
				$exclude[] = get_option('page_for_posts');
			}

			//WP3.1 does not support (array) as post_status
			$posts = get_posts(array(
				'numberposts'	=> 200,
				'post_type'	=> $post_type->name,
				'post_status'	=> 'publish,private,future',
				'exclude'	=> $exclude
			));
			
			//WP3.1.4 does not support $post_type->labels->all_items
			echo '<p>' . "\n";
			echo '<label><input type="checkbox" name="post_types[]" value="' . $post_type->name . '"' . checked(in_array($post_type->name, $current), true, false) . ' /> ' . sprintf(__('Show with All %s', 'content-aware-sidebars'), $post_type->label) . '</label>' . "\n";
			echo '</p>' . "\n";

			if (!$posts || is_wp_error($posts)) {
				echo '<p>' . __('No items.') . '</p>';
			} else {

?>	
						<div id="posttype-<?php echo $post_type->name; ?>" class="categorydiv" style="min-height:100%;">
						<ul id="posttype-<?php echo $post_type->name; ?>-tabs" class="category-tabs">
							<li class="tabs"><a href="#<?php echo $post_type->name; ?>-all" tabindex="3"><?php _e('View All'); ?></a></li>
						</ul>		
						<div id="<?php echo $post_type->name; ?>-all" class="tabs-panel" style="min-height:100%;">
							<ul id="<?php echo $post_type->name; ?>checklist" class="list:<?php echo $post_type->name ?> categorychecklist form-no-clear">
				<?php cas_posts_checklist($post->ID, array('post_type' => $post_type, 'posts' => $posts)); ?>
							</ul>
						</div>
						</div>	
				<?php
			}

			echo '</div>';
		}
	}

	private function _get_post_types() {
		if (empty($this->post_type_objects)) {
			// List public post types
			foreach (get_post_types(array('public' => true), 'objects') as $post_type) {
				$this->post_type_objects[$post_type->name] = $post_type;
			}
		}
		return $this->post_type_objects;
	}

}
