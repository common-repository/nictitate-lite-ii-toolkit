<?php
/**
 * Plugin Name: Nictitate Lite II Toolkit
 * Description: A specific plugin use in Nictitate Lite II Theme to help you register post types, widgets and shortcodes.
 * Version: 1.0.2
 * Author: Kopatheme
 * Author URI: http://kopatheme.com
 * License: GNU General Public License v3 or later
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * Nictitate Lite II Toolkit plugin, Copyright 2016 Kopatheme.com
 * Nictitate Lite II Toolkit is distributed under the terms of the GNU GPL
 *
 * Requires at least: 4.4
 * Tested up to: 4.4.2
 * Text Domain: nictitate-lite-ii-toolkit
 * Domain Path: /languages/
 *
 * @package Nictitate Lite II
 * @subpackage Nictitate Lite II Toolkit
 */

define( 'NICTITATE_LITE_II_TOOLKIT_DIR', plugin_dir_url( __FILE__ ) );
define( 'NICTITATE_LITE_II_TOOLKIT_PATH', plugin_dir_path( __FILE__ ) );

add_action( 'plugins_loaded', array( 'Nictitate_Lite_II_Toolkit', 'plugins_loaded' ) );	
add_action( 'after_setup_theme', array( 'Nictitate_Lite_II_Toolkit', 'after_setup_theme' ), 25 );	

class Nictitate_Lite_II_Toolkit {

	function __construct(){		
		
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 15 );
		add_action( 'nictitate_lite_ii_share_post', 'nictitate_lite_ii_toolkit_single_share_post' );
		add_filter( 'excerpt_more', '__return_null' );

		if ( is_admin() ) {
			add_filter( 'user_contactmethods', array( 'Nictitate_Lite_II_Toolkit', 'add_user_socials' ) );
		} else {
			add_filter( 'widget_text', 'do_shortcode' );
			add_action( 'nictitate_print_single_post_author', 'nictitate_lite_ii_toolkit_print_single_post_author' );
		}

		# UTILITY.
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/utility.php';

		# METABOX-FIELD.
		require_once NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/fields/metabox/post.php';	
		require_once NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/fields/metabox/meta-like.php';	

		# POSTTYPES.
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/service/service.php';
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/portfolio/portfolio.php';
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/client/client.php';
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/testimonial/testimonial.php';
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/staff/staff.php';
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/post/post.php';
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/contact/contact.php';
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/slides/slide.php';
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/post-types/skill/skill.php';

		# WIDGETS.
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/widgets/about-site.php';
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/widgets/flickr.php';
		require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/widgets/recent-comment.php';
        require NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/widgets/tagline.php';

		# SHORTCODES.
		require_once( NICTITATE_LITE_II_TOOLKIT_PATH . 'inc/shortcode-util.php' );
		
		$nictitate_lite_ii_toolkit_dirs = 'inc/shortcodes/';

		$path  = NICTITATE_LITE_II_TOOLKIT_PATH . $nictitate_lite_ii_toolkit_dirs . '*.php';
		$files = glob( $path );

		if ( $files ) {
		    foreach ( $files as $file ) {
		        require_once $file;
		    }
		}		

	}

	public static function admin_enqueue_scripts() {
		global $pagenow;
		
		if ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'widgets.php' ) ) ) {
			wp_enqueue_style( 'kopa_font_awesome' );
			wp_enqueue_style( 'nictitate-lite-toolkit-metabox', plugins_url( "assets/css/metabox.css", __FILE__ ), NULL, NULL );
		} elseif ( in_array( $pagenow, array( 'edit.php' ) ) ) {
			wp_enqueue_style( 'nictitate-lite-ii-toolkit-manage-colums', plugins_url( "assets/css/manage-colums.css", __FILE__ ), NULL, NULL );		
		}
	}

	public static function plugins_loaded() {
		load_plugin_textdomain( 'nictitate-lite-ii-toolkit', false, NICTITATE_LITE_II_TOOLKIT_PATH . '/languages/' );
	}

	public static function after_setup_theme() {
		if ( ! class_exists( 'Kopa_Framework' ) )
			return; 		
		else	
			new Nictitate_Lite_II_Toolkit();							
	}

	public static function add_user_socials( $methods ) {
		$methods['facebook']    = esc_html__( 'Facebook', 'nictitate-lite-ii-toolkit' );
		$methods['twitter']     = esc_html__( 'Twitter', 'nictitate-lite-ii-toolkit' );
		$methods['rss'] 		= esc_html__( 'Rss', 'nictitate-lite-ii-toolkit' );
		$methods['pinterest']   = esc_html__( 'Pinterest', 'nictitate-lite-ii-toolkit' );
		$methods['google_plus'] = esc_html__( 'Google Plus', 'nictitate-lite-ii-toolkit' );
        
		return $methods;
	}
}