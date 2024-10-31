<?php

add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_blockquote_style2');

function nictitate_toolkit_ii_register_elements_blockquote_style2($groups){
    $groups['blockquote'][] = array(
        'name' => esc_html__('Blockquote 2','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_blockquote style="2" author=""]Blockquote Content[/nictitate_toolkit_ii_blockquote]'
        );
    return $groups;
}

add_filter('nictitate_toolkit_ii_shortcode_blockquote_classes', 'nictitate_toolkit_ii_shortcode_blockquote_style2',10 ,2 );

function nictitate_toolkit_ii_shortcode_blockquote_style2( $tab_classes, $style_id){
    
    if(2 === (int)$style_id ){
        $tab_classes = 'style-2';
    }
    
    return $tab_classes;
}

