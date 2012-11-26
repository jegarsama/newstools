<?php
/**
 * @package Content Aware Sidebars
 * @author Joachim Jensen <jv@intox.dk>
 */

/**
 *
 * Transposh Module
 * 
 * Detects if current content is:
 * a) in specific language
 *
 */
class CASModule_transposh extends CASModule {
	
	public function __construct() {
		parent::__construct();
		$this->id = 'language';
		$this->name = __('Languages','content-aware-sidebars');
	}
	
	public function is_content() {
		return true;
	}
	
	public function db_where() {
		global $my_transposh_plugin;
		return "(language.meta_value IS NULL OR language.meta_value IN('language','".$my_transposh_plugin->tgl."'))";
		
	}

	public function _get_content() {
		global $my_transposh_plugin;
		$langs = array();
		foreach(explode(',',$my_transposh_plugin->options->get_viewable_langs()) as $lng) {
			$langs[$lng] = transposh_consts::get_language_orig_name($lng);
		}
		return $langs;
	}
	
}
