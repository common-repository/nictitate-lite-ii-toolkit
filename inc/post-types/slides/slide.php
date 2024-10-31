<?php

if ( !class_exists( 'Nictitate_Toolkit_II_Slides' ) ) {
	
	class Nictitate_Toolkit_II_Slides {

		public function __construct() {				
			add_action( 'init', array( $this, 'init' ), 0 );			
			add_action( 'admin_init', array( $this, 'register_metabox' ) );			
			add_filter( 'manage_slide_posts_columns', array( $this, 'manage_colums' ) );			
			add_action( 'manage_slide_posts_custom_column' , array( $this, 'manage_colum' ) );
		}

		public function init() {

			$labels = array(
				'name'               => esc_html__( 'Slides', 'nictitate-lite-ii-toolkit' ),
				'singular_name'      => esc_html__( 'Slide', 'nictitate-lite-ii-toolkit' ),
				'menu_name'          => esc_html__( 'Slides', 'nictitate-lite-ii-toolkit' ),
				'name_admin_bar'     => esc_html__( 'Slide', 'nictitate-lite-ii-toolkit' ),
				'add_new'            => esc_html__( 'Add New', 'nictitate-lite-ii-toolkit' ),
				'add_new_item'       => esc_html__( 'Add New Slide', 'nictitate-lite-ii-toolkit' ),
				'new_item'           => esc_html__( 'New Slide', 'nictitate-lite-ii-toolkit' ),
				'edit_item'          => esc_html__( 'Edit Slide', 'nictitate-lite-ii-toolkit' ),
				'view_item'          => esc_html__( 'View Slide', 'nictitate-lite-ii-toolkit' ),
				'all_items'          => esc_html__( 'All Slides', 'nictitate-lite-ii-toolkit' ),
				'search_items'       => esc_html__( 'Search Slides', 'nictitate-lite-ii-toolkit' ),
				'parent_item_colon'  => esc_html__( 'Parent Slides:', 'nictitate-lite-ii-toolkit' ),
				'not_found'          => esc_html__( 'No slides found.', 'nictitate-lite-ii-toolkit' ),
				'not_found_in_trash' => esc_html__( 'No slides found in Trash.', 'nictitate-lite-ii-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-slides',
				'public'             => true,	      
				'labels'             => $labels,
				'supports'           => array( 'title', 'thumbnail', 'editor' ),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'slide' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 100
		    );

		    register_post_type( 'slide', $args );

		    $labels = array(
				'name'              => esc_html__( 'Slide Tags', 'nictitate-lite-ii-toolkit' ),
				'singular_name'     => esc_html__( 'Tag', 'nictitate-lite-ii-toolkit' ),
				'search_items'      => esc_html__( 'Search Tags', 'nictitate-lite-ii-toolkit' ),
				'all_items'         => esc_html__( 'All Tags', 'nictitate-lite-ii-toolkit' ),
				'parent_item'       => esc_html__( 'Parent Tag', 'nictitate-lite-ii-toolkit' ),
				'parent_item_colon' => esc_html__( 'Parent Tag:', 'nictitate-lite-ii-toolkit' ),
				'edit_item'         => esc_html__( 'Edit Tag', 'nictitate-lite-ii-toolkit' ),
				'update_item'       => esc_html__( 'Update Tag', 'nictitate-lite-ii-toolkit' ),
				'add_new_item'      => esc_html__( 'Add New Tag', 'nictitate-lite-ii-toolkit' ),
				'new_item_name'     => esc_html__( 'New Tag Name', 'nictitate-lite-ii-toolkit' ),
				'menu_name'         => esc_html__( 'Tag', 'nictitate-lite-ii-toolkit' )
			);

			$args = array(
				'hierarchical'      => false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_in_nav_menus' => false,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'slide-tag' )
			);

			register_taxonomy( 'slide-tag', array( 'slide' ), $args );
		}

		public function register_metabox() {

			$args = array(
				'id'          => 'nictitate-lite-ii-toolkit-slide-custom-metabox',
			    'title'       => esc_html__( 'Slide Extra', 'nictitate-lite-ii-toolkit' ),
			    'desc'        => '',
			    'pages'       => array( 'slide' ),
			    'context'     => 'normal',
			    'priority'    => 'high',
			    'fields'      => array(
			    	array(
						'title'   => esc_html__( 'Button Text', 'nictitate-lite-ii-toolkit' ),
						'type'    => 'text',
						'default' => '',
						'id'      => 'slider_button_text'
					),
					array(
						'title'   => esc_html__( 'Button URL', 'nictitate-lite-ii-toolkit' ),
						'type'    => 'url',
						'default' => '',
						'id'      => 'slider_button_url'
					),

			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums( $columns ) {			
			$columns = array(
				'cb'                              => esc_html__( '<input type="checkbox" />', 'nictitate-lite-ii-toolkit' ),
				'nictitate-lite-ii-toolkit-thumb' => esc_html__( 'Slide', 'nictitate-lite-ii-toolkit' ),
				'title'                           => esc_html__( 'Title', 'nictitate-lite-ii-toolkit' ),
				'taxonomy-slide-tag'              => esc_html__( 'Tags', 'nictitate-lite-ii-toolkit' )
				
			);

			return $columns;	
		}

		public function manage_colum( $column ) {
			global $post;
			switch ( $column ) {
				case 'nictitate-lite-ii-toolkit-thumb':
					if ( has_post_thumbnail( $post->ID ) ) {
						printf('<img src="%s" width="40px" height="40px">', divine_post_bfi_thumb($post->ID, '', 40, 40, true));
					}					
					break;
								
			}
		}

		public function require_widgets() {
			require_once NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/slides/widgets/slider-carousel.php';
			require_once NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/slides/widgets/slider-carousel-full.php';
		}
	}

	$Nictitate_Toolkit_II_Slides = new Nictitate_Toolkit_II_Slides();
	$Nictitate_Toolkit_II_Slides->require_widgets();
}