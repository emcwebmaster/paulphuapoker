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
 * Template Name: Homepage
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section id="home" class="container-fluid">
				<?php if ( get_field( 'hero_image' ) ) { ?>
					<img src="<?php the_field( 'hero_image' ); ?>" id="hero-image"/>
				<?php } ?>
				<div id="header-container">
					<div id="header-text" class="container">
						<p><?php the_field( 'header_text' ); ?></p>
						<h1 class="animated bounceInLeft delay-1s"><?php the_field( 'header_1' ); ?></h1>
						<h2 class="animated fadeInUp delay-2s"><?php the_field( 'tagline' ); ?></h2>
					</div>
				</div>
				<div id="featured-video" class="container-fluid">
					<div id="video-wrapper" class="container">
						<?php if ( have_rows( 'video_wrapper' ) ): ?>
							<?php while ( have_rows( 'video_wrapper' ) ) : the_row(); ?>
								<?php if ( get_row_layout() == 'video_wrapper' ) : ?>
									<?php the_sub_field( 'featured_video' ); ?>
									<div class="featured-video-title-bar">
										<?php the_sub_field( 'featured_video_title' ); ?>
										<a href="/learn">Watch More Videos</a>
									</div>
								<?php endif; ?>
							<?php endwhile; ?>
						<?php else: ?>
							<?php // no layouts found ?>
						<?php endif; ?>
					</div>
				</div>
			</section>
			
			<section id="video-series" class="container-fluid">
				<div id="video-series-container" class="container">
					<div class="title-container">
						<h2>Get Into The Mindset of High Stakes Poker Players</h2>
					</div>
					<?php if ( have_rows( 'video_series' ) ): ?>
						<?php while ( have_rows( 'video_series' ) ) : the_row(); ?>
							<?php if ( get_row_layout() == 'video_series' ) : ?>
								<p id="writeup"><?php the_sub_field( 'video_series_write_up' ); ?></p>
								<?php if ( have_rows( 'video_repeater' ) ) : ?>
									<div class="video-item-wrapper">
										<?php while ( have_rows( 'video_repeater' ) ) : the_row(); ?>
											<div class="video-item">
												<?php the_sub_field( 'video' ); ?>
												<?php $video_title = get_sub_field('video_title'); ?>
												<?php if($video_title) { ?> 
													<div class="video-item-title">
														<?php $vtitle = get_sub_field( 'video_title' ); 
														$getlength = strlen($vtitle);
														$thelength = 50;
														echo substr($vtitle, 0 , $thelength);
														if ($getlength > $thelength) echo "...";
														?>
													</div>
												<?php } ?>
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
					<div class="cta-container">
						<a href="/learn/" class="hvr-float-shadow">Learn More</a>
					</div>
				</div>
			</section>

			<section id="high-stakes" class="container">
				<div class="high-stakes-pages">
					<?php if ( have_rows( 'high_stakes_pages' ) ) : ?>
						<?php while ( have_rows( 'high_stakes_pages' ) ) : the_row(); ?>
							<?php $high_stakes_page = get_sub_field( 'high_stakes_page' ); ?>
							<?php if ( $high_stakes_page ) { ?>
								<a href="<?php echo $high_stakes_page['url']; ?>" target="<?php echo $high_stakes_page['target']; ?>" class="hvr-sweep-to-right">
								<p class="hs-pages"><?php the_sub_field( 'high_stakes_page_title' ); ?></p>
								<?php if ( get_sub_field( 'high_stakes_page_icon' ) ) { ?>
									<img src="<?php the_sub_field( 'high_stakes_page_icon' ); ?>" alt="Paul Phua Poker Icons"/>
								<?php } ?>
								</a>
							<?php } ?>
							
						<?php endwhile; ?>
					<?php else : ?>
						<?php // no rows found ?>
					<?php endif; ?>
				</div>
			</section>

			<section id="headlines" class="container-fluid">
				<div id="headlines-wrapper" class="container">
					<h2><?php the_field( 'headlines_header' ); ?></h2>
					<div class="headlines-container">
						<?php $headlines = get_field( 'headlines' ); ?>
							<?php if ( $headlines ): ?>
								<?php foreach ( $headlines as $post ):  
									$thumb_url = srcset_post_thumbnail($medium)?>
									<?php setup_postdata ( $post ); ?>
										<div class="headline-item hvr-bubble-float-bottom">
											<a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb_url; ?>" alt="<?php the_title(); ?>"></a>

											<a href="<?php the_permalink() ?>" class="headline-title">
												<p>
													<?php
													$thetitle = $post->post_title; /* or you can use get_the_title() */
													$getlength = strlen($thetitle);
													$thelength = 75;
													echo substr($thetitle, 0, $thelength);
													if ($getlength > $thelength) echo "...";
													?>
												</p>
											</a>

										</div>
								<?php endforeach; ?>
							<?php wp_reset_postdata(); ?>
						<?php endif; ?>
						<div class="cta-container hvr-float-shadow">
							<a href="/articles">More HS Poker News</a>
						</div>
					</div>
				</div>
			</section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
