<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_caption_register_elements');


function nictitate_toolkit_ii_caption_register_elements($groups){
	$groups['captions'][] = array(
		'name' => esc_html__('Captions 1','nictitate-lite-ii-toolkit'),
		'code' => '[nictitate_toolkit_ii_captions style="1"]Content[/nictitate_toolkit_ii_captions]'
		);
	$groups['captions'][] = array(
		'name' => esc_html__('Captions 2','nictitate-lite-ii-toolkit'),
		'code' => '[nictitate_toolkit_ii_captions style="2"]Content[/nictitate_toolkit_ii_captions]'
		);
	return $groups;
}

add_shortcode( 'nictitate_toolkit_ii_captions', 'nictitate_toolkit_ii_caption_shortcode' );

function nictitate_toolkit_ii_caption_shortcode( $atts, $content ) {
	
	extract( shortcode_atts( array('style' => 1), $atts ) );

	$style_id = isset($atts['style']) ? (int)$atts['style'] : 0 ; 
    
    
	$string = '';
	if(1 === (int) $style_id){
		$string .= '<h4 class="box-title">'.$content.'</h4>';
	} else {
		$string .= '<h3 class="widget-title">'.$content.'</h3>';
	}
	
	

	return apply_filters( 'nictitate_toolkit_ii_shortcode_captions', $string, $atts, $content );
}
