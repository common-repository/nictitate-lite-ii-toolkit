<?php

add_action( 'kpb_get_widgets_list', array( 'Nictitate_Toolkit_II_Widget_Clients', 'register_block' ) );
	
class Nictitate_Toolkit_II_Widget_Clients extends Kopa_Widget {

	public $kpb_group = 'client';
	
	public static function register_block( $blocks ) {
       	$blocks['Nictitate_Toolkit_II_Widget_Clients'] = new Nictitate_Toolkit_II_Widget_Clients();
        return $blocks;
    }
    
	public function __construct() {
		$cat_arr    = array();
		$tag_arr    = array();
		$categories = get_terms( 'client_category' );
		$tags       = get_terms( 'client_tag' );

		if ( $categories && !is_wp_error( $categories ) ) {
	        foreach ( $categories as $category ) {
	        	$cat_arr[ $category->term_id ] = $category->name.'('.$category->count.')';
	        }
	    }

        if ( $tags && !is_wp_error( $tags ) ) {
	        foreach ( $tags as $tag ) {
	        	$tag_arr[ $tag->term_id ] = $tag->name.'('.$tag->count.')';
	        }
	    }
	    
		$this->widget_cssclass    = 'k-widget-logo';
		$this->widget_description = esc_html__( 'Display a clients widget.', 'nictitate-lite-ii-toolkit' );
		$this->widget_id          = 'nictitate-toolkit-ii-widget-clients';
		$this->widget_name        = esc_html__( '__Clients', 'nictitate-lite-ii-toolkit' );
		$this->settings 		  = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title:', 'nictitate-lite-ii-toolkit' )
			),
			'categories' => array(
				'type'    => 'multiselect',
				'std'     => '',
				'label'   => esc_html__( 'Categories:', 'nictitate-lite-ii-toolkit' ),
				'options' => $cat_arr,
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
				'options' => $tag_arr,
				'size'    => '5'
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'date',
				'label' => esc_html__( 'Orderby:', 'nictitate-lite-ii-toolkit' ),
				'options' => array(
					'date' => esc_html__( 'Date', 'nictitate-lite-ii-toolkit' ),
					'rand' => esc_html__( 'Random', 'nictitate-lite-ii-toolkit' )
				)
			),
			'posts_per_page'  => array(
				'type'  => 'text',
				'std'   => 4,
				'label' => esc_html__( 'Number of items', 'nictitate-lite-ii-toolkit' )
			)
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$instance = wp_parse_args( (array) $instance, $this->get_default_instance() );
		extract( $instance );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		$query = array(
			'post_type'           => 'clients',
			'posts_per_page'      => $instance['posts_per_page'],
			'orderby'             => $instance['orderby'],
			'ignore_sticky_posts' => true
		);

		if ( $instance['categories'] ) {		
			if( $instance['categories'][0] == '' )
				unset( $instance['categories'][0] );

			if ( $instance['categories'] ) {
				$query['tax_query'][] = array(
					'taxonomy' => 'client_category',
					'field'    => 'id',
					'terms'    => $instance['categories']
				);
			}
		}

		if ( $instance['tags'] ) {
			if( $instance['tags'][0] == '' )
				unset( $instance['tags'][0] );

			if ( $instance['tags'] ) {
				$query['tax_query'][] = array(
					'taxonomy' => 'client_tag',
					'field'    => 'id',
					'terms'    => $instance['tags']
				);
			}
		}

		if ( isset( $query['tax_query'] ) && count( $query['tax_query'] ) === 2 ) {
			$query['tax_query']['relation'] = $instance['relation'];
		}
		$result_set = new WP_Query( $query );
		echo wp_kses_post( $before_widget );
		?>
			<?php if ( $title )
				echo wp_kses_post( $before_title . $title .$after_title );
			?>
			<?php if ( $result_set->have_posts() ) : ?>
				<div class="owl-carousel">
					<?php 
						while( $result_set->have_posts() ) : $result_set->the_post();
						$url = get_post_meta( get_the_id(), 'client_url', true );
					?>
						<div class="item">
							<a href="<?php echo ( $url ) ? esc_url( $url ) : '#' ?>">
								<?php the_post_thumbnail( 'full' ); ?>
							</a>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		<?php
		wp_reset_postdata();
		echo wp_kses_post( $after_widget );
	}
}