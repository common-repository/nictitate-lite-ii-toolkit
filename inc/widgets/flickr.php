<?php

add_action( 'widgets_init', array( 'Nictitate_Lite_II_Toolkit_Widget_Flickr', 'register_widget' ) );

class Nictitate_Lite_II_Toolkit_Widget_Flickr extends Kopa_Widget {

    public $kpb_group = 'other';

    public static function register_widget() {
        register_widget( 'Nictitate_Lite_II_Toolkit_Widget_Flickr' );
    }

    function __construct() {
        $this->widget_cssclass    = ' k-widget-flickr';
        $this->widget_id          = 'nictitate_toolkit_ii-flickr';
        $this->widget_name        = esc_html__( '__Flickr', 'nictitate-lite-ii-toolkit' );
        $this->widget_description = esc_html__( 'Display photo stream from flickr.com', 'nictitate-lite-ii-toolkit' );

        $allowed_html = array( 'a' => array( 'href' => array(), 'title' => array(), 'target' => array() ) ); 
        $this->settings = array(
            'title' => array(
                'type'  => 'text',
                'std'   => esc_html__( 'Flickr', 'nictitate-lite-ii-toolkit' ),
                'label' => esc_html__( 'Title', 'nictitate-lite-ii-toolkit' )
                ),
            'id' => array(
                'type'  => 'text',
                'std'   => esc_html__( '78715597@N07', 'nictitate-lite-ii-toolkit' ),
                'label' => esc_html__( 'ID', 'nictitate-lite-ii-toolkit' ),
                'desc'  => wp_kses(__( 'Get Flickr ID in <a href="http://idgettr.com/" target="__blank">here</a>.', 'nictitate-lite-ii-toolkit' ), $allowed_html )
                ),
            'limit' => array(
                'type'  => 'number',
                'std'   => 6,
                'label' => esc_html__( 'Number of images', 'nictitate-lite-ii-toolkit' ),
                'min'   => 1
                )
            );
        parent::__construct();
    }

    public function widget( $args, $instance ) {
    	ob_start();
    	$instance = wp_parse_args( (array) $instance, $this->get_default_instance() );
    	extract( $instance );
        extract( $args );
        $id = $instance['id'];
        $out = sprintf( '<div class="widget-content"><div class="flickr-wrap clearfix" data-id="%s" data-limit="%s" data-tag="">', $id, $limit );
        $out .= '<ul class="clearfix list-unstyled"></ul>';
        $out .= '</div></div>';

        echo $before_widget;
        if ( ! empty( $title ) ): ?>
        	<h3 class="widget-title"><?php echo esc_attr( $title ); ?></h3>
       	<?php endif;
        echo apply_filters( 'Nictitate_Lite_II_Toolkit_Widget_Flickr', $out );
        echo $after_widget;
    }

}