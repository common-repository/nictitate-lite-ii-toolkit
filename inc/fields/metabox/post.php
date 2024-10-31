<?php

if ( ! class_exists( 'Kopa_Framework' ) ) {
    return;
}

add_filter( 'kopa_admin_metabox_advance_field', '__return_true' );

if ( is_admin() ) {
    add_action( 'admin_init', 'nictitate_lite_ii_toolkit_metabox_post_featured' );
    add_filter( 'kopa_admin_meta_box_field_quote', 'nictitate_lite_ii_toolkit_metabox_field_quote', 10, 5 );
}

function nictitate_lite_ii_toolkit_metabox_post_featured() {
    $post_type = array( 'post' );

    $nictitate_lite_ii_toolkit_modules_fields = array(
        array(
            'title' => esc_html__( 'Gallery:', 'nictitate-lite-ii-toolkit' ),
            'type'  => 'gallery',
            'id'    => 'nictitate_toolkit_ii_gallery',
            'desc'  => esc_html__( 'This option only apply for post-format "Gallery".', 'nictitate-lite-ii-toolkit' ),
        ),
        array(
            'title' => esc_html__( 'Quote:', 'nictitate-lite-ii-toolkit' ),
            'type'  => 'quote',
            'id'    => 'nictitate_toolkit_ii_quote',
            'desc'  => esc_html__( 'This option only apply for post-format "Quote".', 'nictitate-lite-ii-toolkit' ),
        ),
        array(
            'title' => esc_html__( 'Link to:', 'nictitate-lite-ii-toolkit' ),
            'type'  => 'text',
            'id'    => 'nictitate_toolkit_ii_linkto',
            'desc'  => esc_html__( 'This option only apply for post-format "Link".', 'nictitate-lite-ii-toolkit' ),
        ),
        array(
            'title' => esc_html__( 'Custom:', 'nictitate-lite-ii-toolkit' ),
            'type'  => 'textarea',
            'id'    => 'nictitate_toolkit_ii_custom',
            'desc'  => esc_html__( 'Enter custom content as shortcode or custom HTML, ...', 'nictitate-lite-ii-toolkit' ),
        ),        
    );
    $nictitate_lite_ii_toolkit_modules_fields = apply_filters( 'nictitate_lite_ii_toolkit_metabox_set_fields_post_featured', $nictitate_lite_ii_toolkit_modules_fields );
    $args = array(
        'id'       => 'nictitate-lite-ii-toolkit-post-options-metabox',
        'title'    => esc_html__( 'Featured content', 'nictitate-lite-ii-toolkit' ),
        'desc'     => '',
        'pages'    => $post_type,
        'context'  => 'normal',
        'priority' => 'high',
        'fields'   => $nictitate_lite_ii_toolkit_modules_fields,
    );

    kopa_register_metabox( $args );
}

function nictitate_lite_ii_toolkit_metabox_field_quote( $html, $wrap_start, $wrap_end, $field, $value ) {
    ob_start();
    $value = wp_parse_args( (array) $value, array( 'quote' => null, 'author' => null ) );
    extract( $value );
    echo $wrap_start;
    ?>  
    <div class="nictitate_toolkit_ii-clearfix">        
        <p class="nictitate_toolkit_ii-block nictitate_toolkit_ii-block-first">
            <code class="nictitate_toolkit_ii-code nictitate_toolkit_ii-pull-left"><?php esc_html_e( 'Message:', 'nictitate-lite-ii-toolkit' ); ?></code>
            <span class="nictitate_toolkit_ii-clearfix"></span>
            <textarea 
                name="<?php echo esc_attr( $field['id'] );?>[quote]" 
                id="<?php echo esc_attr( $field['id'] );?>_quote" 
                value="<?php echo esc_attr( $quote );?>" 
                autocomplete="off"
                class="large-text"/><?php echo esc_textarea( $quote ); ?></textarea>
        </p>
        <p class="nictitate_toolkit_ii-block">            
            <code class="nictitate_toolkit_ii-code nictitate_toolkit_ii-pull-left"><?php esc_html_e( 'Author:', 'nictitate-lite-ii-toolkit' ); ?></code>
            <span class="nictitate_toolkit_ii-clearfix"></span>
            <input type="text"
                name="<?php echo esc_attr( $field['id'] );?>[author]" 
                id="<?php echo esc_attr( $field['id'] );?>_author" 
                value="<?php echo esc_attr( $author );?>" 
                autocomplete="off"
                class="nictitate_toolkit_ii-pull-left medium-text"/>            
        </p>                
    </div>      
    <?php
    echo $wrap_end;
    $html = ob_get_clean();

    return $html;
}