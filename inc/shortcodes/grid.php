<?php
add_filter('nictitate_lite_ii_toolkit_get_elements', 'nictitate_toolkit_ii_register_elements_grid');

function nictitate_toolkit_ii_register_elements_grid($groups){
    
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 100%','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=12]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 50% x2','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=6]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=6]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 33% x3','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=4]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=4]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=4]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 33% - 66%','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=4]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=8]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 25% - 50% - 25%','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=3]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=6]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=3]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 25% x4','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=3]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=3]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=3]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=3]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 25% - 75%','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=3]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=9]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 16.6% - 66.6% - 16.6%','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=8]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 16.6% - 16.6% - 16.6% - 50%','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=6]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 16.6% x6','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 66% - 33%','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=8]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=4]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    $groups['grid'][] = array(
        'name' => esc_html__('Grid 83.3% - 16.6%','nictitate-lite-ii-toolkit'),
        'code' => '[nictitate_toolkit_ii_grid_row]<br/>[nictitate_toolkit_ii_grid_col col=10]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[nictitate_toolkit_ii_grid_col col=2]TEXT[/nictitate_toolkit_ii_grid_col]<br/>[/nictitate_toolkit_ii_grid_row]<br/>'
        );
    return $groups;
}


add_shortcode( 'nictitate_toolkit_ii_grid_row', 'nictitate_toolkit_ii_shortcode_grid_row' );
add_shortcode( 'nictitate_toolkit_ii_grid_col', '__return_false' );

function nictitate_toolkit_ii_shortcode_grid_row( $atts, $content = null ) {
    extract( shortcode_atts( array(), $atts ) );

    $cols   = nictitate_lite_ii_toolkit_extract_shortcodes( $content, true, array( 'nictitate_toolkit_ii_grid_col' ) );
    
    $output = '<div class="row">';

    if ($cols) {
        foreach ($cols as $col) {
            $output .= sprintf( '<div class="col-xs-12 col-md-%s col-sm-%s"><p>%s</p></div>', (int)$col['atts']['col'], (int)$col['atts']['col'], do_shortcode( $col['content'] ) );
        }
    }

    $output .= '</div>';

    return apply_filters( 'nictitate_toolkit_ii_shortcode_grid_row', $output, $atts, $content );
}
