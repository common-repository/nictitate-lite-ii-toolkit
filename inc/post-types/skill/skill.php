<?php

if ( ! class_exists( 'Nictitate_Toolkit_II_Skill' ) ) {

	class Nictitate_Toolkit_II_Skill {

		public function __construct() {				
			add_action( 'init', array( $this, 'init' ), 0 );			
			add_action( 'admin_init', array( $this, 'register_metabox' ) );			
			add_filter( 'manage_slide_posts_columns', array( $this, 'manage_colums' ) );			
			add_action( 'manage_slide_posts_custom_column' , array( $this, 'manage_colum' ) );
		}

		public function init() {

			$labels = array(
				'name'               => esc_html__( 'Skills', 'nictitate-lite-ii-toolkit' ),
				'singular_name'      => esc_html__( 'Skill', 'nictitate-lite-ii-toolkit' ),
				'menu_name'          => esc_html__( 'Skills', 'nictitate-lite-ii-toolkit' ),
				'name_admin_bar'     => esc_html__( 'Skill', 'nictitate-lite-ii-toolkit' ),
				'add_new'            => esc_html__( 'Add New', 'nictitate-lite-ii-toolkit' ),
				'add_new_item'       => esc_html__( 'Add New Skill', 'nictitate-lite-ii-toolkit' ),
				'new_item'           => esc_html__( 'New Skill', 'nictitate-lite-ii-toolkit' ),
				'edit_item'          => esc_html__( 'Edit Skill', 'nictitate-lite-ii-toolkit' ),
				'view_item'          => esc_html__( 'View Skill', 'nictitate-lite-ii-toolkit' ),
				'all_items'          => esc_html__( 'All Skills', 'nictitate-lite-ii-toolkit' ),
				'search_items'       => esc_html__( 'Search Skills', 'nictitate-lite-ii-toolkit' ),
				'parent_item_colon'  => esc_html__( 'Parent Skills:', 'nictitate-lite-ii-toolkit' ),
				'not_found'          => esc_html__( 'No Skills found.', 'nictitate-lite-ii-toolkit' ),
				'not_found_in_trash' => esc_html__( 'No Skills found in Trash.', 'nictitate-lite-ii-toolkit' )
			);

			$args = array(
				'menu_icon'          => 'dashicons-star-empty',
				'public'             => true,
				'labels'             => $labels,
				'supports'           => array( 'title' ),
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_nav_menus'  => false,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => 'skill' ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 107
			);

			register_post_type( 'skill', $args );

			$labels = array(
				'name'              => esc_html__( 'Skill Tags', 'nictitate-lite-ii-toolkit' ),
				'singular_name'     => esc_html__( 'Tag', 'nictitate-lite-ii-toolkit' ),
				'search_items'      => esc_html__( 'Search Tags', 'nictitate-lite-ii-toolkit' ),
				'all_items'         => esc_html__( 'All Tags', 'nictitate-lite-ii-toolkit' ),
				'parent_item'       => esc_html__( 'Parent Tag', 'nictitate-lite-ii-toolkit' ),
				'parent_item_colon' => esc_html__( 'Parent Tag:', 'nictitate-lite-ii-toolkit' ),
				'edit_item'         => esc_html__( 'Edit Tag', 'nictitate-lite-ii-toolkit' ),
				'update_item'       => esc_html__( 'Update Tag', 'nictitate-lite-ii-toolkit' ),
				'add_new_item'      => esc_html__( 'Add New Tag', 'nictitate-lite-ii-toolkit' ),
				'new_item_name'     => esc_html__( 'New Tag Name', 'nictitate-lite-ii-toolkit' ),
				'menu_name'         => esc_html__( 'Tags', 'nictitate-lite-ii-toolkit' )
			);

			$args = array(
				'hierarchical'      => false,
				'labels'            => $labels,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'skill-tag' )
			);

			register_taxonomy( 'skill-tag', array( 'skill' ), $args );
		}

		public function register_metabox() {
			$nictitate_lite_ii_toolkit_skill_fields = array(
				array(
					'title'   => esc_html__( 'Progress', 'nictitate-lite-ii-toolkit' ),
					'type'    => 'text',
					'id'      => 'nictitate-toolkit-skill-progress'
				),
			);
			$nictitate_lite_ii_toolkit_skill_fields = apply_filters( 'nictitate_lite_ii_toolkit_skill_fields', $nictitate_lite_ii_toolkit_skill_fields );

			$args = array(
				'id'          => 'nictitate-lite-ii-toolkit-skill-metabox',
				'title'       => esc_html__( 'Other info', 'nictitate-lite-ii-toolkit' ),
				'desc'        => '',
				'pages'       => array( 'skill' ),
				'context'     => 'normal',
				'priority'    => 'low',
				'fields'      => $nictitate_lite_ii_toolkit_skill_fields
			);

			kopa_register_metabox( $args );
		}

		public function manage_colums( $columns ) {			
			$columns = array(
				'cb'                                 => esc_html__( '<input type="checkbox" />', 'nictitate-lite-ii-toolkit' ),
				'title'                              => esc_html__( 'Title', 'nictitate-lite-ii-toolkit' ),
				'nictitate-lite-ii-toolkit-progress' => esc_html__( 'Progress', 'nictitate-lite-ii-toolkit' ),
				'taxonomy-skill-tag'                 => esc_html__( 'Tags', 'nictitate-lite-ii-toolkit' )
			);

			return $columns;	
		}

		public function manage_colum( $column ) {
			global $post;
			switch ( $column ) {
				case 'nictitate-lite-ii-toolkit-progress':
					echo get_post_meta( $post->ID, 'nictitate-toolkit-skill-progress', true );
					break;
			}
		}

		public function require_widgets() {
			require_once NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/skill/widgets/skill-counter.php';
		}
	}

	$Nictitate_Toolkit_II_Skill = new Nictitate_Toolkit_II_Skill();
	$Nictitate_Toolkit_II_Skill->require_widgets();
}