<?php

if( ! class_exists( 'Nictitate_Toolkit_II_Portfolio' ) ) {

	class Nictitate_Toolkit_II_Portfolio {

		public function __construct() {				
			add_action( 'init', array( $this, 'init' ), 0);			
			add_action( 'admin_init', array( $this, 'register_metabox' ) );
            add_filter( 'manage_portfolio_posts_columns', array( $this, 'manage_colums' ) );
            add_action( 'admin_head-nav-menus.php', array( $this, 'add_nav_menus' ) );

            #print-layout
            add_action( 'pre_get_posts', array( $this, 'set_project_per_page' ) );

            #image size
			add_image_size( 'nictitate_portfolio-big', 568, 381, true );
			add_image_size( 'nictitate_portfolio-small', 279, 185, true );
			add_image_size( 'nictitate_portfolio-circle-1', 146, 146, true );
			add_image_size( 'nictitate_portfolio-circle-2', 220, 220, true );
			add_image_size( 'nictitate_portfolio-circle-3', 134, 134, true );
			add_image_size( 'nictitate_portfolio-circle-4', 273, 273, true );
			add_image_size( 'nictitate_portfolio-single', 683, 366, true );
            add_image_size( 'nictitate_portfolio-big-ii', 1145, 440, true );
            add_image_size( 'nictitate_portfolio-small-ii', 362, 225, true );
            add_image_size( 'nictitate_portfolio-medium-ii', 755, 424, true );
		}

        public function init() {

            #POSTTYPE
            $labels = array(
                'name'               => esc_html__( 'Portfolios', 'nictitate-lite-ii-toolkit' ),
                'singular_name'      => esc_html__( 'Portfolio', 'nictitate-lite-ii-toolkit' ),
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
                'menu_name'          => esc_html__( 'Portfolio', 'nictitate-lite-ii-toolkit' )
            );

            $args = array(
                'menu_icon'            => 'dashicons-portfolio',
                'labels'               => $labels,
                'public'               => true,
                'publicly_queryable'   => true,
                'show_ui'              => true,
                'show_in_menu'         => true,
                'query_var'            => true,
                'rewrite'              => array( 'slug' => 'portfolio' ),
                'capability_type'      => 'post',
                'has_archive'          => true,
                'hierarchical'         => false,
                'exclude_from_search'  => true,
                'menu_position'        => 100,
                'supports'             => array( 'title', 'thumbnail', 'excerpt', 'editor', 'post-formats', 'comments' ),
                'can_export'           => true,
                'register_meta_box_cb' => ''
            );

            register_post_type( 'portfolio', $args );

            #TAXONOMY CATEGORY
            $taxonomy_category_args = array(
                'public'       => true,
                'hierarchical' => true,
                'labels'       => array(
                    'name'                       => esc_html__( 'Portfolio Projects', 'taxonomy general name', 'nictitate-lite-ii-toolkit' ),
                    'singular_name'              => esc_html__( 'Project', 'taxonomy singular name', 'nictitate-lite-ii-toolkit' ),
                    'search_items'               => esc_html__( 'Search Project', 'nictitate-lite-ii-toolkit' ),
                    'popular_items'              => esc_html__( 'Popular Projects', 'nictitate-lite-ii-toolkit' ),
                    'all_items'                  => esc_html__( 'All Projects', 'nictitate-lite-ii-toolkit' ),
                    'parent_item'                => null,
                    'parent_item_colon'          => null,
                    'edit_item'                  => esc_html__( 'Edit Project', 'nictitate-lite-ii-toolkit' ),
                    'update_item'                => esc_html__( 'Update Project', 'nictitate-lite-ii-toolkit' ),
                    'add_new_item'               => esc_html__( 'Add New Project', 'nictitate-lite-ii-toolkit' ),
                    'new_item_name'              => esc_html__( 'New Project Name', 'nictitate-lite-ii-toolkit' ),
                    'separate_items_with_commas' => esc_html__( 'Separate projects with commas', 'nictitate-lite-ii-toolkit' ),
                    'add_or_remove_items'        => esc_html__( 'Add or remove category', 'nictitate-lite-ii-toolkit' ),
                    'choose_from_most_used'      => esc_html__( 'Choose from the most used projects', 'nictitate-lite-ii-toolkit' ),
                    'menu_name'                  => esc_html__( 'Projects', 'nictitate-lite-ii-toolkit' )
                ),
                'show_ui'               => true,
                'show_admin_column'     => true,
                'update_count_callback' => '',
                'query_var'             => true,
                'show_in_nav_menus'     => true,
                'show_tagcloud'         => true,
                'rewrite'               => array( 'slug' => 'portfolio_project' )
            );

            register_taxonomy( 'portfolio_project', 'portfolio', $taxonomy_category_args );

            #TAXONOMY TAG
            $taxonomy_tag_args = array(
                'public'       => true,
                'hierarchical' => false,
                'labels'       => array(
                    'name'                       => esc_html__( 'Portfolio Tags', 'taxonomy general name', 'nictitate-lite-ii-toolkit' ),
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
                    'menu_name'                  => esc_html__( 'Tags', 'nictitate-lite-ii-toolkit' )
                ),
                'show_ui'               => true,
                'show_admin_column'     => true,
                'update_count_callback' => '',
                'query_var'             => true,
                'show_in_nav_menus'     => true,
                'show_tagcloud'         => true,
                'rewrite'               => array( 'slug' => 'portfolio_tag' )
            );

            register_taxonomy( 'portfolio_tag', 'portfolio', $taxonomy_tag_args );

            flush_rewrite_rules( false );
        }

        public function register_metabox() {

            $args = array(
                'id'          => 'nictitate-lite-ii-toolkit-portfolio-edit',
                'title'       => esc_html__( 'Portfolio information', 'nictitate-lite-ii-toolkit' ),
                'desc'        => '',
                'pages'       => array( 'portfolio' ),
                'context'     => 'normal',
                'priority'    => 'high',
                'fields'      => array(
                    array(
                        'title' => esc_html__( 'Gallery', 'nictitate-lite-ii-toolkit' ),
                        'type'  => 'gallery',
                        'id'    => 'portfolio_gallery'
                    ),
                    array(
                        'title' => esc_html__( 'Client', 'nictitate-lite-ii-toolkit' ),
                        'type'  => 'text',
                        'id'    => 'portfolio_client'
                    ),
                    array(
                        'title'   => esc_html__( 'Date', 'nictitate-lite-ii-toolkit' ),
                        'type'    => 'datetime',
                        'id'      => 'portfolio_date',
                        'format'	=> 'Y/m/d',
                        'datepicker' => true,
                        'timepicker' => false
                    ),
                    array(
                        'title' => esc_html__( 'Website', 'nictitate-lite-ii-toolkit' ),
                        'type'  => 'text',
                        'id'    => 'portfolio_website'
                    ),
                    array(
                        'title' => esc_html__( 'Custom Thumbnail URL', 'nictitate-lite-ii-toolkit' ),
                        'type'  => 'upload',
                        'id'    => 'portfolio_custom_thumbnail',
                        'desc' => esc_html__( 'Only work in Widget __Portfolios Circle', 'nictitate-lite-ii-toolkit' )
                    ),
                )
            );

            kopa_register_metabox( $args );
        }
        
        public function manage_colums( $columns ) {
            $columns = array(
                'cb'                         => esc_html__( '<input type="checkbox" />', 'nictitate-lite-ii-toolkit' ),
                'title'                      => esc_html__( 'Title', 'nictitate-lite-ii-toolkit' ),
                'taxonomy-portfolio_project' => esc_html__( 'Portfolio Projects', 'nictitate-lite-ii-toolkit' ),
                'taxonomy-portfolio_tag'     => esc_html__( 'Portfolio Tags', 'nictitate-lite-ii-toolkit' ),
                'date'                       => esc_html__( 'Date', 'nictitate-lite-ii-toolkit' )
            );

            return $columns;
        }

        public function add_nav_menus() {
            add_meta_box(
                'nictitate_toolkit-metabox-nav-menu-posttype',
                esc_html__( 'Portfolio Archive', 'nictitate-lite-ii-toolkit' ),
                array( $this, 'add_nav_menus_forms' ),
                'nav-menus',
                'side',
                'default');
        }

        public function add_nav_menus_forms() {
            $post_types = get_post_types( array( 'show_in_nav_menus' => true, 'has_archive' => true ), 'object' );

            if ( $post_types ) :
                $items      = array();
                $loop_index = 999999;

                foreach ( $post_types as $slug => $post_type ) {
                    if ( 'portfolio' == $slug ) {
                        $item = new stdClass();
                        $loop_index++;
                        $item->object_id        = $loop_index;
                        $item->db_id            = 0;
                        $item->object           = 'post_type_' . $post_type->query_var;
                        $item->menu_item_parent = 0;
                        $item->type             = 'custom';
                        $item->title            = $post_type->labels->name;
                        $item->url              = get_post_type_archive_link($post_type->query_var);
                        $item->target           = '';
                        $item->attr_title       = '';
                        $item->classes          = array();
                        $item->xfn              = '';
                        $items[] = $item;
                        break;
                    }
                }

                $walker = new Walker_Nav_Menu_Checklist( array() );

                echo '<div id="nictitate_toolkit-portfolio-archived" class="posttypediv">';
                echo '<div id="tabs-panel-nictitate_toolkit-portfolio-archived" class="tabs-panel tabs-panel-active">';
                echo '<ul id="nictitate_toolkit-portfolio-archived-checklist" class="categorychecklist form-no-clear">';
                echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $items ), 0, (object) array( 'walker' => $walker ) );
                echo '</ul>';
                echo '</div>';
                echo '</div>';

                echo '<p class="button-controls">';
                echo '<span class="add-to-menu">';
                echo '<input type="submit"' . disabled( 1, 0 ) . ' class="button-secondary submit-add-to-menu right" value="' . esc_html__( 'Add to Menu', 'nictitate-lite-ii-toolkit' ) . '" name="add-nictitate_nictitate_toolkit-portfolio-archived-menu-item" id="submit-nictitate_toolkit-portfolio-archived" />';
                echo '<span class="spinner"></span>';
                echo '</span>';
                echo '</p>';

            endif;
        }

        public function set_project_per_page( $query ) {
            if ( ! is_admin() && $query->is_main_query() ) {
                if ( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_tag' ) || is_tax( 'portfolio_project' ) ) {
                    if ( $project_per_page = get_theme_mod( 'portfolio-archive-project-per-page', 9 ) ) {                        
                        $query->query_vars['posts_per_page'] = $project_per_page;
                    }
                }
            }
        }

        public function require_widgets() {
            require_once 'widgets/portfolios.php';
            require_once 'widgets/portfolios-circle.php';
            require_once 'widgets/portfolio-single.php';
        }

	}

	$Nictitate_Toolkit_II_Portfolio = new Nictitate_Toolkit_II_Portfolio();
    $Nictitate_Toolkit_II_Portfolio->require_widgets();
}
