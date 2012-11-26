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
class CASModule_qtranslate extends CASModule {
	
	public function __construct() {
		parent::__construct();
		$this->id = 'language';
		$this->name = __('Languages','content-aware-sidebars');
		
		add_filter('manage_edit-sidebar_columns',		array(&$this,'admin_column_headers'));
		
	}
	
	public function is_content() {
		return true;
	}
	
	public function db_where() {
		return "(language.meta_value IS NULL OR language.meta_value IN('language','".qtrans_getLanguage()."'))";
	}
	
	public function admin_column_headers($columns) {	
		unset($columns['language']);	
		return $columns;
	}

	public function _get_content() {
		global $q_config;
		$langs = array();
			
		foreach(get_option('qtranslate_enabled_languages') as $lng) {
			$langs[$lng] = $q_config['language_name'][$lng];
		}
		return $langs;
	}
	
}
