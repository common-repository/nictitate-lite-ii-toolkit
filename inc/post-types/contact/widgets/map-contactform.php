<?php
add_filter( 'kpb_get_widgets_list', array( 'Nictitate_Toolkit_II_Widget_Contact_Form_Map', 'register_block' ) );
add_filter( 'nictitate_get_map_class_name', array( 'Nictitate_Toolkit_II_Widget_Contact_Form_Map', 'set_map_class_name' ) );

class Nictitate_Toolkit_II_Widget_Contact_Form_Map extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_block( $blocks ){
        $blocks['Nictitate_Toolkit_II_Widget_Contact_Form_Map'] = new Nictitate_Toolkit_II_Widget_Contact_Form_Map();
        return $blocks;
    }

    public static function set_map_class_name( $class_names ) {
        array_push( $class_names, 'Nictitate_Toolkit_II_Widget_Contact_Form_Map' );
        return $class_names;
    }

	public function __construct() {
		$this->widget_cssclass    = 'k-map-contact-form';
		$this->widget_description = esc_html__( 'Display Contact Form with Google Map.', 'nictitate-lite-ii-toolkit' );
		$this->widget_id          = 'nictitate-toolkit-contact-form-map';
		$this->widget_name        = esc_html__( '__Contact Form 2', 'nictitate-lite-ii-toolkit' );
		$this->settings 		  = array(
			'title'  => array(         
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Title', 'nictitate-lite-ii-toolkit' )
			),            
            'latitude'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__('Latitude', 'nictitate-lite-ii-toolkit')
            ),
			'longtitude'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__('Longtitude', 'nictitate-lite-ii-toolkit')
            ),
            'location'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__('Location', 'nictitate-lite-ii-toolkit')
            )
		);	

		parent::__construct();
	}

	public function widget( $args, $instance ) {
		ob_start();
		extract( $args );
        $instance = wp_parse_args( (array) $instance, $this->get_default_instance() );
        extract( $instance );
		$title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$map_id = 'kopa-map-' . wp_generate_password( 4, false, false );
        
    	echo wp_kses_post( $before_widget );
    		?>
    		<div class="container">
    			<div class="row">
    				<?php if ( ! empty( $latitude ) && ! empty( $longtitude) ) : ?>
    				<div id="<?php echo esc_attr( $map_id ); ?>" 
	                    class="k-map"                    
	                    data-latitude="<?php echo esc_attr( $latitude ); ?>" 
	                    data-longtitude="<?php echo esc_attr( $longtitude ); ?>"
	                    data-location="<?php echo esc_attr( $location ); ?>"></div>
	                <?php endif; ?>
	                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6 col-sm-offset-6">
			    		<?php
			    		if ( $title )
			    			echo wp_kses_post( $before_title . $title .$after_title );
			    		echo do_shortcode('[nictitate_toolkit_ii_contactform button_position="right" style="2"]');
			    		?>
			    	</div>
		    	</div>
	    	</div>
    		<?php
    	echo wp_kses_post( $after_widget );	
	}

}