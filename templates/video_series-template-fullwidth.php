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

<style type="text/css">
	.header-filter {
		background-image: url(<?php printf('%s', $video->thumbnail_standard_url); ?>);
		background-position: center;
		background-size: cover;
	}
</style>

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
					$img_url = $video->thumbnail_maxres_url ?? $video->thumbnail_standard_url ?? $video->thumbnail_default_url ?? null;
					if($img_url) {
					    printf('<a href="http://www.youtube.com/watch?v=%s"><img class="video-thumbnail" src="%s" alt="%s"></a>', $video->youtube_video_code, $img_url, $video->title);
                    }
					printf('<a href="http://www.youtube.com/watch?v=%s"><h4 class="video-title" >%s</h4></a>', $video->youtube_video_code, $video->title);
					printf('<p class="video-description">%s</p>', $video->description);
					print('</div>');
				}
			}
		}
		?>
	</div>
</div>

<?php get_footer(); ?>
