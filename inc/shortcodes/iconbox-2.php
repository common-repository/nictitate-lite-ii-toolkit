<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_iconbox_style2');

function nictitate_toolkit_ii_register_elements_iconbox_style2($groups){
    $groups['iconbox'][] = array(
        'name' => esc_html__('Icon box 2','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_iconbox style="2" icon="fa fa-picture-o" title=""]Content[/nictitate_toolkit_ii_iconbox]'
        );
    return $groups;
}

add_filter('nictitate_toolkit_ii_shortcode_iconbox_classes', 'nictitate_toolkit_ii_shortcode_iconbox_style2',10 ,2 );

function nictitate_toolkit_ii_shortcode_iconbox_style2( $tab_classes, $style_id){
    
    if(2 === $style_id ){
        $tab_classes = 'style-2';
    }
    
    return $tab_classes;
}


add_action('nictitate_toolkit_ii_iconbox_shortcode', 'nictitate_toolkit_ii_display_iconbox_style2', 10, 3);
function nictitate_toolkit_ii_display_iconbox_style2($atts, $style_id, $content){
    extract( shortcode_atts( array('style'=> 2, 'icon' => ''), $atts ) );
    if(2 === (int)$style_id){
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
        ?>
        <div class="divider"></div>
        <?php 
        echo '<p>'.do_shortcode($content).'</p>';
    }
}
