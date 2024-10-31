<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_button');


function nictitate_toolkit_ii_register_elements_button($groups){
    $groups['button'][] = array(
        'name' => esc_html__('Button','nictitate-lite-ii-toolkit'),
        'code' => '[button style="1" href="#" target="_blank" ]Button[/button]'
        );
    return $groups;
}

add_shortcode('button', 'nictitate_toolkit_ii_shortcode_button');

function nictitate_toolkit_ii_shortcode_button($atts, $content = null){
    extract(shortcode_atts(array(
        'style' => 1,
        'href' => '',
        'target' => '_blank',
        
        ), $atts));
    
    
    $classes = apply_filters('nictitate_toolkit_ii_button_classes',array('read-more'));
    switch((int)$atts['style']){
        case 1:
            $classes[] = 'read-more-border read-more-arrow';
            break;
        case 2:
            $classes[] = '';
            break;
        case 3:
            $classes[] = 'read-more-border';
            break;
        default:
            $classes[] = 'read-more-border read-more-arrow';
            break;
    }
    
    ob_start();
    ?>
    <a href="<?php echo esc_attr($atts['href']); ?>" class="<?php echo esc_attr(implode(' ', $classes)); ?>" target="<?php echo esc_attr($atts['target']); ?>"><?php echo esc_html($content); ?></a>
    <?php
    $string = ob_get_contents();
    ob_end_clean();
    
    return apply_filters( 'nictitate_toolkit_ii_buttons', $string, $atts, $content );
}