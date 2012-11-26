<?php
/**
 * @package Content Aware Sidebars
 */

if(!defined('WP_UNINSTALL_PLUGIN')) {
	exit();
}

// Remove db version
delete_option('cas_db_version');

// Remove all sidebars
$posts = get_posts(array(
	'numberposts'	=> -1,
	'post_type'	=> 'sidebar',
	'post_status'	=> 'any'
));
foreach($posts as $post) {
	wp_delete_post($post->ID, true);
}

// Remove user meta
global $wpdb;
$wpdb->query("DELETE FROM $wpdb->usermeta WHERE meta_key IN('metaboxhidden_sidebar','closedpostboxes_sidebar')");

