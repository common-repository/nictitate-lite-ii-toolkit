<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_accordion_style2');

function nictitate_toolkit_ii_register_elements_accordion_style2($groups){
	$groups['accordions'][] = array(
		'name' => esc_html__('Accordion 2','nictitate-lite-ii-toolkit'),
		'code' => '[accordions style="2" is_toggle="0"]<br/>[accordion title="Accordion title 1" icon="fa fa-area-chart"]Accordion content 1[/accordion]<br/>[accordion title="Accordion title 2" icon="fa fa-edit"]Accordion content 2[/accordion]<br/>[accordion title="Accordion title 3" icon="fa fa-rocket"]Accordion content 3[/accordion]<br/>[/accordions]'
		);
	return $groups;
}


add_filter('nictitate_toolkit_ii_shortcode_accordions_classes', 'nictitate_toolkit_ii_shortcode_accordions_style2',10 ,2 );

function nictitate_toolkit_ii_shortcode_accordions_style2( $tab_classes, $style_id){
	
	if(2 === $style_id ){
		$tab_classes = 'style-2';
	}
	
	return $tab_classes;
}



