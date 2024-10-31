<?php
if(class_exists('Kopa_Framework')){

	add_action('init',  'nictitate_toolkit_ii_register_post_type_pricings');			
	add_action('admin_init', 'nictitate_toolkit_ii_register_metabox_pricings');
	add_filter( 'manage_pricing_table_posts_columns', 'nictitate_toolkit_ii_manage_colums_pricings' );
	add_action( 'manage_pricing_table_posts_custom_column' ,'nictitate_toolkit_ii_manage_colum_pricings' );
	


	function nictitate_toolkit_ii_register_post_type_pricings(){

		$labels = array(
			'name'               => _x('Pricings', 'post type general name', 'nictitate-lite-ii-toolkit'),
			'singular_name'      => _x('Pricing', 'post type singular name', 'nictitate-lite-ii-toolkit'),
			'menu_name'          => _x('Pricings', 'admin menu', 'nictitate-lite-ii-toolkit'),
			'name_admin_bar'     => _x('Pricing', 'add new on admin bar', 'nictitate-lite-ii-toolkit'),
			'add_new'            => _x('Add New', 'pricing_table', 'nictitate-lite-ii-toolkit'),
			'add_new_item'       => esc_html__('Add New Pricing', 'nictitate-lite-ii-toolkit'),
			'new_item'           => esc_html__('New Pricing', 'nictitate-lite-ii-toolkit'),
			'edit_item'          => esc_html__('Edit Pricing', 'nictitate-lite-ii-toolkit'),
			'view_item'          => esc_html__('View Pricing', 'nictitate-lite-ii-toolkit'),
			'all_items'          => esc_html__('All Pricings', 'nictitate-lite-ii-toolkit'),
			'search_items'       => esc_html__('Search Pricings', 'nictitate-lite-ii-toolkit'),
			'parent_item_colon'  => esc_html__('Parent Pricings:', 'nictitate-lite-ii-toolkit'),
			'not_found'          => esc_html__('No pricing_tables found.', 'nictitate-lite-ii-toolkit'),
			'not_found_in_trash' => esc_html__('No pricing_tables found in Trash.', 'nictitate-lite-ii-toolkit')
		);

		$args = array(
			'menu_icon'          => 'dashicons-chart-line',
			'public'             => true,	      
			'labels'             => $labels,
			'supports'           => array('title', 'thumbnail'),
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'pricing_table' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 100
	  );

	  register_post_type('pricing_table', $args);

		$labels = array(
			'name'              => _x('Pricing Tags', 'taxonomy general name', 'nictitate-lite-ii-toolkit'),
			'singular_name'     => _x('Tag', 'taxonomy singular name', 'nictitate-lite-ii-toolkit'),
			'search_items'      => esc_html__('Search Tags', 'nictitate-lite-ii-toolkit'),
			'all_items'         => esc_html__('All Tags', 'nictitate-lite-ii-toolkit'),
			'parent_item'       => esc_html__('Parent Tag', 'nictitate-lite-ii-toolkit'),
			'parent_item_colon' => esc_html__('Parent Tag:', 'nictitate-lite-ii-toolkit'),
			'edit_item'         => esc_html__('Edit Tag', 'nictitate-lite-ii-toolkit'),
			'update_item'       => esc_html__('Update Tag', 'nictitate-lite-ii-toolkit'),
			'add_new_item'      => esc_html__('Add New Tag', 'nictitate-lite-ii-toolkit'),
			'new_item_name'     => esc_html__('New Tag Name', 'nictitate-lite-ii-toolkit'),
			'menu_name'         => esc_html__('Tag', 'nictitate-lite-ii-toolkit'),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_in_nav_menus' => false,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'pricing_table-tag'),
		);

		register_taxonomy('pricing_table-tag', array('pricing_table'), $args);		    
	}
	
	function nictitate_toolkit_ii_register_metabox_pricings(){
		$args = array(
			'id'          => 'nictitate_toolkit_ii-pricing_table-price-metabox',
		    'title'       => esc_html__('Price', 'nictitate-lite-ii-toolkit'),
		    'desc'        => '',
		    'pages'       => array( 'pricing_table' ),
		    'context'     => 'normal',
		    'priority'    => 'low',
		    'fields'      => array(
		    					
					array(
						'title'   => esc_html__('Price', 'nictitate-lite-ii-toolkit'),
						'type'    => 'text',
						'id'      => 'nictitate_toolkit_ii_price',						
					),
					array(
						'title'   => esc_html__('Currency', 'nictitate-lite-ii-toolkit'),
						'type'    => 'text',
						'id'      => 'nictitate_toolkit_ii_currency',						
					),
					array(
						'title'   => esc_html__('Suffix', 'nictitate-lite-ii-toolkit'),
						'type'    => 'text',
						'id'      => 'nictitate_toolkit_ii_suffix',						
					),

		    )
		);			
		
		kopa_register_metabox( $args );

		$args = array(
			'id'       => 'pricing_table-features-metabox',
			'title'    => esc_html__('Features', 'nictitate-lite-ii-toolkit'),
			'desc'     => '',
			'pages'    => array( 'pricing_table' ),
			'context'  => 'normal',
			'priority' => 'low',
			'fields'   => array()
		);

		$limit = (int)apply_filters('nictitate_toolkit_ii_get_number_of_features_pricing', 10);
		
		for($i=1; $i<= $limit; $i++){
			$args['fields'][$i] = array(
				'title'   => "#{$i}",
				'type'    => 'text',
				'id'      => "nictitate_toolkit_ii_feature_{$i}"
			);
		}

		kopa_register_metabox( $args );			

		$args = array(
			'id'          => 'pricing_table-button-metabox',
		    'title'       => esc_html__('Button', 'nictitate-lite-ii-toolkit'),
		    'desc'        => '',
		    'pages'       => array( 'pricing_table' ),
		    'context'     => 'normal',
		    'priority'    => 'low',
		    'fields'      => array(				
					array(
						'title'   => esc_html__('Label', 'nictitate-lite-ii-toolkit'),
						'type'    => 'text',
						'id'      => 'nictitate_toolkit_ii_button_label',						
					),
					array(
						'title'   => esc_html__('URL', 'nictitate-lite-ii-toolkit'),
						'type'    => 'text',
						'id'      => 'nictitate_toolkit_ii_button_url',						
					)					
		    )
		);			
		
		kopa_register_metabox( $args );	

		$args = array(
			'id'          => 'pricing_table-style-metabox',
		    'title'       => esc_html__('Style', 'nictitate-lite-ii-toolkit'),
		    'desc'        => '',
		    'pages'       => array( 'pricing_table' ),
		    'context'     => 'normal',
		    'priority'    => 'low',
		    'fields'      => array(				
					array(
						'title'   => esc_html__('Style', 'nictitate-lite-ii-toolkit'),
						'type'    => 'select',
						'id'      => 'nictitate_toolkit_ii_style',
						'default' => '1',						
						'options' => apply_filters('nictitate_toolkit_ii_style', array('1' => esc_html__('Style 1', 'nictitate-lite-ii-toolkit'), '2' => esc_html__('Style 2', 'nictitate-lite-ii-toolkit'))) 
					),				
		    )
		);
		kopa_register_metabox( $args );	

		$args = array(
			'id'          => 'pricing_table-sticky-metabox',
		    'title'       => esc_html__('Sticky item', 'nictitate-lite-ii-toolkit'),
		    'desc'        => '',
		    'pages'       => array( 'pricing_table' ),
		    'context'     => 'normal',
		    'priority'    => 'low',
		    'fields'      => array(				
					array(
						
						'type'    => 'checkbox',
						'id'      => 'nictitate_toolkit_ii_sticky',
						'default' => 0,						
						'label'   => esc_html__('Is Sticky', 'nictitate-lite-ii-toolkit')
						
					),				
		    )
		);
		kopa_register_metabox( $args );	
	}

	
    function nictitate_toolkit_ii_manage_colums_pricings( $columns ) {
        $columns = array(
			'cb'                                     => esc_html__( '<input type="checkbox" />', 'nictitate-lite-ii-toolkit' ),
			'title'                                  => esc_html__( 'Title', 'nictitate-lite-ii-toolkit' ),
			'nictitate-toolkit-ii-pricing-shortcode' => esc_html__( 'Shortcode', 'nictitate-lite-ii-toolkit' ),
        );

        return $columns;
    }

	
	function nictitate_toolkit_ii_manage_colum_pricings( $column ) {
		global $post;
		switch ( $column ) {
			case 'nictitate-toolkit-ii-pricing-shortcode':
				
				echo '[pricing_table id="'.$post->ID.'"]';
				break;
			
		}
	}
}


add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_pricings');


function nictitate_toolkit_ii_register_elements_pricings($groups){
	$groups['pricing-table'][] = array(
		'name' => esc_html__('Pricing table','nictitate-lite-ii-toolkit'),
		'code' => '[pricing_table id=""][/pricing_table]'
		);
	
	return $groups;
}

add_shortcode('pricing_table', 'nictitate_toolkit_ii_shortcode_pricingtable');


function nictitate_toolkit_ii_shortcode_pricingtable($atts, $content = null){
	extract(shortcode_atts(array('style'=> 1), $atts));
	ob_start();
	

    $pricing_table_id = isset( $atts['id'] ) ? (int)$atts['id'] : 0;


    $pricing_table = get_post($pricing_table_id);
    if($pricing_table && ! is_wp_error( $pricing_table )){
    	$post_id = $pricing_table->ID;
    	$title = $pricing_table->post_title;
    	
    	$price        = get_post_meta($post_id, 'nictitate_toolkit_ii_price', true);
		$currency     = get_post_meta($post_id, 'nictitate_toolkit_ii_currency', true);
		$suffix       = get_post_meta($post_id, 'nictitate_toolkit_ii_suffix', true);

		$style_id       = intval(get_post_meta($post_id, 'nictitate_toolkit_ii_style', true));
		

		$button_label = get_post_meta($post_id, 'nictitate_toolkit_ii_button_label', true);
		$button_url   = get_post_meta($post_id, 'nictitate_toolkit_ii_button_url', true);

		$is_sticky = get_post_meta($post_id, 'nictitate_toolkit_ii_sticky', true);
		$classes = array('k-pricing-table');
		if($is_sticky){
			$classes[] = 'popular';
		}

		switch($style_id){
			case 2:
				$classes[] = 'style-2';
				break;
			default:
				$classes[] = 'style-1';
				break;
		}
    ?>
    <ul class="<?php echo implode(' ', $classes); ?>">
    	<?php if($title){
    		?>
    		<li class="title"><?php echo wp_kses_post($title ); ?></li>
    		<?php
    	} ?>
    	<?php if(isset($suffix) && 2 === $style_id){
    		?>
    		<li class="time-unit"><?php echo esc_html($suffix); ?></li>
    		<?php
    	} ?>
    	<?php if(isset($price)){
    		?>
    		<li class="price"><span><?php echo esc_html($currency); ?></span><?php echo esc_html($price); ?></li>
    		<?php
    	} ?>
    	<?php if(isset($suffix) && 1 === $style_id){
    		?>
    		<li class="time-unit"><?php echo esc_html($suffix); ?></li>
    		<?php
    	} ?>
    	<?php
    	$limit = (int)apply_filters('nictitate_toolkit_ii_get_number_of_features_pricing', 10);
    	for($i = 0; $i< $limit; $i++){
			$val = get_post_meta($post_id, "nictitate_toolkit_ii_feature_{$i}", true);
			if($i % 2 == 0){
				$li_class = 'bullet-item even';
			}else{
				$li_class = 'bullet-item';
			}
			if($val){
				echo sprintf('<li class="%s">%s</li>',$li_class, wp_kses( $val, nictitate_lite_ii_toolkit_get_allowed_tags()) );
			}
		}
    	?>
    	<?php if(isset($button_label)){		
            ?>
            <li class="cta-button">
	            <a href="<?php echo esc_url($button_url); ?>" class="button" target="_blank" ><?php echo esc_html($button_label); ?></a>
	        </li>
            <?php
		} ?>
    </ul>
    <?php
    }

    $html = ob_get_contents();
    ob_end_clean();

    return apply_filters('nictitate_toolkit_ii_shortcode_pricingtable', $html, $atts, $content);
}


	

	

