<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_dropcaps_style2');


function nictitate_toolkit_ii_register_elements_dropcaps_style2($groups){
	$groups['dropcaps'][] = array(
		'name' => esc_html__('Dropcaps 2','nictitate-lite-ii-toolkit'),
		'code' => '[dropcaps style="2"]A[/dropcaps]'
		);
	return $groups;
}
add_filter('nictitate_toolkit_ii_shortcode_dropcaps_classes', 'nictitate_toolkit_ii_shortcode_dropcaps_style2',10 ,2 );

function nictitate_toolkit_ii_shortcode_dropcaps_style2( $tab_classes, $style_id){
    
    if(2 === $style_id ){
        $tab_classes = 'style-2';
    }
    
    return $tab_classes;
}