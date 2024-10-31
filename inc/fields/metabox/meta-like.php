<?php
if ( is_admin() ) {
} else {
	add_action( 'wp_enqueue_scripts', 'nictitate_lite_ii_toolkit_meta_like_enqueue_scripts' );
	add_action( 'nictitate_singular_print_meta_likes', 'nictitate_lite_ii_toolkit_singular_print_meta_likes', 10, 3 );
}

function nictitate_lite_ii_toolkit_meta_like_enqueue_scripts() {
	wp_enqueue_script( 'nictitate-lite-toolkit-ii-like-script', NICTITATE_LITE_II_TOOLKIT_DIR . 'assets/js/meta-like.js', array( 'jquery' ), null, true );
	wp_localize_script('nictitate-lite-toolkit-ii-like-script', 'nictitate_lite_ii_toolkit_meta_likes', array(
		'ajax' => array(
		'url' => array(
		'meta_like' => wp_nonce_url( admin_url( 'admin-ajax.php' ), 'nictitate_lite_ii_toolkit_meta_like', 'security' ),
		),
		),
	));
}

function nictitate_lite_ii_toolkit_singular_print_meta_likes( $post_id, $is_clickable, $classes ) {
	$is_liked = (int) nictitate_lite_ii_toolkit_is_liked( $post_id );
	$status   = $is_liked ? 'disable' : ' enable';
	$likes    = (int) nictitate_lite_ii_toolkit_get_likes( $post_id );
	$tag      = $is_clickable ? 'a' : 'span';
	$href     = $is_clickable ? 'href="#"' : '';
	$show_likes = (int) get_theme_mod ( 'single_likes', '1' );
	if( 1 == $show_likes ):
	?>
    <<?php echo esc_attr( $tag ); ?>
        <?php echo esc_attr( $href ); ?>
        class="<?php echo esc_attr( $classes ); ?> item-metadata-2-like"
        data-status="<?php echo esc_attr( $status ); ?>" 
        data-post-id="<?php echo esc_attr( $post_id ); ?>">   
        <i class="fa fa-heart-o"></i>
        <span><?php echo esc_attr( $likes ); ?></span>
    </<?php echo esc_attr( $tag ); ?>>
    <?php
    endif;
}

add_action( 'wp_ajax_nictitate_lite_ii_toolkit_meta_like', 'nictitate_lite_ii_toolkit_meta_like' );
add_action( 'wp_ajax_nopriv_nictitate_lite_ii_toolkit_meta_like', 'nictitate_lite_ii_toolkit_meta_like' );

function nictitate_lite_ii_toolkit_meta_like() {

	check_ajax_referer( 'nictitate_lite_ii_toolkit_meta_like', 'security' );

	if ( ! empty( $_POST['post_id'] ) ) {
		$result     = array( 'status' => 'disable', 'total' => 0 );
		$post_id    = (int) $_POST['post_id'];
		$status     = isset( $_POST['status'] ) ? 'enable' : 'disable';
		$public_key = 'nictitate_likes';
		$single_key = sprintf( 'nictitate_like_by_%s', nictitate_lite_ii_toolkit_get_client_ip() );
		$total      = nictitate_lite_ii_toolkit_get_likes( $post_id );
		$is_liked   = nictitate_lite_ii_toolkit_is_liked( $post_id );

		if ( ('enable' == $status) && ( ! $is_liked) ) {
			$total++;
			update_post_meta( $post_id, $single_key, 1 );
			update_post_meta( $post_id, $public_key, abs( $total ) );
			$result['status'] = 'disable';
		} else {
			$total--;
			delete_post_meta( $post_id, $single_key );
			update_post_meta( $post_id, $public_key, abs( $total ) );
			$result['status'] = 'enable';
		}

		$result['total'] = (int) $total;

		echo json_encode( $result );
	}

	exit();
}