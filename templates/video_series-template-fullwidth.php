<?php
/**
 * Template Name: Video Series Template Full Width
 * Template Post Type: video_series
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
		<?php
		if ( class_exists( 'Niztech_Youtube_Client' ) ) {
			$video_data = Niztech_Youtube_Client::video_content($post->ID);
			if ( ! empty( $video_data ) ) {
				foreach ( $video_data as $video ) {
					print('<div class="video-entry">');
					printf('<h4 class="title" >%s</h4>', $video->title);
					$img_url = $video->thumbnail_maxres_url ?? $video->thumbnail_standard_url ?? $video->thumbnail_default_url ?? null;
					if($img_url) {
						printf('<iframe class="video-iframe" src="https://www.youtube.com/embed/%s" frameborder="0" allowfullscreen></iframe>', $video->youtube_video_code);
					}
					printf('<div class="description"><p>%s</p></div>', $video->description);
					printf('<ul class="share"><li class="youtube"><a href="https://www.youtube.com/watch?v=%s"><img class="youtube-icon" src="' . get_stylesheet_directory_uri() . '/assets/img/play.svg" alt=""/>%s</a></li></ul>', $video->youtube_video_code, _('View on YouTube'));
					print('</div>');
				}
			}
		}
		?>
	</div>
</div>

<?php get_footer(); ?>
