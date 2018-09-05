<?php
/**
 * Template Name: Fullwidth Template
 *
 * The template for the full-width page.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

if ( class_exists( 'Niztech_Youtube' ) ) {
	require_once( WP_PLUGIN_DIR . '/niztech-youtube/Niztech_Youtube_Client.class.php' );
}

get_header();

/**
 * Don't display page header if header layout is set as classic blog.
 */
do_action( 'hestia_before_single_page_wrapper' ); ?>

<div class="<?php echo hestia_layout(); ?>">
    <div class="blog-post <?php echo esc_attr( $class_to_add ); ?>">
        <div class="container">

			<?php
			if ( class_exists( 'Niztech_Youtube_Client' ) ) {
				$video_data = Niztech_Youtube_Client::video_content($post->ID);
				if ( ! empty( $video_data ) ) {
					foreach ( $video_data as $video ) {
						printf('<img src="%s" alt="%s">', $video->thumbnail_default_url, $video->title);
						printf('<a href="https://www.youtube.com/watch?v=%s">%s</a>', $video->youtube_video_code, $video->title);
					}
				}
			}
			?>

            <?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content-fullwidth', 'page' );
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
        </div>
    </div>

	<?php get_footer(); ?>
