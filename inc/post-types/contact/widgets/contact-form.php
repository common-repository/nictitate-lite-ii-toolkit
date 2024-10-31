<?php
add_filter( 'kpb_get_widgets_list', array( 'Nictitate_Toolkit_II_Widget_Contact_Form', 'register_block' ) );

class Nictitate_Toolkit_II_Widget_Contact_Form extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_block($blocks){
        $blocks['Nictitate_Toolkit_II_Widget_Contact_Form'] = new Nictitate_Toolkit_II_Widget_Contact_Form();
        return $blocks;
    }

	public function __construct() {
		$this->widget_cssclass    = 'k-widget-contact-form';
		$this->widget_description = esc_html__( 'Display Contact Form.', 'nictitate-lite-ii-toolkit' );
		$this->widget_id          = 'nictitate-toolkit-contact-form';
		$this->widget_name        = esc_html__( '__Contact Form', 'nictitate-lite-ii-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'nictitate-lite-ii-toolkit' )
			)            
		);	

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		ob_start();
		extract( $args );
        $instance = wp_parse_args( (array) $instance, $this->get_default_instance() );
        extract( $instance );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		echo wp_kses_post( $before_widget );
		if ( $title ) {
			echo wp_kses_post( $before_title . $title .$after_title );	
		}
        echo '<div class="widget-content">';
        echo do_shortcode( '[nictitate_toolkit_ii_contactform]' );
        echo '</div>';
		echo wp_kses_post( $after_widget);	
	}
}