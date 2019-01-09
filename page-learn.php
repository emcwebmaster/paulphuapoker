<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package paulphuapoker
 * 
 * Template Name: Learn
 */

get_header();
?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main">

			<section id="featured-videos">
			<?php if ( have_rows( 'featured_videos_section' ) ): ?>
				<?php while ( have_rows( 'featured_videos_section' ) ) : the_row(); ?>
					<?php if ( get_row_layout() == 'featured_videos_section' ) : ?>
						<h1><?php the_sub_field( 'fv_header' ); ?></h1>
						<p><?php the_sub_field( 'fv_info' ); ?></p>
						<?php if ( have_rows( 'fv_items' ) ) : ?>
							<div id="featured-videos-wrapper">
								<?php while ( have_rows( 'fv_items' ) ) : the_row(); ?>
									<div class="featured-video">
										<?php the_sub_field( 'featured_video' ); ?>
									</div>
								<?php endwhile; ?>
							</div>
						<?php else : ?>
							<?php // no rows found ?>
						<?php endif; ?>
					<?php endif; ?>
				<?php endwhile; ?>
			<?php else: ?>
				<?php // no layouts found ?>
			<?php endif; ?>
			</section>

			<?php if ( have_rows( 'video_series_section' ) ) : ?>
				<?php while ( have_rows( 'video_series_section' ) ) : the_row(); ?>
					<section class="video-series">
						<h2><?php the_sub_field( 'series_title' ); ?></h2>
						<p><?php the_sub_field( 'series_info' ); ?></p>
						<?php if ( have_rows( 'series_video_items' ) ) : ?>
							<div class="video-items-wrapper">
							<?php while ( have_rows( 'series_video_items' ) ) : the_row(); ?>
								<div class="video-item">
									<?php the_sub_field( 'video' ); ?>
								</div>
							<?php endwhile; ?>
							</div>
						<?php else : ?>
							<?php // no rows found ?>
						<?php endif; ?>
						<?php $series_youtube_playlist_link = get_sub_field( 'series_youtube_playlist_link' ); ?>
						<?php if ( $series_youtube_playlist_link ) { ?>
							<a href="<?php echo $series_youtube_playlist_link['url']; ?>" target="<?php echo $series_youtube_playlist_link['target']; ?>" class="more-cta hvr-float-shadow"><?php echo $series_youtube_playlist_link['title']; ?></a>
						<?php } ?>
					</section>
				<?php endwhile; ?>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
