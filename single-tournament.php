<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package paulphuapoker
 */

get_header();
?>

	<div id="primary" class="content-area container">
		<main id="main" class="site-main">

			<section id="tournament-home" class="container">
				<div class="tournament-features">
					<h1><?php the_field( 'tournament_name' ); ?></h1>

					<?php if ( get_field( 'tournament_image' ) ) { ?>
						<img src="<?php the_field( 'tournament_image' ); ?>" alt="poker tournament"/>
					<?php } ?>
					
					<p><?php the_field( 'tournament_info' ); ?></p>

					<?php if ( have_rows( 'tournament_events' ) ) : ?>
					<table style="width:100%">
						<tr>
							<th>Event</th>
							<th>Buy-in</th> 
							<th>Date</th>
						</tr>
						<?php while ( have_rows( 'tournament_events' ) ) : the_row(); ?>
							<tr>
								<td><?php the_sub_field( 'event_name' ); ?></td>
								<td><?php the_sub_field( 'event_buyin' ); ?></td> 
								<td><?php the_sub_field( 'event_dates' ); ?></td>
							</tr>
						<?php endwhile; ?>
						</table>
					<?php else : ?>
						<?php // no rows found ?>
					<?php endif; ?>

					<div id="location">
						<?php if ( have_rows( 'tournament_location' ) ): ?>
							<?php while ( have_rows( 'tournament_location' ) ) : the_row(); ?>
								<?php if ( get_row_layout() == 'tournament_location' ) : ?>
									<h2><?php the_sub_field( 'location_name' ); ?></h2>
									<?php if ( get_sub_field( 'location_image' ) ) { ?>
										<img src="<?php the_sub_field( 'location_image' ); ?>" alt="<?php the_sub_field( 'location_name' ); ?>"/>
									<?php } ?>
									<p><?php the_sub_field( 'location_info' ); ?></p>
								<?php endif; ?>
							<?php endwhile; ?>
						<?php else: ?>
							<?php // no layouts found ?>
						<?php endif; ?>
					</div>

				</div>
					
				<?php get_sidebar('tournament');?>
			</section>
			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
