<?php
/**
 * @package Content Aware Sidebars
 */

/**
 *
 * Walker for post types and taxonomies
 *
 */
class CAS_Walker_Checklist extends Walker {
	
	/**
	 * @param type $tree_type
	 * @param type $db_fields 
	 */
	function __construct($tree_type, $db_fields) {
		
		$this->tree_type = $tree_type;
		$this->db_fields = $db_fields;
		
	}
	
	/**
	 * @param type $output
	 * @param type $depth
	 * @param type $args 
	 */
	public function start_lvl(&$output, $depth, $args) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children'>\n";
	}
	
	/**
	 * @param type $output
	 * @param type $depth
	 * @param type $args 
	 */
	public function end_lvl(&$output, $depth, $args) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	
	/**
	 * @param type $output
	 * @param type $term
	 * @param type $depth
	 * @param type $args
	 * @return type 
	 */
	public function start_el(&$output, $term, $depth, $args) {
		extract($args);
		
		if(isset($post_type)) {
			
			if ( empty($post_type) ) {
				$output .= "\n<li>";
				return;
			}
			
			$output .= "\n".'<li id="'.$post_type->name.'-'.$term->ID.'"><label class="selectit"><input value="'.$term->ID.'" type="checkbox" name="post_types[]" id="in-'.$post_type->name.'-'.$term->ID.'"'.checked(in_array($term->ID,$selected_cats),true,false).disabled(empty($disabled),false,false).'/> '.esc_html( $term->post_title ).'</label>';
			
		} else {
			
			if ( empty($taxonomy) ) {
				$output .= "\n<li>";
				return;
			}
			
			$name = $taxonomy->name == 'category' ? 'post_category' : 'tax_input['.$taxonomy->name.']';                   
			$value = $taxonomy->hierarchical ? 'term_id' : 'slug';
			$class = in_array( $term->term_id, $popular_terms ) ? ' class="popular-category"' : '';
                
			$output .= "\n".'<li id="'.$taxonomy->name.'-'.$term->term_id.'"'.$class.'><label class="selectit"><input value="'.$term->$value.'" type="checkbox" name="'.$name.'[]" id="in-'.$taxonomy->name.'-'.$term->term_id.'"'.checked(in_array($term->term_id,$selected_terms),true,false).disabled(empty($disabled),false,false).'/> '.esc_html( apply_filters('the_category', $term->name )) . '</label>';
		
		}

        }

	/**
	 * @param string $output
	 * @param type $term
	 * @param type $depth
	 * @param type $args 
	 */
	public function end_el(&$output, $term, $depth, $args) {
		$output .= "</li>\n";
	}
	
}

/**
 *
 * Show terms checklist
 *
 * @param type $post_id
 * @param type $args 
 */
function cas_terms_checklist($post_id = 0, $args = array()) {
 	$defaults = array(
		'popular_terms' => false,
		'taxonomy' => 'category',
		'terms' => null,
		'checked_ontop' => true
	);
	extract(wp_parse_args($args, $defaults), EXTR_SKIP);

	$walker = new CAS_Walker_Checklist('category',array ('parent' => 'parent', 'id' => 'term_id'));

	if(!is_object($taxonomy))
		$taxonomy = get_taxonomy($taxonomy);
        
        $args = array(
		'taxonomy'	=> $taxonomy,
		'disabled'	=> !current_user_can($taxonomy->cap->assign_terms)
	);

	if ($post_id)
		$args['selected_terms'] = wp_get_object_terms($post_id, $taxonomy->name, array_merge($args, array('fields' => 'ids')));
	else
		$args['selected_terms'] = array();

	if (is_array($popular_terms))
		$args['popular_terms'] = $popular_terms;
	else
		$args['popular_terms'] = get_terms( $taxonomy->name, array( 'fields' => 'ids', 'orderby' => 'count', 'order' => 'DESC', 'number' => 10, 'hierarchical' => false ) );

	if(!$terms)
		$terms = (array) get_terms($taxonomy->name, array('get' => 'all'));

	if ($checked_ontop) {
		$checked_terms = array();
		$keys = array_keys( $terms );

		foreach($keys as $k) {
			if (in_array($terms[$k]->term_id, $args['selected_terms'])) {
				$checked_terms[] = $terms[$k];
				unset($terms[$k]);
			}
		}

		// Put checked terms on top
		echo call_user_func_array(array(&$walker, 'walk'), array($checked_terms, 0, $args));
	}
	// Then the rest of them
	echo call_user_func_array(array(&$walker, 'walk'), array($terms, 0, $args));
}

/**
 *
 * Show checklist for popular terms
 *
 * @global type $post_ID
 * @param type $taxonomy
 * @param type $default
 * @param type $number
 * @param type $echo
 * @return type 
 */
function cas_popular_terms_checklist( $taxonomy, $default = 0, $number = 10, $echo = true ) {
	global $post_ID;

	if ( $post_ID )
		$checked_terms = wp_get_object_terms($post_ID, $taxonomy->name, array('fields'=>'ids'));
	else
		$checked_terms = array();

	$terms = get_terms( $taxonomy->name, array( 'orderby' => 'count', 'order' => 'DESC', 'number' => $number, 'hierarchical' => false ) );

        $disabled = current_user_can($taxonomy->cap->assign_terms) ? '' : ' disabled="disabled"';
        
        $popular_ids = array();
	foreach ( (array) $terms as $term ) {
		$popular_ids[] = $term->term_id;
		if ( !$echo ) // hack for AJAX use
			continue;
		$id = "popular-$taxonomy->name-$term->term_id";      
               ?>

		<li id="<?php echo $id; ?>" class="popular-category">
			<label class="selectit">
			<input id="in-<?php echo $id; ?>" type="checkbox"<?php echo in_array( $term->term_id, $checked_terms ) ? ' checked="checked"' : ''; ?> value="<?php echo $term->term_id; ?>"<?php echo $disabled ?>/>
				<?php echo esc_html( apply_filters( 'the_category', $term->name ) ); ?>
			</label>
		</li>

		<?php
	}
	return $popular_ids;
}

/**
 *
 * Show posts checklist
 *
 * @param type $post_id
 * @param type $args 
 */
function cas_posts_checklist($post_id = 0, $args = array()) {
 	$defaults = array(
		'post_type' => 'post',
		'posts' => null,
		'checked_ontop' => true
	);
	extract(wp_parse_args($args, $defaults), EXTR_SKIP);

	$walker = new CAS_Walker_Checklist('post',array ('parent' => 'post_parent', 'id' => 'ID'));

	if(!is_object($post_type))
		$post_type = get_post_type_object($post_type);

        $args = array(
		'post_type'	=> $post_type,
		'disabled'	=> !current_user_can($post_type->cap->edit_post)
	);

	if($post_id)
		$args['selected_cats'] = get_post_meta($post_id, '_cas_post_types', false);
	else
		$args['selected_cats'] = array();

	if(!$posts)
		$posts = get_posts(array(
			'numberposts'	=> -1,
			'post_type'	=> $post_type->name,
			'post_status'	=> array('publish','private','future'),
		));	

	if ( $checked_ontop ) {
		$checked_posts = array();
		$keys = array_keys($posts);
	
		foreach( $keys as $k ) {
			if (in_array($posts[$k]->ID, $args['selected_cats'])) {
				$checked_posts[] = $posts[$k];
				unset($posts[$k]);
			}
		}
	
		//Put checked posts on top
		echo call_user_func_array(array(&$walker, 'walk'), array($checked_posts, 0, $args));
	}
	
	// Then the rest of them
	echo call_user_func_array(array(&$walker, 'walk'), array($posts, 0, $args));
}
