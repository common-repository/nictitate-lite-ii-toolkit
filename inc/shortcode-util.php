<?php

add_action( 'admin_init', 'nictitate_lite_ii_toolkit_admin_init' );

function nictitate_lite_ii_toolkit_admin_init() {
	if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
		add_filter( 'mce_external_plugins', 'nictitate_lite_ii_toolkit_load_editor_plugin' );
		add_filter( 'mce_buttons', 'nictitate_lite_ii_toolkit_add_editor_button' );
	}
}

function nictitate_lite_ii_toolkit_load_editor_plugin( $plugin_array ) {
	$plugin_array['nictitate_lite_ii_toolkit_button'] = NICTITATE_LITE_II_TOOLKIT_DIR . 'assets/js/tinymce.js';
	return $plugin_array;
}

function nictitate_lite_ii_toolkit_add_editor_button( $buttons ) {
	$buttons[] = 'nictitate_lite_ii_toolkit_button';
	return $buttons;
}

add_action( 'admin_enqueue_scripts', 'nictitate_lite_ii_toolkit_admin_enqueue_scripts' );

function nictitate_lite_ii_toolkit_admin_enqueue_scripts( $hook ) {
	if ( in_array( $hook, array( 'widgets.php', 'post.php', 'post-new.php', 'edit.php' ), true ) ) {
		wp_enqueue_style( 'featherlight', NICTITATE_LITE_II_TOOLKIT_DIR . 'assets/css/featherlight.css', array(), null );
		wp_enqueue_style( 'nictitate-lite-ii-toolkit-admin-style', NICTITATE_LITE_II_TOOLKIT_DIR . 'assets/css/admin.style.css', array(), null );

		wp_enqueue_script( 'featherlight', NICTITATE_LITE_II_TOOLKIT_DIR . 'assets/js/featherlight.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'nictitate-lite-ii-toolkit-admin-script', NICTITATE_LITE_II_TOOLKIT_DIR . 'assets/js/admin.script.js', array( 'jquery' ), null, true );

		$localize_data = array(
			'ajax' => array(
				'url' => admin_url( 'admin-ajax.php' ),
				'security' => array(
					'load_elements' => wp_create_nonce( 'nictitate-lite-ii-toolkit-load-elements' ),
				),
			),
			'translate' => array(
				'nictitate_lite_ii_toolkit_elements' => esc_html__( 'Nictitate Lite Elements', 'nictitate-lite-ii-toolkit' ),
			),
			'resource' => array(
				'icon' => NICTITATE_LITE_II_TOOLKIT_DIR . 'assets/images/icon.png',
			),
		);

		wp_localize_script( 'nictitate-lite-ii-toolkit-admin-script', 'nictitate_lite_ii_toolkit_variables', $localize_data );
	}
}

add_action( 'admin_footer', 'nictitate_lite_ii_toolkit_print_elements', 15 );

function nictitate_lite_ii_toolkit_print_elements() {
	$screen = get_current_screen();
	
	if( 'post' === $screen->base ) {
		$groups = array();
		$groups = apply_filters( 'nictitate_lite_ii_toolkit_get_elements', $groups );
		if( $groups ) {
			$allowed_tags = nictitate_lite_ii_get_allowed_tags();
			?>	
			<div id="nictitate-lite-ii-toolkit-elements">
				<?php
					$is_first = true;		
					foreach ( $groups as $group_slug => $group ) : 
						$title_caret     = '+';
						$title_classes[] = 'nictitate-lite-ii-toolkit-title';					
						$grid_style      = 'display:none;';
						if ( $is_first ) {
							$is_first      = false;
							$title_caret   = '-';
							$grid_style    = '';
							$title_classes[] = 'nictitate-toolkit-other';					
						}
				?>
					<h3 class="<?php echo esc_attr( implode( $title_classes, ' ' ) ); ?>">
						<?php echo esc_attr( nictitate_lite_ii_toolkit_beautify( $group_slug ) ); ?>
						<small>(<?php echo esc_attr( count( $group ) );?>)</small>
						<span class="nictitate-lite-ii-toolkit-caret">+</span>
					</h3>
					<div style="<?php echo esc_attr( $grid_style ); ?>">
						<div class="nictitate-lite-ii-toolkit-row">
							<?php 
								$loop_index = 0;
								foreach ( $group as $element_slug => $element ) :
									if ( $loop_index && 0 === $loop_index  % 2 ) {
										echo '</div>';
										echo '<div class="nictitate-lite-ii-toolkit-row">';
									}								
							?>
								<div class="nictitate-lite-ii-toolkit-col">								
									<span class="nictitate-lite-ii-toolkit-caption" onclick="nictitate_lite_ii_toolkit_element.insert( jQuery( this ) );"><?php echo esc_attr( $element['name'] ); ?></span>
									<div class="nictitate-lite-ii-toolkit-code">
										<?php echo wp_kses( $element['code'], $allowed_tags ); ?>
									</div>
								</div>
							<?php 
							$loop_index++;
							endforeach;
							?>
						</div>
					</div>
		     	<?php endforeach; ?>
			</div>
		<?php
		}
	}
}

function nictitate_lite_ii_toolkit_extract_shortcodes( $content, $enable_multi = false, $shortcodes = array() ) {
	$codes         = array();
	$regex_matches = '';
	$regex_pattern = get_shortcode_regex();

	preg_match_all( '/' . $regex_pattern . '/s', $content, $regex_matches );

	foreach ( $regex_matches[0] as $shortcode ) {
		$regex_matches_new = '';
		preg_match( '/' . $regex_pattern . '/s', $shortcode, $regex_matches_new );

		if ( in_array( $regex_matches_new[2], $shortcodes, true ) ) :
			$codes[] = array(
				'shortcode' => $regex_matches_new[0],
				'type'      => $regex_matches_new[2],
				'content'   => $regex_matches_new[5],
				'atts'      => shortcode_parse_atts( $regex_matches_new[3] ),
			);

			if ( ! $enable_multi ) {
				break;
			}
		endif;
	}

	return $codes;
}

function nictitate_lite_ii_toolkit_beautify( $string ) {
	$string = str_replace( '-', ' ', $string );
	return ucwords( str_replace( '_', ' ', $string ) );
}