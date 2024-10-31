<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_iconbox_style3');

function nictitate_toolkit_ii_register_elements_iconbox_style3($groups){
    $groups['iconbox'][] = array(
        'name' => esc_html__('Icon box 3','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_iconbox style="3" icon="fa fa-picture-o" title=""]Content[/nictitate_toolkit_ii_iconbox]'
        );
    return $groups;
}

add_filter('nictitate_toolkit_ii_shortcode_iconbox_classes', 'nictitate_toolkit_ii_shortcode_iconbox_style3',10 ,2 );

function nictitate_toolkit_ii_shortcode_iconbox_style3( $tab_classes, $style_id){
    
    if(3 === $style_id ){
        $tab_classes = 'style-3';
    }
    
    return $tab_classes;
}


add_action('nictitate_toolkit_ii_iconbox_shortcode', 'nictitate_toolkit_ii_display_iconbox_style3', 10, 3);
function nictitate_toolkit_ii_display_iconbox_style3($atts, $style_id, $content){
    extract( shortcode_atts( array('style'=> 3, 'icon' => ''), $atts ) );
    if(3 === (int)$style_id){
        if($atts['icon']){
            ?>
            <i class="icon <?php echo esc_attr($atts['icon']); ?>"></i>
            <?php
        }
        if($atts['title']){
            ?>
            <h3><?php echo wp_kses_post($atts['title']); ?></h3>
            <?php
        } 
        echo '<p>'.do_shortcode($content).'</p>';
    }
}
