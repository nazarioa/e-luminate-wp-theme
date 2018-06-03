<?php
/**
 * Created by PhpStorm.
 * User: nazario
 * Date: 5/28/18
 * Time: 4:00 PM
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! isset( $content_width ) ) {
	$content_width = 1024;
}

if ( ! function_exists( 'hestia_child_eluminate_setup' ) ) :
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
		add_theme_support( 'title-tag' );
	}
endif;
