<?php

add_filter('kpb_get_widgets_list', array( 'Nictitate_Toolkit_II_Widget_Slider_Carousel_Full', 'register_block' ) );

class Nictitate_Toolkit_II_Widget_Slider_Carousel_Full extends Kopa_Widget {

	public $kpb_group = 'slider';
	
	public static function register_block($blocks){
        $blocks['Nictitate_Toolkit_II_Widget_Slider_Carousel_Full'] = new Nictitate_Toolkit_II_Widget_Slider_Carousel_Full();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'k-widget-full-width-single-carousel';
		$this->widget_description = esc_html__( 'Display simple slider carousel full width.', 'nictitate-lite-ii-toolkit' );
		$this->widget_id          = 'kopa-slider-full';
		$this->widget_name        = esc_html__( '__Slider Carousel Full', 'nictitate-lite-ii-toolkit' );

		$this->settings = array(			
			'title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'nictitate-lite-ii-toolkit' )
			),			
		);

		$this->settings['excerpt_length'] = array(
				'type'  => 'number',
				'std'   => 20,
				'label' => esc_html__( 'Excerpt length', 'nictitate-lite-ii-toolkit' )		
		);	
		$this->settings['posts_per_page'] = array(			
				'type'  => 'text',
				'std'   => 4,
				'label' => esc_html__( 'Number of slide', 'nictitate-lite-ii-toolkit' )
		);	

		$cbo_tags_options = array( '' => esc_html__( '-- All --', 'nictitate-lite-ii-toolkit' ) );
		
		$tags = get_terms( 'slide-tag' );				
		if ( $tags && !is_wp_error( $tags ) ) {						
			foreach ( $tags as $tag ) {									
				$cbo_tags_options[ $tag->slug ] = "{$tag->name} ({$tag->count})";
			}
		}
		
		$this->settings['tags'] = array(
			'type'    => 'select',
			'label'   => esc_html__( 'Tags', 'nictitate-lite-ii-toolkit' ),
			'std'     => '',
			'options' => $cbo_tags_options
		);

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		ob_start();
		extract( $args );
		extract( $instance );
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		$query = array(
			'post_type'      => array('slide'),
			'posts_per_page' => (int) $instance['posts_per_page'],
			'post_status'    => array('publish')
		);

		if ( !empty( $tags ) ) {
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'slide-tag',
					'field'    => 'slug',
					'terms'    => $tags
				),
			);
		}

		$result_set = new WP_Query( $query );
		echo wp_kses_post( $before_widget );
		if ( $title ) {
			echo wp_kses_post( $before_title . $title . $after_title );
		}
		?>
			<?php if ( $result_set->have_posts() ) : ?>
				<div class="owl-carousel single-carousel">
					<?php
                    	while ( $result_set->have_posts() ) : $result_set->the_post();
							$button_text = get_post_meta( get_the_id(), 'slider_button_text', true );
							$button_url  = get_post_meta( get_the_id(), 'slider_button_url', true );
                            ?>
                            <div class="item">
	                            <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	                            <?php 
									$GLOBALS['nictitate_lite_ii_excerpt_length'] = (int) $excerpt_length;
									add_filter( 'excerpt_length', 'nictitate_lite_ii_set_excerpt_length' );
									the_excerpt(); 
									remove_filter( 'excerpt_length', 'nictitate_lite_ii_set_excerpt_length' );
								?>
								<?php if ( $button_text && $button_url ) : ?>
		                            <div>
		                                <a href="<?php echo esc_url( $button_url ); ?>" class="read-more read-more-border"><?php echo esc_html__( $button_text ); ?></a>
		                            </div>
		                        <?php endif; ?>
		                    </div>
                            <?php
                    	endwhile;
                    ?>
				</div>
			<?php endif; ?>
        <?php
		wp_reset_postdata();
		echo wp_kses_post( $after_widget );
	}
}