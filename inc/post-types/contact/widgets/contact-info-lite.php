<?php
add_action( 'widgets_init', array( 'Nictitate_Toolkit_II_Widget_Contact_Info_Lite', 'register_widget' ) );

class Nictitate_Toolkit_II_Widget_Contact_Info_Lite extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_widget() {
        register_widget( 'Nictitate_Toolkit_II_Widget_Contact_Info_Lite' );
    }

    public function __construct() {
        $this->widget_cssclass    = 'k-widget-info-2';
        $this->widget_description = esc_html__( 'Show contact info.', 'nictitate-lite-ii-toolkit' );
        $this->widget_id          = 'nictitate-toolkit-ii-widget-contact-info-lite';
        $this->widget_name        = esc_html__( '__Contact Info Lite', 'nictitate-lite-ii-toolkit' );

        $this->settings 		  = array(
            'title'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Title:', 'nictitate-lite-ii-toolkit' )
            ),
            'phone'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Phone:', 'nictitate-lite-ii-toolkit' )
            ),
            'address'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Address:', 'nictitate-lite-ii-toolkit' )
            ),
            'email'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Email:', 'nictitate-lite-ii-toolkit' )
            )
        );

        parent::__construct();
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $instance = wp_parse_args( (array) $instance, $this->get_default_instance() );
        extract( $instance );
        echo wp_kses_post( $before_widget );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        
        if ( $title) {
            echo wp_kses_post( $before_title . $title .$after_title );
        }
        ?>
            <div class="row">
                <?php if ( $phone ) : ?>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="item item-phone ">
                            <i class="icon fa fa-phone"></i>
                            <p>
                                <strong><?php esc_html_e( 'Phone:', 'nictitate-lite-ii-toolkit' ); ?></strong>
                                <span><?php echo wp_kses_post( $phone ); ?></span>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ( $address ) : ?>
                    <div class="col-md-4  col-sm-4 col-xs-12">
                        <div class="item item-marker  ">
                            <i class="icon fa fa-map-marker"></i>
                            <p>
                                <strong><?php esc_html_e( 'Add:', 'nictitate-lite-ii-toolkit' ); ?></strong>
                                <span><?php echo wp_kses_post( $address ); ?></span>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ( $email ) : ?>
                    <div class="col-md-4  col-sm-4 col-xs-12">
                        <div class="item item-envelope  ">
                            <i class="icon fa fa-envelope-o"></i>
                            <p>
                                <strong><?php esc_html_e( 'Email:', 'nictitate-lite-ii-toolkit' ); ?></strong>
                                <span><?php echo wp_kses_post( $email ); ?></span>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php 
        echo wp_kses_post( $after_widget );
    }
}