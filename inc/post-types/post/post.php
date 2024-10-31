<?php

if ( ! class_exists( 'Nictitate_Toolkit_II_Post' ) ) {

	class Nictitate_Toolkit_II_Post {

		public function __construct(){				
			add_image_size( 'nictitate_posts-list-3-col-big', 556, 367, true );
			add_image_size( 'nictitate_posts-list-3-col-small', 264, 209, true );
			add_image_size( 'nictitate_posts-list-carousel', 279, 207, true );
		}

		public function require_widgets() {
			require_once 'widgets/posts-list-3-col.php';
			require_once 'widgets/posts-list-carousel.php';
			require_once 'widgets/recent-posts.php';
		}

	}

	$Nictitate_Toolkit_II_Post = new Nictitate_Toolkit_II_Post();
	$Nictitate_Toolkit_II_Post->require_widgets();
}

function nictitate_lite_ii_toolkit_get_post_widget_args() {
	
	$all_cats = get_categories();
	$categories = array( '' => esc_html__( '-- none --', 'nictitate-lite-ii-toolkit' ) );
	foreach ( $all_cats as $cat ) {
		$categories[ $cat->slug ] = $cat->name;
	}

	$all_tags = get_tags();
	$tags = array( '' => esc_html__( '-- none --', 'nictitate-lite-ii-toolkit' ) );
	foreach( $all_tags as $tag ) {
		$tags[ $tag->slug ] = $tag->name;
	}

	return array(
		'title'  => array(
			'type'  => 'text',
			'std'   => '',
			'label' => esc_html__( 'Title:', 'nictitate-lite-ii-toolkit' )
		),
		'categories' => array(
			'type'    => 'multiselect',
			'std'     => '',
			'label'   => esc_html__( 'Categories:', 'nictitate-lite-ii-toolkit' ),
			'options' => $categories,
			'size'    => '5'
		),
		'relation'    => array(
			'type'    => 'select',
			'label'   => esc_html__( 'Relation:', 'nictitate-lite-ii-toolkit' ),
			'std'     => 'OR',
			'options' => array(
				'AND' => esc_html__( 'AND', 'nictitate-lite-ii-toolkit' ),
				'OR'  => esc_html__( 'OR', 'nictitate-lite-ii-toolkit' )
			)
		),
		'tags' => array(
			'type'    => 'multiselect',
			'std'     => '',
			'label'   => esc_html__( 'Tags:', 'nictitate-lite-ii-toolkit' ),
			'options' => $tags,
			'size'    => '5'
		),
		'order' => array(
			'type'  => 'select',
			'std'   => 'DESC',
			'label' => esc_html__( 'Order:', 'nictitate-lite-ii-toolkit' ),
			'options' => array(
				'ASC'  => esc_html__( 'ASC', 'nictitate-lite-ii-toolkit' ),
				'DESC' => esc_html__( 'DESC', 'nictitate-lite-ii-toolkit' )
			)
		),
		'orderby' => array(
			'type'  => 'select',
			'std'   => 'date',
			'label' => esc_html__( 'Orderby:', 'nictitate-lite-ii-toolkit' ),
			'options' => array(
				'date'          => esc_html__( 'Date', 'nictitate-lite-ii-toolkit' ),
				'rand'          => esc_html__( 'Random', 'nictitate-lite-ii-toolkit' ),
				'comment_count' => esc_html__( 'Number of comments', 'nictitate-lite-ii-toolkit' )
			)
		),
		'number' => array(
			'type'    => 'number',
			'std'     => '5',
			'label'   => esc_html__( 'Number of posts:', 'nictitate-lite-ii-toolkit' ),
			'min'     => '1',
		)
	);
}

function nictitate_lite_ii_toolkit_get_post_widget_query( $instance ) {
	$query = array(
		'post_type'           => 'post',
		'posts_per_page'      => $instance['number'],
		'order'               => $instance['order'] == 'ASC' ? 'ASC' : 'DESC',
		'orderby'             => $instance['orderby'],
		'ignore_sticky_posts' => true
	);

	if ( $instance['categories'] ) {		
		if ( $instance['categories'][0] == '' )
			unset( $instance['categories'][0] );

		if ( $instance['categories'] ) {
			$query['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $instance['categories']
			);
		}
	}

	if ( $instance['tags'] ) {
		if ( $instance['tags'][0] == '' )
			unset( $instance['tags'][0] );

		if ( $instance['tags'] ) {
			$query['tax_query'][] = array(
				'taxonomy' => 'post_tag',
				'field'    => 'slug',
				'terms'    => $instance['tags']
			);
		}
	}

	if ( isset( $query['tax_query'] ) && count( $query['tax_query'] ) === 2 ) {
		$query['tax_query']['relation'] = $instance['relation'];
	}

	return apply_filters( 'nictitate_lite_ii_toolkit_get_post_widget_query', $query );
}