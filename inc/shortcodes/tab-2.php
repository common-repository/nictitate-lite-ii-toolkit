<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_tabs_style2');


function nictitate_toolkit_ii_register_elements_tabs_style2($groups){
	$groups['tabs'][] = array(
		'name' => esc_html__('Tab 2','nictitate-lite-ii-toolkit'),
		'code' => '[tabs style="2"]<br/>[tab title="Tab title 1"]Tab Content 1[/tab]<br/>[tab title="Tab title 2"]Tab Content 2[/tab]<br/>[tab title="Tab title 3"]Tab Content 3[/tab]<br/>[/tabs]'
		);
	return $groups;
}

add_filter('nictitate_toolkit_ii_shortcode_tabs_classes', 'nictitate_toolkit_ii_shortcode_tabs_style2',10 ,2 );

function nictitate_toolkit_ii_shortcode_tabs_style2( $tab_classes, $style_id){
	
	if(2 === $style_id ){
		$tab_classes = 'style-2';
	}
	
	return $tab_classes;
}