<?php
add_action( 'widgets_init', array( 'Nictitate_Toolkit_II_Widget_Contact_Info', 'register_widget' ) );

class Nictitate_Toolkit_II_Widget_Contact_Info extends Kopa_Widget {

    public $kpb_group = 'contact';

    public static function register_widget() {
        register_widget( 'Nictitate_Toolkit_II_Widget_Contact_Info' );
    }

    public function __construct() {
        $this->widget_cssclass    = 'nictitate_toolkit_ii_contact_info k-widget-info';
        $this->widget_description = esc_html__( 'Show contact info.', 'nictitate-lite-ii-toolkit' );
        $this->widget_id          = 'nictitate_toolkit_ii-contact-info';
        $this->widget_name        = esc_html__( '__Contact Info', 'nictitate-lite-ii-toolkit' );

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
            'fax'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Fax:', 'nictitate-lite-ii-toolkit' )
            ),
            'email'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Email:', 'nictitate-lite-ii-toolkit' )
            ),
            'address'  => array(
                'type'  => 'text',
                'std'   => '',
                'label' => esc_html__( 'Address:', 'nictitate-lite-ii-toolkit' )
            ),
            'enable_follow'  => array(
                'type'  => 'checkbox',
                'std'   => 1,
                'label' => esc_html__( 'Show social follow:', 'nictitate-lite-ii-toolkit' ),
                'desc'  => wp_kses_post('Setting in <code>Theme Options -> Social Share</code>', 'nictitate-lite-ii-toolkit')
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
        
        if ( $title ) {
            echo wp_kses_post( $before_title . $title .$after_title );
        }    
        ?>
            <div class="widget-content">
                <?php if ( ! empty( $phone ) || ! empty( $fax ) || ! empty( $email ) || ! empty( $address ) ) : ?>
                    <ul class="list-info list-unstyled">
                        <?php if ( ! empty( $phone ) ) : ?>
                            <li><i class="fa fa-phone"></i> <?php echo esc_html( $phone ); ?></li>
                        <?php endif; ?>
                        <?php if ( ! empty( $fax ) ) : ?>
                            <li><i class="fa fa-print"></i> <?php echo esc_html( $fax ); ?></li>
                        <?php endif; ?>
                        <?php if ( ! empty( $email ) ) : ?>
                            <li><i class="fa fa-envelope-o"></i> <?php echo esc_html( $email ); ?></li>
                        <?php endif; ?>
                        <?php if ( ! empty( $address ) ): ?>
                            <li><i class="fa fa-map-marker"></i> <?php echo esc_html( $address ); ?></li>
                        <?php endif; ?>
                    </ul>
                <?php
                endif;
                    if ( 1 === intval( $enable_follow ) ) {
                        get_template_part('template/header/parts/social-follow');
                    }
                ?>
            </div>
        <?php 
        echo wp_kses_post( $after_widget );        
    }
}