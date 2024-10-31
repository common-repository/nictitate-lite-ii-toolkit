<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_list_icon');


function nictitate_toolkit_ii_register_elements_list_icon($groups){
	$groups['list'][] = array(
		'name' => esc_html__('List 1','nictitate-lite-ii-toolkit'),
		'code' => '[nictitate_toolkit_ii_lists]<br/>[nictitate_toolkit_ii_list icon_class="fa fa-angle-double-right"]Content 1[/nictitate_toolkit_ii_list]<br/>[nictitate_toolkit_ii_list icon_class="fa fa-angle-double-right"]Content 2[/nictitate_toolkit_ii_list]<br/>[nictitate_toolkit_ii_list icon_class="fa fa-angle-double-right"]Content 3[/nictitate_toolkit_ii_list]<br/>[/nictitate_toolkit_ii_lists]'
		);
	return $groups;
}


add_shortcode( 'nictitate_toolkit_ii_lists', 'nictitate_toolkit_ii_shortcode_lists' );
add_shortcode('nictitate_toolkit_ii_list', '__return_false');

function nictitate_toolkit_ii_shortcode_lists( $atts, $content ) {
	
	extract( shortcode_atts( array(), $atts ) );

	$matches = nictitate_lite_ii_toolkit_extract_shortcodes( $content, true, array( 'nictitate_toolkit_ii_list' ) );

	ob_start();
	?>

		<ul class="k-list list-unstyled">
			<?php 
			for ( $i = 0; $i < count( $matches ); $i++ ) {
				?>
				<li>
					<?php if(isset($matches[$i]['atts']['icon_class'])){
						?>
						<i class="<?php echo esc_attr($matches[$i]['atts']['icon_class']); ?>"></i>
						<?php
					}
					echo '<span>' .do_shortcode($matches[$i]['content']) . '</span>'; 
					?>
				</li>
				<?php
			}
			?>
        </ul>

	<?php

	$string = ob_get_contents();
	ob_end_clean();

	return apply_filters( 'nictitate_toolkit_ii_shortcode_lists', $string, $atts, $content );
}




