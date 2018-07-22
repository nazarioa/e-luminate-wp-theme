<?php
/**
 * Created by PhpStorm.
 * User: nazario
 * Date: 5/28/18
 * Time: 4:00 PM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! isset( $content_width ) ) {
	$content_width = 1024;
}

if ( ! function_exists( 'hestia_child_eluminate_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Hestia Child Eluminate 1.0
	 */
	function hestia_child_eluminate_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen
		 * If you're building a theme based on twentyfifteen, use a find and replace
		 * to change 'twentyfifteen' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'eluminate-child' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
	}

	add_theme_support( 'title-tag' );
}

if ( ! function_exists( 'hestia_child_eluminate_parent_css' ) ) {
	function hestia_child_eluminate_parent_css() {
		wp_enqueue_style( 'hestia_child_parent', trailingslashit( get_template_directory_uri() ) . 'style.css',
			array( 'bootstrap' ) );
		if ( is_rtl() ) {
			wp_enqueue_style( 'hestia_child_parent_rtl',
				trailingslashit( get_template_directory_uri() ) . 'style-rtl.css', array( 'bootstrap' ) );
		}
	}

	add_action( 'wp_enqueue_scripts', 'hestia_child_eluminate_parent_css', 2 );
}

/**
 * Import options from the parent theme
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hestia_child_get_parent_options' ) ) {
	function hestia_child_get_parent_options() {
		$hestia_mods = get_option( 'theme_mods_hestia-pro' );
		if ( ! empty( $hestia_mods ) ) {
			foreach ( $hestia_mods as $hestia_mod_k => $hestia_mod_v ) {
				set_theme_mod( $hestia_mod_k, $hestia_mod_v );
			}
		}
	}

	add_action( 'after_switch_theme', 'hestia_child_get_parent_options' );
}

if ( ! function_exists( 'hestia_child_plugin_function_name' ) ) {

	/**
	 * This forces `video_series` pages to use the video_series-template-fullwidth
	 *
	 * @param $single_template
	 *
	 * @return string
	 */
	function hestia_child_plugin_function_name( $single_template ) {
		global $post;
		// use a custom template only when needed
		if ( 'video_series' === $post->post_type ) {
			$single_template = dirname( __FILE__ ) . '/templates/video_series-template-fullwidth.php';
		}

		return $single_template;
	}

	add_filter( 'single_template', 'hestia_child_plugin_function_name' );
}
