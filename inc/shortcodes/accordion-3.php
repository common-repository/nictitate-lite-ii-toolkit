<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_accordion_style3');

function nictitate_toolkit_ii_register_elements_accordion_style3($groups){
	$groups['accordions'][] = array(
		'name' => esc_html__('Accordion 3','nictitate-lite-ii-toolkit'),
		'code' => '[accordions style="3" is_toggle="0"]<br/>[accordion title="Accordion title 1"]Accordion content 1[/accordion]<br/>[accordion title="Accordion title 2"]Accordion content 2[/accordion]<br/>[accordion title="Accordion title 3"]Accordion content 3[/accordion]<br/>[/accordions]'
		);
	return $groups;
}


add_filter('nictitate_toolkit_ii_shortcode_accordions_classes', 'nictitate_toolkit_ii_shortcode_accordions_style3',10 ,2 );

function nictitate_toolkit_ii_shortcode_accordions_style3( $tab_classes, $style_id){
	
	if(3 === $style_id ){
		$tab_classes = 'style-3';
	}
	
	return $tab_classes;
}



