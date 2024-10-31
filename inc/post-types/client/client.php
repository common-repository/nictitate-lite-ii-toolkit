<?php

if ( ! class_exists( 'Nictitate_Toolkit_II_Client' ) ) {

	class Nictitate_Toolkit_II_Client {

		public function __construct() {				
			add_action( 'init', array( $this, 'init' ), 0 );			
			add_action( 'admin_init', array( $this, 'register_metabox' ) );
			add_filter( 'manage_clients_posts_columns', array( $this, 'manage_colums' ) );
		}

		public function require_widgets() {
			require_once 'widgets/clients.php';
		}

		public function init() {

			#POSTTYPE
			$labels = array(
				'name'               => esc_html__( 'Clients', 'nictitate-lite-ii-toolkit' ),
				'singular_name'      => esc_html__( 'Client', 'nictitate-lite-ii-toolkit' ),
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
				'menu_name'          => esc_html__( 'Clients', 'nictitate-lite-ii-toolkit' )
		    );

		    $args = array(
				'menu_icon'            => 'dashicons-networking',
				'labels'               => $labels,
				'public'               => false,
				'publicly_queryable'   => true,
				'show_ui'              => true,
				'show_in_menu'         => true,
				'query_var'            => true,
				'rewrite'              => array( 'slug' => 'clients' ),
				'capability_type'      => 'post',
				'has_archive'          => true,
				'hierarchical'         => false,
				'exclude_from_search'  => true,
				'menu_position'        => 100,
				'supports'             => array( 'title', 'thumbnail' ),
				'can_export'           => true,
				'register_meta_box_cb' => ''
		    );

		    register_post_type( 'clients', $args );

		    $taxonomy_category_args = array(
				'public'       => true,
				'hierarchical' => true,
				'labels'       => array(
					'name'                       => esc_html__( 'Client Categories', 'taxonomy general name', 'nictitate-lite-ii-toolkit' ),
					'singular_name'              => esc_html__( 'Category', 'taxonomy singular name', 'nictitate-lite-ii-toolkit' ),
					'search_items'               => esc_html__( 'Search Category', 'nictitate-lite-ii-toolkit' ),
					'popular_items'              => esc_html__( 'Popular Clients', 'nictitate-lite-ii-toolkit' ),
					'all_items'                  => esc_html__( 'All Clients', 'nictitate-lite-ii-toolkit' ),
					'parent_item'                => null,
					'parent_item_colon'          => null,
					'edit_item'                  => esc_html__( 'Edit Client', 'nictitate-lite-ii-toolkit' ),
					'update_item'                => esc_html__( 'Update Client', 'nictitate-lite-ii-toolkit' ),
					'add_new_item'               => esc_html__( 'Add New Client', 'nictitate-lite-ii-toolkit' ),
					'new_item_name'              => esc_html__( 'New Client Name', 'nictitate-lite-ii-toolkit' ),
					'separate_items_with_commas' => esc_html__( 'Separate categories with commas', 'nictitate-lite-ii-toolkit' ),
					'add_or_remove_items'        => esc_html__( 'Add or remove category', 'nictitate-lite-ii-toolkit' ),
					'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'nictitate-lite-ii-toolkit' ),
					'menu_name'                  => esc_html__( 'Client Categories', 'nictitate-lite-ii-toolkit' )
		        ),
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '',
				'query_var'             => true,
				'show_in_nav_menus'     => false,
				'show_tagcloud'         => true,
				'rewrite'               => array( 'slug' => 'client_category' )
		    );

		    register_taxonomy( 'client_category', 'clients', $taxonomy_category_args );

		    #TAXONOMY TAG
		    $taxonomy_tag_args = array(
				'public'       => true,
				'hierarchical' => false,
				'labels'       => array(
					'name'                       => esc_html__( 'Client Tags', 'taxonomy general name', 'nictitate-lite-ii-toolkit' ),
					'singular_name'              => esc_html__( 'Tag', 'taxonomy singular name', 'nictitate-lite-ii-toolkit' ),
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
					'menu_name'                  => esc_html__( 'Client Tags', 'nictitate-lite-ii-toolkit' )
		        ),
				'show_ui'               => true,
				'show_admin_column'     => true,
				'update_count_callback' => '',
				'query_var'             => true,
				'show_in_nav_menus'     => false,
				'show_tagcloud'         => true,
				'rewrite'               => array( 'slug' => 'client_tag' )
		    );

		    register_taxonomy( 'client_tag', 'clients', $taxonomy_tag_args );

		    flush_rewrite_rules( false );   
		}

		public function register_metabox() {

			$args = array(
				'id'          => 'nictitate-lite-ii-toolkit-client-edit',
			    'title'       => esc_html__( 'Meta box', 'nictitate-lite-ii-toolkit' ),
			    'desc'        => '',
			    'pages'       => array( 'clients' ),
			    'context'     => 'normal',
			    'priority'    => 'high',
			    'fields'      => array(
			    	array(
						'title'   => esc_html__( 'Client URL:', 'nictitate-lite-ii-toolkit' ),
						'type'    => 'url',
						'default' => '',
						'id'      => 'client_url'
					)
			    )
			);			
			
			kopa_register_metabox( $args );
		}

		public function manage_colums( $columns ) {			
			$columns = array(
				'cb'                       => esc_html__( '<input type="checkbox" />', 'nictitate-lite-ii-toolkit' ),
				'title'                    => esc_html__( 'Title', 'nictitate-lite-ii-toolkit' ),
				'taxonomy-client_category' => esc_html__( 'Client Categories', 'nictitate-lite-ii-toolkit' ),
				'taxonomy-client_tag'      => esc_html__( 'Client Tags', 'nictitate-lite-ii-toolkit' ),
				'date'                     => esc_html__( 'Date', 'nictitate-lite-ii-toolkit' )
			);

			return $columns;	
		}

	}

	$Nictitate_Toolkit_II_Client = new Nictitate_Toolkit_II_Client();
	$Nictitate_Toolkit_II_Client->require_widgets();
	
}