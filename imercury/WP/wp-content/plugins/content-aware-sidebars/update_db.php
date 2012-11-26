<?php
/**
 * @package Content Aware Sidebars
 */

/**
 *
 * Run updates
 * 
 * @param type $current_version
 * @return boolean 
 */
function cas_run_db_update($current_version) {
	
        if(current_user_can('update_plugins')) {
                
                // Get current plugin db version
                $installed_version = get_option('cas_db_version');
		
		if($installed_version === false)
                        $installed_version = 0;
                
                // Database is up to date
                if($installed_version == $current_version)
                        return true;
                        
                $versions = array(0.8,1.1);
		
		//Launch updates
		foreach($versions as $version) {
			$return = false;
			
                        if(version_compare($installed_version,$version,'<')) {                           
                                $function = 'cas_update_to_'.str_replace('.','',$version);                             
                                if(function_exists($function)) {
					
					$return = $function();
					
                                        // Update database on success
					if($return) {		
						update_option('cas_db_version',$installed_version = $version);
                                        }
                                }
                        }
		}
		
                return $return;
        }
}

/**
 * Version 0.8 -> 1.1
 * Serialized metadata gets their own rows
 * 
 * @param boolean $return
 */
function cas_update_to_11() {
	
	$moduledata = array(
		'static',
		'post_types',
		'authors',
		'page_templates',
		'taxonomies',
		'language'
	);
	
	// Get all sidebars
	$posts = get_posts(array(
		'numberposts'     => -1,
		'post_type'       => 'sidebar',
		'post_status'     => 'publish,pending,draft,future,private,trash'
	));
	
	if(!empty($posts)) {
		foreach($posts as $post) {
			foreach($moduledata as $field) {
				// Remove old serialized data and insert it again properly
				$old = get_post_meta($post->ID, ContentAwareSidebars::prefix.$field, true);
				if($old != '') {
					delete_post_meta($post->ID, ContentAwareSidebars::prefix.$field, $old);
					foreach((array)$old as $new_single) {
						add_post_meta($post->ID, ContentAwareSidebars::prefix.$field, $new_single);
					}
				}
			}
		}
	}
	
	return true;
}

/**
 *
 * Version 0 -> 0.8
 * Introduces database version management, adds preficed keys to metadata
 *
 * @global object $wpdb
 * @param boolean $return 
 */
function cas_update_to_08() {
        global $wpdb;
        
        $prefix = '_cas_';
        $metadata = array(
                'post_types',
		'taxonomies',
		'authors',
		'page_templates',
		'static',
		'exposure',
		'handle',
		'host',
		'merge-pos'
        );
        
        // Get all sidebars
        $posts = $wpdb->get_col($wpdb->prepare("
                SELECT ID 
                FROM $wpdb->posts
                WHERE post_type = %s
	",'sidebar'));
        
        //Check if there is any
        if(!empty($posts)) {
                //Update the meta keys
                foreach($metadata as $meta) {
                        $wpdb->query("
                                UPDATE $wpdb->postmeta
                                SET meta_key = '".$prefix.$meta."'
                                WHERE meta_key = '".$meta."'
                                AND post_id IN(".implode(',',$posts).")
                        ");
                }
		// Clear cache for new meta keys
		wp_cache_flush();
        }
        
        return true;
        
}     
