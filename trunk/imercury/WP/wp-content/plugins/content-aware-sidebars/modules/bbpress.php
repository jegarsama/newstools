<?php
/**
 * @package Content Aware Sidebars
 * @author Joachim Jensen <jv@intox.dk>
 */

/**
 *
 * bbPress Module
 * 
 * Detects if current content is:
 * a) any or specific bbpress user profile
 *
 */
class CASModule_bbpress extends CASModule {
	
	public function __construct() {
		parent::__construct();
		$this->id = 'authors';
		$this->name = __('bbPress','content-aware-sidebars');
		
		add_filter('cas-db-where-post_types', array(&$this,'add_forum_dependency'));
	}
	
	public function is_content() {
		return bbp_is_single_user();
	}
	
	public function db_where() {
		return "(authors.meta_value = 'authors' OR authors.meta_value = '".bbp_get_displayed_user_id()."')";	
	}

	public function _get_content() {
		return 0;
	}
	
	public function add_forum_dependency($where) {
		if(is_singular(array('topic','reply'))) {
			$where = "(post_types.meta_value IS NULL OR post_types.meta_value IN('".get_post_type()."','".get_the_ID()."','".bbp_get_forum_id()."','forum'))";
		}
		return $where;
	}
	
}
