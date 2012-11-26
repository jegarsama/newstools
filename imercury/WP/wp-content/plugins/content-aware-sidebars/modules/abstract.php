<?php
/**
 * @package Content Aware Sidebars
 * @author Joachim Jensen <jv@intox.dk>
 */

/**
 *
 * All modules should extend this one.
 *
 */
abstract class CASModule {
	
	protected $id;
	protected $name;
	
	/**
	 *
	 * Constructor
	 *
	 */
	public function __construct() {
		$this->id = substr(get_class($this),strpos(get_class($this),'_')+1);
	}
	
	public function meta_box_content() {
		global $post;
		
		if(!$this->_get_content())
			return;
		
		echo '<h4><a href="#">'.$this->name.'</a></h4>'."\n";
		echo '<div class="cas-rule-content" id="cas-'.$this->id.'">';
		$field = $this->id;
		$meta = get_post_meta($post->ID, ContentAwareSidebars::prefix.$field, false);
		$current = $meta != '' ? $meta : array();
		?>
		<p>
			<label><input type="checkbox" name="<?php echo $field; ?>[]" value="<?php echo $field; ?>" <?php checked(in_array($field, $current), true, true); ?> /> <?php printf(__('Show with All %s','content-aware-sidebars'),$this->name); ?></label>
		</p>
		<div id="list-<?php echo $field; ?>" class="categorydiv" style="min-height:100%;">
			<ul id="<?php echo $field; ?>-tabs" class="category-tabs">
				<li class="tabs"><a href="#<?php echo $field; ?>-all" tabindex="3"><?php _e('View All'); ?></a></li>
			</ul>		
			<div id="<?php echo $field; ?>-all" class="tabs-panel"  style="min-height:100%;">
				<ul id="authorlistchecklist" class="list:<?php echo $field; ?> categorychecklist form-no-clear">
					<?php
					foreach($this->_get_content() as $id => $name) {
						echo '<li><label><input type="checkbox" name="'.$field.'[]" value="'.$id.'"'.checked(in_array($id,$current), true, false).' /> '.$name.'</label></li>'."\n";
					}
					?>
				</ul>
			</div>
		</div>
<?php	
		echo '</div>';
	}
	
	public function db_join() {
		global $wpdb;
		return "LEFT JOIN $wpdb->postmeta {$this->id} ON {$this->id}.post_id = posts.ID AND {$this->id}.meta_key = '".ContentAwareSidebars::prefix.$this->id."' ";
	}
	
	public function exclude_sidebar($continue, $post, $prefix) {
		if(!$continue) {
			//print_r($this->id."<br />");
			if (get_post_meta($post->ID, $prefix.$this->id, true) != '') {
				//print_r($this->id." has<br />");
				$continue = true;
			}
		}
		return $continue;
		
	}
	
	public function db_where2() {
		return "{$this->id}.meta_value IS NOT NULL";
	}
	
	public function get_id() {
		return $this->id;
	}
	
	abstract protected function _get_content();
	abstract public function is_content();
	abstract public function db_where();
	
}
