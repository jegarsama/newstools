<?php
/**
 * @package Content Aware Sidebars
 * @author Joachim Jensen <jv@intox.dk>
 */

/**
 *
 * Static Pages Module
 * 
 * Detects if current content is:
 * a) front page
 * b) search results
 * c) 404 page
 *
 */
class CASModule_static extends CASModule {
	
	public function __construct() {
		parent::__construct();
		$this->id = 'static';
		$this->name = __('Static Pages','content-aware-sidebars');
	}
	
	public function _get_content() {
		return array(
				'front-page'	=> __('Front Page', 'content-aware-sidebars'),
				'search'	=> __('Search Results', 'content-aware-sidebars'),
				'404'		=> __('404 Page', 'content-aware-sidebars')
			);
	}
	
	public function is_content() {
		return is_front_page() || is_search() || is_404();
	}
	
	public function db_where() {
		if(is_front_page()) {
			$val = 'front-page';
		} else if(is_search()) {
			$val = 'search';
		} else {
			$val = '404';
		}
		return "(static.meta_value IS NULL OR static.meta_value = '".$val."')";

	}
	
	public function meta_box_content() {
		global $post;
		
		echo '<h4><a href="#">'.$this->name.'</a></h4>'."\n";
		echo '<div class="cas-rule-content" id="cas-' . $this->id . '">';
		$field = $this->id;
		$meta = get_post_meta($post->ID, ContentAwareSidebars::prefix . $field, false);
		$current = $meta != '' ? $meta : array();
?>
						<ul class="list:<?php echo $field; ?> categorychecklist form-no-clear">
		<?php
		foreach ($this->_get_content() as $id => $name) {
			echo '<li><label><input type="checkbox" name="' . $field . '[]" value="' . $id . '"' . (in_array($id, $current) ? ' checked="checked"' : '') . ' /> ' . $name . '</label></li>' . "\n";
		}
		?>
						</ul>
		<?php
		echo '</div>';
	}
	
}
