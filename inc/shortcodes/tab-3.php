<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_tabs_style3');


function nictitate_toolkit_ii_register_elements_tabs_style3($groups){
	$groups['tabs'][] = array(
		'name' => esc_html__('Tab 3','nictitate-lite-ii-toolkit'),
		'code' => '[tabs style="3"]<br/>[tab title="Tab title 1" title_icon="fa fa-home"]Tab Content 1[/tab]<br/>[tab title="Tab title 2" title_icon="fa fa-home"]Tab Content 2[/tab]<br/>[tab title="Tab title 3" title_icon="fa fa-home"]Tab Content 3[/tab]<br/>[/tabs]'
		);
	return $groups;
}

add_filter('nictitate_toolkit_ii_shortcode_tabs_classes', 'nictitate_toolkit_ii_shortcode_tabs_style3',10 ,2 );

function nictitate_toolkit_ii_shortcode_tabs_style3( $tab_classes, $style_id){
	
	if(3 === $style_id ){
		$tab_classes = 'style-3';
	}
	
	return $tab_classes;
}
