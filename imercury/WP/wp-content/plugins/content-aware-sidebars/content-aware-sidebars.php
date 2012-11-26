<?php
/**
 * @package Content Aware Sidebars
 * @author Joachim Jensen <jv@intox.dk>
 */
/*
Plugin Name: Content Aware Sidebars
Plugin URI: http://www.intox.dk/
Description: Manage and show sidebars according to the content being viewed.
Version: 1.1.1
Author: Joachim Jensen
Author URI: http://www.intox.dk/
Text Domain: content-aware-sidebars
Domain Path: /lang/
License: GPL2

    Copyright 2011-2012  Joachim Jensen  (email : jv@intox.dk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

final class ContentAwareSidebars {
	
	const db_version		= 1.1;
	const prefix			= '_cas_';
	
	private $metadata		= array();
	private $taxonomies		= array();
	private $sidebar_cache		= array();
	
	private $modules		= array();

	/**
	 *
	 * Constructor
	 *
	 */
	public function __construct() {
		
		register_activation_hook(__FILE__,			array(&$this,'plugin_activation'));
		register_deactivation_hook(__FILE__,			array(&$this,'plugin_deactivation'));
		
		$this->_load_dependencies();
		
		// WordPress Hooks. Somewhat ordered by execution
		
		// On sitewide requests
		add_action('plugins_loaded',				array(&$this,'deploy_modules'));
		add_action('init',					array(&$this,'init_sidebar_type'),99);
		add_action('widgets_init',				array(&$this,'create_sidebars'));
		
		// On admin requests
		add_action('admin_menu',				array(&$this,'clear_admin_menu'));	
		add_action('admin_enqueue_scripts',			array(&$this,'load_admin_scripts'));
		
		// On post type and taxonomy requests
		add_action('delete_post',				array(&$this,'remove_sidebar_widgets'));
		add_action('save_post', 				array(&$this,'save_post'));
		
		// Order not known yet
		add_action('add_meta_boxes_sidebar',			array(&$this,'create_meta_boxes'));
		
		add_filter('default_hidden_meta_boxes',			array(&$this,'change_default_hidden'),10,2);	
		add_filter('manage_edit-sidebar_columns',		array(&$this,'admin_column_headers'));
		add_filter('manage_edit-sidebar_sortable_columns',	array(&$this,'admin_column_sortable_headers'));
		add_filter('manage_posts_custom_column',		array(&$this,'admin_column_rows'),10,3);
		add_filter('post_row_actions',				array(&$this,'sidebar_row_actions'),10,2);
		add_filter('post_updated_messages', 			array(&$this,'sidebar_updated_messages'));
		
		
		// Sitewide hooks that should not be loaded sitewide here
		if(is_admin()) {
			add_filter('request',				array(&$this,'admin_column_orderby'));
			
			add_action('wp_loaded',				array(&$this,'db_update'));	
		} else {
			add_filter('wp',				array(&$this,'replace_sidebar'));
		}
		
	}
	
	/**
	 *
	 * Deploy modules
	 *
	 */
	public function deploy_modules() {
		
		// List modules
		$modules = array(
			'static'		=> true,
			'post_type'		=> true,
			'author'		=> true,
			'page_template'		=> true,
			'taxonomy'		=> true,
			'bbpress'		=> function_exists('bbp_get_version'),	// bbPress
			'qtranslate'		=> defined('QT_SUPPORTED_WP_VERSION'),	// qTranslate
			'transposh'		=> defined('TRANSPOSH_PLUGIN_VER'),	// Transposh Translation Filter
			'wpml'			=> defined('ICL_LANGUAGE_CODE')		// WPML Multilingual Blog/CMS
		);
		
		load_plugin_textdomain('content-aware-sidebars', false, dirname( plugin_basename(__FILE__)).'/lang/');
		
		// Fire!
		foreach($modules as $name => $enabled) {
			if($enabled)
				$this->modules[$name] = $this->_forge_module($name);
		}
		
	}
	
	/**
	 *
	 * Create post meta fields
	 *
	 * @global int $post
	 * @global array $wp_registered_sidebars 
	 */
	private function _init_metadata() {
		global $post, $wp_registered_sidebars;
		
		// List of sidebars
		$sidebar_list = array();
		foreach($wp_registered_sidebars as $sidebar) {
			if(isset($post) && $sidebar['id'] != 'ca-sidebar-'.$post->ID)
				$sidebar_list[$sidebar['id']] = $sidebar['name'];
		}
		
		// Meta fields
		$this->metadata['exposure'] = array(
			'name'	=> __('Exposure', 'content-aware-sidebars'),
			'id'	=> 'exposure',
			'desc'	=> '',
			'val'	=> 1,
			'type'	=> 'select',
			'list'	=> array(
				 __('Singular', 'content-aware-sidebars'),
				 __('Singular & Archive', 'content-aware-sidebars'),
				 __('Archive', 'content-aware-sidebars')
			)
		);
		$this->metadata['handle'] = array(
			'name'	=> _x('Handle','option', 'content-aware-sidebars'),
			'id'	=> 'handle',
			'desc'	=> __('Replace host sidebar, merge with it or add sidebar manually.', 'content-aware-sidebars'),
			'val'	=> 0,
			'type'	=> 'select',
			'list'	=> array(
				__('Replace', 'content-aware-sidebars'),
				__('Merge', 'content-aware-sidebars'),
				__('Manual', 'content-aware-sidebars')
			)
		);
		$this->metadata['host']	= array(
			'name'	=> __('Host Sidebar', 'content-aware-sidebars'),
			'id'	=> 'host',
			'desc'	=> '',
			'val'	=> 'sidebar-1',
			'type'	=> 'select',
			'list'	=> $sidebar_list
		);
		$this->metadata['merge-pos'] = array(
			'name'	=> __('Merge position', 'content-aware-sidebars'),
			'id'	=> 'merge-pos',
			'desc'	=> __('Place sidebar on top or bottom of host when merging.', 'content-aware-sidebars'),
			'val'	=> 1,
			'type'	=> 'select',
			'list'	=> array(
				__('Top', 'content-aware-sidebars'),
				__('Bottom', 'content-aware-sidebars')
			)
		);
		
	}
	
	/**
	 *
	 * Custom Post Type: Sidebar
	 *
	 */
	public function init_sidebar_type() {
		
		// List public taxonomies
		foreach(get_taxonomies(array('public'=>true),'names') as $tax) {
			$this->taxonomies[] = $tax;
		}
		
		// Register the sidebar type
		register_post_type('sidebar',array(
			'labels'	=> array(
				'name'			=> __('Sidebars', 'content-aware-sidebars'),
				'singular_name'		=> __('Sidebar', 'content-aware-sidebars'),
				'add_new'		=> _x('Add New', 'sidebar', 'content-aware-sidebars'),
				'add_new_item'		=> __('Add New Sidebar', 'content-aware-sidebars'),
				'edit_item'		=> __('Edit Sidebar', 'content-aware-sidebars'),
				'new_item'		=> __('New Sidebar', 'content-aware-sidebars'),
				'all_items'		=> __('All Sidebars', 'content-aware-sidebars'),
				'view_item'		=> __('View Sidebar', 'content-aware-sidebars'),
				'search_items'		=> __('Search Sidebars', 'content-aware-sidebars'),
				'not_found'		=> __('No sidebars found', 'content-aware-sidebars'),
				'not_found_in_trash'	=> __('No sidebars found in Trash', 'content-aware-sidebars')
			),
			'show_ui'	=> true, 
			'query_var'	=> false,
			'rewrite'	=> false,
			'menu_position' => null,
			'supports'	=> array('title','page-attributes','excerpt'),
			'taxonomies'	=> $this->taxonomies,
			'menu_icon'	=> WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)).'/img/icon-16.png'
		));
	}
	
	/**
	 *
	 * Create update messages
	 *
	 * @global type $post
	 * @param array $messages
	 * @return array 
	 */
	public function sidebar_updated_messages( $messages ) {
		global $post;
		$messages['sidebar'] = array(
			0 => '',
			1 => sprintf(__('Sidebar updated. <a href="%s">Manage widgets</a>','content-aware-sidebars'),'widgets.php'),
			2 => '',
			3 => '',
			4 => __('Sidebar updated.','content-aware-sidebars'),
			5 => '',
			6 => sprintf(__('Sidebar published. <a href="%s">Manage widgets</a>','content-aware-sidebars'), 'widgets.php'),
			7 => __('Sidebar saved.','content-aware-sidebars'),
			8 => sprintf(__('Sidebar submitted. <a href="%s">Manage widgets</a>','content-aware-sidebars'),'widgets.php'),
			9 => sprintf(__('Sidebar scheduled for: <strong>%1$s</strong>. <a href="%2$s">Manage widgets</a>','content-aware-sidebars'),
			// translators: Publish box date format, see http://php.net/date
			date_i18n(__('M j, Y @ G:i'),strtotime($post->post_date)),'widgets.php'),
			10 => __('Sidebar draft updated.','content-aware-sidebars'),
		);
		return $messages;
	}

	/**
	 *
	 * Remove taxonomy shortcuts from menu and standard meta boxes.
	 *
	 */
	public function clear_admin_menu() {
		foreach($this->taxonomies as $name) {
			remove_submenu_page('edit.php?post_type=sidebar','edit-tags.php?taxonomy='.$name.'&amp;post_type=sidebar');
			remove_meta_box('tagsdiv-'.$name, 'sidebar', 'side');
			remove_meta_box($name.'div', 'sidebar', 'side');
		}
	}
	
	/**
	 *
	 * Add sidebars to widgets area
	 *
	 */
	public function create_sidebars() {

		//WP3.1 does not support (array) as post_status
		$posts = get_posts(array(
			'numberposts'	=> -1,
			'post_type'	=> 'sidebar',
			'post_status'	=> 'publish,private,future'
		));
		foreach($posts as $post) {
			register_sidebar( array(
				'name'		=> $post->post_title,
				'description'	=> $post->post_excerpt,
				'id'		=> 'ca-sidebar-'.$post->ID,
				'before_widget'	=> '<li id="%1$s" class="widget-container %2$s">',
				'after_widget'	=> '</li>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
			));
		}		
	}
	
	/**
	 *
	 * Add admin column headers
	 * 
	 * @param array $columns
	 * @return array 
	 */
	public function admin_column_headers($columns) {
		
		unset($columns['categories'],$columns['tags']);
		
		return array_merge(
			array_slice($columns, 0, 2, true),
			array(
				'exposure'	=> __('Exposure', 'content-aware-sidebars'),
				'handle'	=> _x('Handle','option', 'content-aware-sidebars'),
				'merge-pos'	=> __('Merge position', 'content-aware-sidebars')
			),
			$columns
		);
	}
		
	/**
	 *
	 * Make some columns sortable
	 *
	 * @param array $columns
	 * @return array 
	 */
	public function admin_column_sortable_headers($columns) {
		return array_merge(
			array(
				'exposure'	=> 'exposure',
				'handle'	=> 'handle',
				'merge-pos'	=> 'merge-pos'
			),
			$columns
		);
	}
	
	/**
	 *
	 * Manage custom column sorting
	 * 
	 * @param array $vars
	 * @return array 
	 */
	public function admin_column_orderby($vars) {
		if (isset($vars['orderby']) && in_array($vars['orderby'],array('exposure','handle','merge-pos'))) {
			$vars = array_merge( $vars, array(
				'meta_key'	=> self::prefix.$vars['orderby'],
				'orderby'	=> 'meta_value'
			) );
		}
		return $vars;
	}
	
	/**
	 *
	 * Add admin column rows
	 *
	 * @param string $column_name
	 * @param int $post_id
	 * @return type 
	 */
	public function admin_column_rows($column_name,$post_id) {
		
		if(get_post_type($post_id) != 'sidebar')
			return;
		
		// Load metadata
		if(!$this->metadata) $this->_init_metadata();
		
		$current = get_post_meta($post_id,self::prefix.$column_name,true);
		$current_from_list = $this->metadata[$column_name]['list'][$current];
		
		if($column_name == 'handle' && $current < 2) {		
			$host = get_post_meta($post_id,self::prefix.'host',true);			
			$current_from_list .= ": ".(isset($this->metadata['host']['list'][$host]) ? $this->metadata['host']['list'][$host] : '<span style="color:red;">'.__('Please update Host Sidebar','content-aware-sidebars').'</span>');		
		}		
		echo $current_from_list;
	}
	
	/**
	 *
	 * Remove widget when its sidebar is removed
	 *
	 * @param int $post_id
	 * @return type 
	 */
	public function remove_sidebar_widgets($post_id) {
		
		// Authenticate and only continue on sidebar post type
		if(!current_user_can('delete_posts') || get_post_type($post_id) != 'sidebar')
			return;
		
		$id = 'ca-sidebar-'.$post_id;		
		
		//Get widgets
		$sidebars_widgets = wp_get_sidebars_widgets();
		
		// Check if sidebar exists in database
		if(!isset($sidebars_widgets[$id]))
			return;
		
		// Remove widgets settings from sidebar
		foreach($sidebars_widgets[$id] as $widget_id) {
			$widget_type = preg_replace( '/-[0-9]+$/', '', $widget_id );
			$widget_settings = get_option('widget_'.$widget_type);
			$widget_id = substr($widget_id,strpos($widget_id,'-')+1);
			if($widget_settings && isset($widget_settings[$widget_id])) {
				unset($widget_settings[$widget_id]);
				update_option('widget_'.$widget_type,$widget_settings);
			}
		}
		
		// Remove sidebar
		unset($sidebars_widgets[$id]);
		wp_set_sidebars_widgets($sidebars_widgets);
		
		
	}
	
	/**
	 *
	 * Add admin rows actions
	 *
	 * @param array $actions
	 * @param object $post
	 * @return array 
	 */
	public function sidebar_row_actions($actions, $post) {
		if($post->post_type == 'sidebar' && $post->post_status != 'trash') {
			
			//View link is still there in WP3.1
			if(isset($actions['view']))
				unset($actions['view']);
				
			return array_merge(
				array_slice($actions, 0, 2, true),
				array(
				      'mng_widgets' => 	'<a href="widgets.php" title="'.esc_html(__( 'Manage Widgets','content-aware-sidebars')).'">'.__( 'Manage Widgets','content-aware-sidebars').'</a>'
				),
				$actions
			);
		}
		return $actions;
	}

	/**
	 *
	 * Replace or merge a sidebar with content aware sidebars
	 * Handles content aware sidebars with hosts
	 *
	 * @global array $_wp_sidebars_widgets
	 * @return type 
	 */
	public function replace_sidebar() {
		global $_wp_sidebars_widgets;
		
		$posts = $this->get_sidebars();
		if(!$posts)
			return;
		
		foreach($posts as $post) {
			
//			// Filter out sidebars with dependent content rules not present. Archives not yet decided.
//			if(!(is_archive() || (is_home() && !is_front_page()))) {
//				$continue = false;
//				$continue = apply_filters('cas_exclude_sidebar', $continue, $post, self::prefix);
//				if($continue)
//					continue;
//			}
//			
			$id = 'ca-sidebar-'.$post->ID;	
			$host = get_post_meta($post->ID, self::prefix.'host', true);
			
			// Check for correct handling and if host exist
			if ($post->handle == 2 || !isset($_wp_sidebars_widgets[$host]))
				continue;
			
			// Sidebar might not have any widgets. Get it anyway!
			if(!isset($_wp_sidebars_widgets[$id]))
				$_wp_sidebars_widgets[$id] = array();
			
			// If host has already been replaced, merge with it instead. Might change in future.
			if($post->handle || isset($handled_already[$host])) {
				if(get_post_meta($post->ID, self::prefix.'merge-pos', true))
					$_wp_sidebars_widgets[$host] = array_merge($_wp_sidebars_widgets[$host],$_wp_sidebars_widgets[$id]);
				else
					$_wp_sidebars_widgets[$host] = array_merge($_wp_sidebars_widgets[$id],$_wp_sidebars_widgets[$host]);
			} else {
				$_wp_sidebars_widgets[$host] = $_wp_sidebars_widgets[$id];
				$handled_already[$host] = 1;
			}		
		}
	}
	
	/**
	 *
	 * Query sidebars according to content
	 * 
	 * @global type $wpdb
	 * @return array|boolean 
	 */
	public function get_sidebars() {
		global $wpdb;
		
		if(post_password_required())
			return false;
		
		// Return cache if present
		if(!empty($this->sidebar_cache)) {
			if($this->sidebar_cache[0] == false)
				return false;
			else
				return $this->sidebar_cache;
		}
		
		$joins = array();
		$where = array();
		$where2 = array();
		
		// Get rules
		foreach($this->modules as $module) {
			if($module->is_content()) {
				$joins[] = apply_filters("cas-db-join-".$module->get_id(), $module->db_join());
				$where[] = apply_filters("cas-db-where-".$module->get_id(), $module->db_where());
				$where2[] = $module->db_where2();
			}
		}
		
		// Check if there are any rules for this type of content
		if(empty($where))
			return false;

		// Do query and cache it
		$wpdb->query('SET OPTION SQL_BIG_SELECTS = 1');
		$this->sidebar_cache = $wpdb->get_results("
			SELECT
				posts.ID,
				handle.meta_value handle
			FROM $wpdb->posts posts
			LEFT JOIN $wpdb->postmeta handle
				ON handle.post_id = posts.ID
				AND handle.meta_key = '".self::prefix."handle'
			LEFT JOIN $wpdb->postmeta exposure
				ON exposure.post_id = posts.ID
				AND exposure.meta_key = '".self::prefix."exposure'
			".implode(' ',$joins)."
			WHERE
				posts.post_type = 'sidebar' AND
				exposure.meta_value ".(is_archive() || is_home() ? '>' : '<')."= '1' AND
				posts.post_status ".(current_user_can('read_private_posts') ? "IN('publish','private')" : "= 'publish'")." AND 
				(".implode(' AND ',$where).($where2 ? ' AND ('.implode(' OR ',$where2).')' : '').")
			GROUP BY posts.ID
			ORDER BY posts.menu_order ASC, handle.meta_value DESC, posts.post_date DESC
		");
		
		// Return proper cache. If query was empty, tell the cache.
		return (empty($this->sidebar_cache) ? $this->sidebar_cache[0] = false : $this->sidebar_cache);
		
	}
	
	/**
	 *
	 * Meta boxes for sidebar edit
	 *
	 */
	public function create_meta_boxes() {
		
		// Load metadata
		$this->_init_metadata();

		// Add boxes
		// Author Words
		add_meta_box(
			'cas-dev-words',
			__('Words from the author', 'content-aware-sidebars'),
			array(&$this,'meta_box_author_words'),
			'sidebar',
			'side',
			'high'
		);
		
		// Module rules
		add_meta_box(
			'cas-rules',
			__('Content', 'content-aware-sidebars'),
			array(&$this,'meta_box_rules'),
			'sidebar',
			'normal',
			'high'
		);
			
		// Options
		add_meta_box(
			'cas-options',
			__('Options', 'content-aware-sidebars'),
			array(&$this,'meta_box_options'),
			'sidebar',
			'side'
		);
	}
	
		
	/**
	 *
	 * Hide some meta boxes from start
	 *
	 * @global type $wp_version
	 * @param array $hidden
	 * @param object $screen
	 * @return array 
	 */
	public function change_default_hidden( $hidden, $screen ) {
		global $wp_version;
		
		//WordPress 3.3 has changed get_hidden_meta_boxes().
		if($wp_version < 3.3) {
			$condition = $screen->base == 'sidebar';
		} else {
			$condition = $screen->post_type == 'sidebar';
		}
		
		if ($condition && get_user_option( 'metaboxhidden_sidebar' ) === false) {
		
			$hidden_meta_boxes = array('postexcerpt','pageparentdiv');
			$hidden = array_merge($hidden,$hidden_meta_boxes);
		
			$user = wp_get_current_user();
			update_user_option( $user->ID, 'metaboxhidden_sidebar', $hidden, true );
		
		}
		return $hidden;
	}
	
	public function meta_box_rules() {
		echo '<div id="cas-accordion">'."\n";
		foreach($this->modules as $module) {
			$module->meta_box_content();
		}
		echo '</div>'."\n";
	}
	
	/**
	 *
	 * Options content
	 *
	 */
	public function meta_box_options() {
		
		$columns = array(
			'exposure',
			'handle' => 'handle,host',
			'merge-pos'
		);
		
		foreach($columns as $key => $value) {
			
			echo '<span>'.$this->metadata[is_numeric($key) ? $value : $key]['name'].':';
			echo '<p>';
			$values = explode(',',$value);
			foreach($values as $val) {
				$this->_form_field($val);
			}
			echo '</p></span>';
		}
	}
	
	/**
	 *
	 * Author words content
	 *
	 */
	public function meta_box_author_words() {
		
		// Use nonce for verification
		wp_nonce_field(basename(__FILE__),'_ca-sidebar-nonce');
		?>
		<div style="overflow:hidden;">	
		<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=KPZHE6A72LEN4&lc=US&item_name=WordPress%20Plugin%3a%20Content%20Aware%20Sidebars&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted"
		   target="_blank" title="PayPal - The safer, easier way to pay online!">
			<img align="right" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" width="147" height="47" alt="PayPal - The safer, easier way to pay online!">	
		</a></p>
		<p><?php _e('If you love this plugin, please consider donating.', 'content-aware-sidebars'); ?></p>
		<br />
		<p><?php printf(__('Remember to <a class="button" href="%1$s" target="_blank">rate</a> and <a class="button" href="%2$s" target="_blank">share</a> it too!', 'content-aware-sidebars'),
			'http://wordpress.org/extend/plugins/content-aware-sidebars/',
			'http://twitter.com/?status='.__('Check out Content Aware Sidebars for %23WordPress! :)','content-aware-sidebars').' http://tiny.cc/ca-sidebars'
			); ?></p>
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://wordpress.org/extend/plugins/content-aware-sidebars/" data-text="<?php _e('Check out Content Aware Sidebars :)','content-aware-sidebars') ?>" data-hashtags="WordPress">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwordpress.org%2Fextend%2Fplugins%2Fcontent-aware-sidebars%2F&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21&amp;appId=200775686659011" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe>	
		</div>
		<?php
	}
	
	/**
	 *
	 * Create form field for metadata
	 *
	 * @global object $post
	 * @param array $setting 
	 */
	private function _form_field($setting) {
		global $post;
		
		$meta = get_post_meta($post->ID, self::prefix.$setting, true);
		$setting = $this->metadata[$setting];
		$current = $meta != '' ? $meta : $setting['val'];
		switch($setting['type']) {
			case 'select' :			
				echo '<select style="width:250px;" name="'.$setting['id'].'">'."\n";
				foreach($setting['list'] as $key => $value) {
					echo '<option value="'.$key.'"'.($key == $current ? ' selected="selected"' : '').'>'.$value.'</option>'."\n";
				}
				echo '</select>'."\n";
				break;
			case 'checkbox' :
				echo '<ul>'."\n";
				foreach($setting['list'] as $key => $value) {
					echo '<li><label><input type="checkbox" name="'.$setting['id'].'[]" value="'.$key.'"'.(in_array($key,$current) ? ' checked="checked"' : '').' /> '.$value.'</label></li>'."\n";
				}
				echo '</ul>'."\n";
				break;
			case 'text' :
			default :
				echo '<input style="width:200px;" type="text" name="'.$setting['id'].'" value="'.$current.'" />'."\n";
				break;
		}
	}
	
	/**
	 *
	 * Save meta values for post
	 *
	 * @global type $wpdb
	 * @param int $post_id
	 * @return type 
	 */
	public function save_post($post_id) {
		global $wpdb;
		
		// Save button pressed
		if(!isset($_POST['original_publish']) && !isset($_POST['save_post']))
			return;
		
		// Only sidebar type
		if(get_post_type($post_id) != 'sidebar')
			return;	
		
		// Verify nonce
		if (!check_admin_referer(basename(__FILE__),'_ca-sidebar-nonce'))
			return;
		
		// Check permissions
		if (!current_user_can('edit_post', $post_id))
			return;
		
		// Check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return;
		
		// Load metadata
		$this->_init_metadata();
		
		// Update metadata
		foreach ($this->metadata as $field) {			
			$new = isset($_POST[$field['id']]) ? $_POST[$field['id']] : '';
			$old = get_post_meta($post_id, self::prefix.$field['id'], true);
			
			if ($new != '' && $new != $old) {			
				update_post_meta($post_id, self::prefix.$field['id'], $new);
			} elseif ($new == '' && $old != '') {
				delete_post_meta($post_id, self::prefix.$field['id'], $old);
			}
		}
		// Update module data
		foreach ($this->modules as $module) {
			$new = isset($_POST[$module->get_id()]) ? $_POST[$module->get_id()] : ''; 
			$old = array_flip(get_post_meta($post_id, self::prefix.$module->get_id(), false));
			
			if(is_array($new)) {
				// Skip existing data or insert new data
				foreach($new as $new_single) {
					if(isset($old[$new_single])) {
						unset($old[$new_single]);
					} else {
						add_post_meta($post_id, self::prefix.$module->get_id(), $new_single);
					}
				}
				// Remove existing data that have not been skipped
				foreach($old as $old_key => $old_value) {
					delete_post_meta($post_id, self::prefix.$module->get_id(), $old_key);
				}
			} elseif(!empty($old)) {
				// Remove any old values when $new is empty
				delete_post_meta($post_id, self::prefix.$module->get_id());
			}
		}
	}
	
	/**
	 *
	 * Database data update module
	 *
	 */
	public function db_update() {
		cas_run_db_update(self::db_version);
	}
	
	/**
	 *
	 * Load scripts and styles for administration
	 *
	 * @global string $pagenow 
	 */
	public function load_admin_scripts($hook) {
		global $wp_version;
		
		wp_register_script('cas_admin_script', WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)).'/js/cas_admin.js', array('jquery'), '0.1', true);
		wp_register_style('cas_admin_style', WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)).'/css/style.css', array(), '0.1');
		
		if($hook == 'post.php' || $hook == 'post-new.php') {
			// WordPress < 3.3 does not have jQuery UI accordion
			if($wp_version < 3.3) {
				//die(var_dump($wp_version < 3.3));
				wp_register_script('cas-jquery-ui-accordion', WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)).'/js/jquery.ui.accordion.js', array('jquery-ui-core','jquery-ui-widget'), '1.8.9', true);
				wp_enqueue_script('cas-jquery-ui-accordion');
			} else {
				wp_enqueue_script('jquery-ui-accordion');
			}
			wp_enqueue_script('cas_admin_script');
			
			wp_enqueue_style('cas_admin_style');
		} else if($hook == 'edit.php') {
			wp_enqueue_style('cas_admin_style');
		}
		
	}
	
	/**
	 *
	 * Load dependencies
	 *
	 */
	private function _load_dependencies() {
		
		require_once('walker.php');
		require_once('update_db.php');
		require_once('modules/abstract.php');
		
	}
	
	/**
	 *
	 * Forge content module
	 *
	 * @param type $module
	 * @return object 
	 */
	private function _forge_module($module) {
		if (include_once('modules/'.$module .'.php')) {
			$class = 'CASModule_'.$module;
			return new $class;
		}
		return false;
	}
	
	/**
	 *
	 * Flush rewrite rules on plugin activation
	 *
	 */
	public function plugin_activation() {
		$this->init_sidebar_type();
		flush_rewrite_rules();
	}
	
	/**
	 *
	 * Flush rewrite rules on plugin deactivation
	 *
	 */
	public function plugin_deactivation() {
		flush_rewrite_rules();
	}
	
}

// Launch plugin
global $ca_sidebars;
$ca_sidebars = new ContentAwareSidebars();

/**
 *
 * Template function
 * 
 * @global ContentAwareSidebars $ca_sidebars
 * @global array $_wp_sidebars_widgets
 * @param array|string $args
 * @return type 
 */
function display_ca_sidebar($args = array()) {
	global $ca_sidebars, $_wp_sidebars_widgets;
	
	// Grab args or defaults
	$defaults = array (
		'include'	=> '',
 		'before'	=> '<div id="sidebar" class="widget-area"><ul class="xoxo">',
		'after'		=> '</ul></div>'
	);
	$args = wp_parse_args($args,$defaults);
	extract($args,EXTR_SKIP);
	
	// Get sidebars
	$posts = $ca_sidebars->get_sidebars();
	if(!$posts)
		return;
	
	// Handle include argument
	if(!empty($include)) {
		if(!is_array($include))
			$include = explode(',',$include);
		// Fast lookup
		$include = array_flip($include);
	}
	
	$i = $host = 0;	
	foreach($posts as $post) {

		$id = 'ca-sidebar-'.$post->ID;
			
		// Check for manual handling, if sidebar exists and if id should be included
		if ($post->handle != 2 || !isset($_wp_sidebars_widgets[$id]) || (!empty($include) && !isset($include[$post->ID])))
			continue;
		
		// Merge if more than one. First one is host.
		if($i > 0) {
			if(get_post_meta($post->ID, ContentAwareSidebars::prefix.'merge-pos', true))
				$_wp_sidebars_widgets[$host] = array_merge($_wp_sidebars_widgets[$host],$_wp_sidebars_widgets[$id]);
			else
				$_wp_sidebars_widgets[$host] = array_merge($_wp_sidebars_widgets[$id],$_wp_sidebars_widgets[$host]);
		} else {
			$host = $id;
		}
		$i++;
	}
	
	if ($host) {
		echo $before;
		dynamic_sidebar($host);
		echo $after;
	}
}
