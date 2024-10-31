<?php

if ( ! class_exists( 'Nictitate_Toolkit_II_Staff' ) ) {

	class Nictitate_Toolkit_II_Staff {

		public function __construct() {				
			add_action( 'init', array( $this, 'init' ), 0 );			
			add_action( 'admin_init', array( $this, 'register_metabox' ) );			
			add_filter( 'manage_staffs_posts_columns', array( $this, 'manage_colums' ) );
		}

		public function require_widgets() {
			require_once NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/staff/widgets/staff-list.php';
		}

		public function init() {

			#POSTTYPE
			$labels = array(
				'name'               => esc_html__( 'Staffs', 'nictitate-lite-ii-toolkit' ),
				'singular_name'      => esc_html__( 'Staff', 'nictitate-lite-ii-toolkit' ),
				'add_new'            => esc_html__( 'Add New', 'nictitate-lite-ii-toolkit' ),
				'add_new_item'       => esc_html__( 'Add New Item', 'nictitate-lite-ii-toolkit' ),
				'edit_item'          => esc_html__( 'Edit Item', 'nictitate-lite-ii-toolkit' ),
				'new_item'           => esc_html__( 'New Item', 'nictitate-lite-ii-toolkit' ),
				'all_items'          => esc_html__( 'All Items', 'nictitate-lite-ii-toolkit' ),
				'view_item'          => esc_html__( 'View Item', 'nictitate-lite-ii-toolkit' ),
				'search_items'       => esc_html__( 'Search Items', 'nictitate-lite-ii-toolkit' ),
				'not_found'          => esc_html__( 'No items found', 'nictitate-lite-ii-toolkit' ),
				'not_found_in_trash' => esc_html__( 'No items found in Trash', 'nictitate-lite-ii-toolkit' ),
				'parent_item_colon'  => '',
				'menu_name'          => esc_html__( 'Staffs', 'nictitate-lite-ii-toolkit' )
		    );

		    $args = array(
				'menu_icon'            => 'dashicons-groups',
				'labels'               => $labels,
				'public'               => false,
				'publicly_queryable'   => true,
				'show_ui'              => true,
				'show_in_menu'         => true,
				'query_var'            => true,
				'rewrite'              => array( 'slug' => 'staffs' ),
				'capability_type'      => 'post',
				'has_archive'          => true,
				'hierarchical'         => false,
				'exclude_from_search'  => true,
				'menu_position'        => 100,
				'supports'             => array( 'title', 'thumbnail', 'editor', 'excerpt' ),
				'can_export'           => true,
				'register_meta_box_cb' => ''
		    );

		    register_post_type( 'staffs', $args );

		    $taxonomy_category_args = array(
				'public'       => true,
				'hierarchical' => true,
				'labels'       => array(
					'name'                       => esc_html__( 'Staff Categories', 'nictitate-lite-ii-toolkit' ),
					'singular_name'              => esc_html__( 'Category', 'nictitate-lite-ii-toolkit' ),
					'search_items'               => esc_html__( 'Search Category', 'nictitate-lite-ii-toolkit' ),
					'popular_items'              => esc_html__( 'Popular Staffs', 'nictitate-lite-ii-toolkit' ),
					'all_items'                  => esc_html__( 'All Staffs', 'nictitate-lite-ii-toolkit' ),
					'parent_item'                => null,
					'parent_item_colon'          => null,
					'edit_item'                  => esc_html__( 'Edit Staff', 'nictitate-lite-ii-toolkit' ),
					'update_item'                => esc_html__( 'Update Staff', 'nictitate-lite-ii-toolkit' ),
					'add_new_item'               => esc_html__( 'Add New Staff', 'nictitate-lite-ii-toolkit' ),
					'new_item_name'              => esc_html__( 'New Staff Name', 'nictitate-lite-ii-toolkit' ),
					'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'nictitate-lite-ii-toolkit' ),
					'add_or_remove_items'        => esc_html__( 'Add or remove category', 'nictitate-lite-ii-toolkit' ),
					'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'nictitate-lite-ii-toolkit' ),
					'menu_name'                  => esc_html__( 'Staff Categories', 'nictitate-lite-ii-toolkit' )
		        ),
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '',
				'query_var'             => true,
				'show_in_nav_menus'     => false,
				'show_tagcloud'         => true,
				'rewrite'               => array( 'slug' => 'staff_category' )
		    );

		    register_taxonomy( 'staff_category', 'staffs', $taxonomy_category_args );

		    #TAXONOMY TAG
		    $taxonomy_tag_args = array(
				'public'       => true,
				'hierarchical' => false,
				'labels'       => array(
					'name'                       => esc_html__( 'Staff Tags', 'nictitate-lite-ii-toolkit' ),
					'singular_name'              => esc_html__( 'Tag', 'nictitate-lite-ii-toolkit' ),
					'search_items'               => esc_html__( 'Search Tag', 'nictitate-lite-ii-toolkit' ),
					'popular_items'              => esc_html__( 'Popular Tags', 'nictitate-lite-ii-toolkit' ),
					'all_items'                  => esc_html__( 'All Tags', 'nictitate-lite-ii-toolkit' ),
					'parent_item'                => null,
					'parent_item_colon'          => null,
					'edit_item'                  => esc_html__( 'Edit Tag', 'nictitate-lite-ii-toolkit' ),
					'update_item'                => esc_html__( 'Update Tag', 'nictitate-lite-ii-toolkit' ),
					'add_new_item'               => esc_html__( 'Add New Tag', 'nictitate-lite-ii-toolkit' ),
					'new_item_name'              => esc_html__( 'New Tag Name', 'nictitate-lite-ii-toolkit' ),
					'separate_items_with_commas' => esc_html__( 'Separate tags with commas', 'nictitate-lite-ii-toolkit' ),
					'add_or_remove_items'        => esc_html__( 'Add or remove tag', 'nictitate-lite-ii-toolkit' ),
					'choose_from_most_used'      => esc_html__( 'Choose from the most used tags', 'nictitate-lite-ii-toolkit' ),
					'menu_name'                  => esc_html__( 'Staff Tags', 'nictitate-lite-ii-toolkit' )
		        ),
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '',
				'query_var'             => true,
				'show_in_nav_menus'     => false,
				'show_tagcloud'         => true,
				'rewrite'               => array( 'slug' => 'staff_tag' )
		    );

		    register_taxonomy( 'staff_tag', 'staffs', $taxonomy_tag_args );

		    flush_rewrite_rules( false );    
		}

		public function register_metabox() {

			$staff_social = nictitate_lite_ii_toolkit_staff_social_link();

			$staff_metabox_fields = array(
					array(
						'title'   => esc_html__( 'Position:', 'nictitate-lite-ii-toolkit' ),
						'type'    => 'text',
						'default' => '',
						'id'      => 'position'			
					),
					array(
						'title'   => esc_html__( 'Email:', 'nictitate-lite-ii-toolkit' ),
						'type'    => 'email',
						'default' => '',
						'id'      => 'email'				
					)
				);
			foreach ( $staff_social as $key=> $value ) {
				
				$staff_metabox_fields[] = array(
					'title'   => $value['name'],
					'type'    => 'url',
					'default' => '',
					'id'      => $key
				);
			}

			$args = array(
				'id'          => 'nictitate-lite-ii-toolkit-staff-edit',
			    'title'       => esc_html__( 'Staff Social Meta Box', 'nictitate-lite-ii-toolkit' ),
			    'desc'        => '',
			    'pages'       => array( 'staffs' ),
			    'context'     => 'normal',
			    'priority'    => 'high',
			    'fields'      => $staff_metabox_fields
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums( $columns ) {			
			$columns = array(
				'cb'                      => esc_html__( '<input type="checkbox" />', 'nictitate-lite-ii-toolkit' ),
				'title'                   => esc_html__( 'Title', 'nictitate-lite-ii-toolkit' ),
				'taxonomy-staff_category' => esc_html__( 'Services Categories', 'nictitate-lite-ii-toolkit' ),
				'taxonomy-staff_tag'      => esc_html__( 'Services Tags', 'nictitate-lite-ii-toolkit' ),
				'date'                    => esc_html__( 'Date', 'nictitate-lite-ii-toolkit' )
			);

			return $columns;	
		}

		

	}

	$Nictitate_Toolkit_II_Staff = new Nictitate_Toolkit_II_Staff();
	$Nictitate_Toolkit_II_Staff->require_widgets();	

	function nictitate_lite_ii_toolkit_staff_social_link(){

		$social_link = apply_filters( 'nictitate_nictitate_lite_ii_toolkit_staff_social_link', array(
			'facebook' => array( 'name' => esc_html__( 'Facebook', 'nictitate-lite-ii-toolkit' ), 'icon' => 'fa fa-facebook' ), 
			'twitter'  => array( 'name' => esc_html__( 'Twitter', 'nictitate-lite-ii-toolkit' ), 'icon' => 'fa fa-twitter' ), 
			'gplus'    => array( 'name' => esc_html__( 'Google Plus', 'nictitate-lite-ii-toolkit' ), 'icon' => 'fa fa-google-plus' )
			)
		);

		return $social_link;
	}
}