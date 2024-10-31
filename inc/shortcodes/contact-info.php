<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_contactinfo_register_elements');


function nictitate_toolkit_ii_contactinfo_register_elements($groups){
    $groups['contact-info'][] = array(
        'name' => esc_html__('Contact Info 1','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_contact_infos title="" style="1"]<br/>[nictitate_toolkit_ii_contactinfo icon="fa fa-home"]Content 1[/nictitate_toolkit_ii_contactinfo]<br/>[nictitate_toolkit_ii_contactinfo icon="fa fa-home"]Content 2[/nictitate_toolkit_ii_contactinfo]<br/>[nictitate_toolkit_ii_contactinfo icon="fa fa-home"]Content 3[/nictitate_toolkit_ii_contactinfo]<br/>[/nictitate_toolkit_ii_contact_infos]<br/>'
        );
    $groups['contact-info'][] = array(
        'name' => esc_html__('Contact Info 2','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_contact_infos title="" style="2"]<br/>[nictitate_toolkit_ii_contactinfo icon="fa fa-home"]Content 1[/nictitate_toolkit_ii_contactinfo]<br/>[nictitate_toolkit_ii_contactinfo icon="fa fa-home"]Content 2[/nictitate_toolkit_ii_contactinfo]<br/>[nictitate_toolkit_ii_contactinfo icon="fa fa-home"]Content 3[/nictitate_toolkit_ii_contactinfo]<br/>[/nictitate_toolkit_ii_contact_infos]<br/>'
        );
    $groups['contact-info'][] = array(
        'name' => esc_html__('Contact Info 3','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_contact_infos title="" style="3"]<br/>[nictitate_toolkit_ii_contactinfo icon="fa fa-home"]Content 1[/nictitate_toolkit_ii_contactinfo]<br/>[nictitate_toolkit_ii_contactinfo icon="fa fa-home"]Content 2[/nictitate_toolkit_ii_contactinfo]<br/>[nictitate_toolkit_ii_contactinfo icon="fa fa-home"]Content 3[/nictitate_toolkit_ii_contactinfo]<br/>[/nictitate_toolkit_ii_contact_infos]<br/>'
        );
    return $groups;
}

add_shortcode('nictitate_toolkit_ii_contact_infos', 'nictitate_toolkit_ii_contactinfo_shortcode');
add_shortcode('nictitate_toolkit_ii_contactinfo', '__return_false' );

function nictitate_toolkit_ii_contactinfo_shortcode($atts, $content = null){
	extract( shortcode_atts( array(), $atts ) );

	$style_id = isset($atts['style']) ? (int)$atts['style'] : 1 ;

	$matches = nictitate_lite_ii_toolkit_extract_shortcodes( $content, true, array( 'nictitate_toolkit_ii_contactinfo' ) );

	$title = isset($atts['title']) ? $atts['title']: '' ;

	$widget_class = '';
	switch($style_id){
		case 1:
			$widget_class='k-widget-info';
			break;
		case 2:
			$widget_class='k-widget-info-2';
			break;
		default:
			$widget_class='k-widget-info-3';
			break;
	}

	ob_start();

	?>
	<div class="widget <?php echo esc_attr($widget_class); ?>">
		<?php if($title){ ?>
    	<h3 class="widget-title"><?php echo wp_kses_post($title); ?></h3>
    	<?php } ?>
    	<?php if(count($matches) > 0 ){ ?>
    	<ul class="list-item list-unstyled">
			<?php for($i = 0; $i < count( $matches ); $i++){ ?>
			<li class="item">
				<?php if($matches[$i]['atts']['icon']){ ?>
				<i class="icon <?php echo esc_attr($matches[$i]['atts']['icon']); ?>"></i>
				<?php } ?>
				
				<?php echo do_shortcode($matches[$i]['content']); ?>
				
			</li>	    				
			<?php } ?>		        
		</ul>					
    	<?php } ?>
    	<?php echo do_action('nictitate_toolkit_ii_shortcode_contactinfo_after_list', $atts); ?>	
    </div>
	<?php

	$string = ob_get_contents();
	ob_end_clean();

	return apply_filters( 'nictitate_toolkit_ii_contactinfo_shortcode', $string, $atts, $content );
}