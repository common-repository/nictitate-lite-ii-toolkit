<?php

add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_blockquote');

function nictitate_toolkit_ii_register_elements_blockquote($groups){
    $groups['blockquote'][] = array(
        'name' => esc_html__('Blockquote 1','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_blockquote style="1" author=""]Blockquote Content[/nictitate_toolkit_ii_blockquote]'
        );
    return $groups;
}

add_shortcode('nictitate_toolkit_ii_blockquote', 'nictitate_toolkit_ii_blockquote');

function nictitate_toolkit_ii_blockquote($atts, $content = null) {
    
    extract( shortcode_atts( array('style'=> 1, 'author' => ''), $atts ) );
    $style_id = isset($atts['style']) ? (int)$atts['style'] : 0 ; 

    $tab_classes = apply_filters('nictitate_toolkit_ii_shortcode_blockquote_classes', 'style-1', $style_id );

    $html = '';

    $inline_css = '';
    if(!empty($atts['background_image'])){
        $inline_css = 'style="background-image:url('.$atts['background_image'].'); background-image-repeat:no-repeat;"';
    }

    if (!empty($content)) {
        $html .= '<blockquote class="k-blockquote '.$tab_classes.'" '.$inline_css.'>';
        if(!empty($atts['background_image'])){
            $html .= '<span class="nictitate_toolkit_ii_bg_custom"><span>';
        }
        $html .= '<p>'. $content . '</p>';
        if(isset($atts['author'])){
            $html .= ( 3 == (int)$style_id ) ? '<p class="text-right">' : '';
            $html .= '<small>'. $atts['author'] . '</small>';
            $html .= ( 3 == (int)$style_id ) ? '</p>' : '';
        }
        $html .= '</blockquote>';
    }

    return apply_filters('nictitate_toolkit_ii_blockquote', force_balance_tags($html), $atts, $content);
}
