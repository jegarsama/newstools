<?php
/**
 * @package Content Aware Sidebars
 * @author Joachim Jensen <jv@intox.dk>
 */

/**
 *
 * WPML Module
 * 
 * Detects if current content is:
 * a) in specific language
 *
 */
class CASModule_wpml extends CASModule {
	
	public function __construct() {
		parent::__construct();
		$this->id = 'language';
		$this->name = __('Languages','content-aware-sidebars');
	}
	
	public function is_content() {
		return true;
	}
	
	public function db_where() {
		return "(language.meta_value IS NULL OR language.meta_value IN('language','".ICL_LANGUAGE_CODE."'))";	
	}

	public function _get_content() {
		$langs = array();
		
		foreach(icl_get_languages('skip_missing=N') as $lng) {
			$langs[$lng['language_code']] = $lng['native_name'];	
		}
		return $langs;
	}
	
}
