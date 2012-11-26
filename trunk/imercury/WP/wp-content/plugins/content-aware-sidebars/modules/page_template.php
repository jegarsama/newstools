<?php
/**
 * @package Content Aware Sidebars
 * @author Joachim Jensen <jv@intox.dk>
 */

/**
 *
 * Page Template Module
 * 
 * Detects if current content has:
 * a) any or specific page template
 *
 *
 */
class CASModule_page_template extends CASModule {
	
	public function __construct() {
		parent::__construct();
		$this->id = 'page_templates';
		$this->name = __('Page Templates','content-aware-sidebars');
	}
	
	public function is_content() {		
		if(is_singular() && !('page' == get_option( 'show_on_front') && get_option('page_on_front') == get_the_ID())) {
			$template = get_post_meta(get_the_ID(),'_wp_page_template',true);
			if($template && $template != 'default') {
				return true;
			}
		}
		return false;
	}
	
	public function db_where() {
		$template = get_post_meta(get_the_ID(),'_wp_page_template',true);
		return "(page_templates.meta_value IS NULL OR page_templates.meta_value IN('page_templates','".$template."'))";
	}

	public function _get_content() {
		return array_flip(get_page_templates());
	}
	
}
